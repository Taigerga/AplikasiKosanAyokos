<?php

namespace App\Http\Controllers\Penghuni;

use App\Http\Controllers\Controller;
use App\Models\KontrakSewa;
use App\Models\Kos;
use App\Models\Kamar;
use App\Services\NotificationService;
use App\Services\NotificationEmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Fasilitas;
use Carbon\Carbon;


class KontrakController extends Controller
{
    protected $notificationService;
    protected $emailService;

    public function __construct(
        NotificationService $notificationService,
        NotificationEmailService $emailService
    ) {
        $this->notificationService = $notificationService;
        $this->emailService = $emailService;
    }

    public function create($kosId)
    {
        try {
            $kos = Kos::with(['kamar' => function($query) {
                $query->where('status_kamar', 'tersedia');
            }])->findOrFail($kosId);

            return view('penghuni.kontrak.create', compact('kos'));

        } catch (\Exception $e) {
            return redirect()->route('public.kos.show', $kosId)
                ->with('error', 'Kos tidak ditemukan atau tidak ada kamar tersedia.');
        }
    }

    /**
     * Cari Kos - stays in dashboard layout, reuse public index view
     */
    public function cariKos()
    {
        $kos = Kos::with(['fasilitas', 'reviews'])
            ->addSelect([
                'harga_terendah_tersedia' => DB::table('kamar')
                    ->select(DB::raw('MIN(harga)'))
                    ->whereColumn('kamar.id_kos', 'kos.id_kos')
                    ->where('status_kamar', 'tersedia')
            ])
            ->withCount(['kamar as kamar_tersedia_count' => function ($q) {
                $q->where('status_kamar', 'tersedia');
            }])
            ->paginate(12);

        $fasilitasList = Fasilitas::all();

        return view('public.kos.index', compact('kos', 'fasilitasList'));
    }

    /**
     * Store new kontrak
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_kos' => 'required|exists:kos,id_kos',
                'id_kamar' => 'required|exists:kamar,id_kamar',
                'foto_ktp' => 'required|image|max:2048',
                'durasi_sewa' => 'required|integer|min:1',
                'tanggal_mulai' => 'required|date|after_or_equal:today'
            ]);

            // Upload file KTP saja
            $fotoKtpPath = $request->file('foto_ktp')->store('ktp', 'public');
            $buktiPembayaranPath = null;

            // Ambil data kamar & kos untuk harga dan tipe_sewa
            $kamar = Kamar::with('kos')->find($request->id_kamar);
            $tipeSewa = $kamar->kos->tipe_sewa;

            // Hitung tanggal_selesai berdasarkan tanggal_mulai, durasi, dan tipe_sewa
            $tanggalMulai = Carbon::parse($request->tanggal_mulai);
            $durasi = (int) $request->durasi_sewa;

            switch ($tipeSewa) {
                case 'harian':
                    $tanggalSelesai = $tanggalMulai->copy()->addDays($durasi);
                    break;
                case 'mingguan':
                    $tanggalSelesai = $tanggalMulai->copy()->addWeeks($durasi);
                    break;
                case 'tahunan':
                    $tanggalSelesai = $tanggalMulai->copy()->addYears($durasi);
                    break;
                default: // bulanan
                    $tanggalSelesai = $tanggalMulai->copy()->addMonths($durasi);
                    break;
            }

            // Buat kontrak baru
            $kontrak = KontrakSewa::create([
                'id_penghuni' => auth('penghuni')->user()->penghuni->id_penghuni,
                'id_kos' => $request->id_kos,
                'id_kamar' => $request->id_kamar,
                'foto_ktp' => $fotoKtpPath,
                'tanggal_daftar' => now(),
                'tanggal_mulai' => $tanggalMulai,
                'tanggal_selesai' => $tanggalSelesai,
                'durasi_sewa' => $durasi,
                'harga_sewa' => $kamar->harga,
                'status_kontrak' => 'pending'
            ]);

            // ===== BUAT RECORD PEMBAYARAN DENGAN STATUS PENDING =====
            // Pembayaran akan dibuat setelah kontrak disetujui oleh pemilik
            // Tidak membuat record pembayaran di sini
            // =======================================================

            // Kirim notifikasi
            $this->notificationService->sendPengajuanBaru($kontrak->id_kontrak);
            $this->notificationService->sendMenungguPersetujuan($kontrak->id_kontrak);
            
            // Kirim EMAIL notifikasi ke pemilik
            $this->emailService->sendPengajuanBaruToPemilik($kontrak);

            return redirect()->route('penghuni.dashboard')
                ->with('success', 'Pengajuan kos berhasil dikirim! Tunggu persetujuan dari pemilik.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal mengajukan kontrak: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan riwayat kontrak
     */
    public function index()
    {
        $user = auth('penghuni')->user();
        $penghuni = $user->penghuni;

        $kontrak = KontrakSewa::with(['kos', 'kamar'])
            ->where('id_penghuni', $penghuni->id_penghuni)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('penghuni.kontrak.index', compact('kontrak', 'user'));
    }

    /**
     * Menampilkan detail kontrak
     */
    public function show($id)
    {
        $kontrak = KontrakSewa::with(['kos', 'kamar'])
            ->where('id_kontrak', $id)
            ->where('id_penghuni', auth('penghuni')->user()->penghuni->id_penghuni)
            ->firstOrFail();

        return view('penghuni.kontrak.show', compact('kontrak'));
    }

    /**
     * Memperpanjang kontrak
     */
    public function extend(Request $request, $id)
    {
        try {
            $kontrak = KontrakSewa::where('id_kontrak', $id)
                ->where('id_penghuni', auth('penghuni')->user()->penghuni->id_penghuni)
                ->firstOrFail();
            
            $request->validate([
                'durasi_perpanjangan' => 'required|integer|min:1'
            ]);

            // Hitung tanggal selesai baru berdasarkan tipe_sewa
            $tipeSewa = $kontrak->kos->tipe_sewa;
            $durasiTambahan = (int)$request->durasi_perpanjangan;
            $tanggalSelesaiBaru = Carbon::parse($kontrak->tanggal_selesai);

            switch ($tipeSewa) {
                case 'harian':
                    $tanggalSelesaiBaru = $tanggalSelesaiBaru->addDays($durasiTambahan);
                    break;
                case 'mingguan':
                    $tanggalSelesaiBaru = $tanggalSelesaiBaru->addWeeks($durasiTambahan);
                    break;
                case 'tahunan':
                    $tanggalSelesaiBaru = $tanggalSelesaiBaru->addYears($durasiTambahan);
                    break;
                default: // bulanan
                    $tanggalSelesaiBaru = $tanggalSelesaiBaru->addMonths($durasiTambahan);
                    break;
            }

            $kontrak->update([
                'tanggal_selesai' => $tanggalSelesaiBaru,
                'durasi_sewa' => $kontrak->durasi_sewa + $durasiTambahan
            ]);
            
            // TAMBAHKAN: Kirim EMAIL notifikasi ke pemilik tentang perpanjangan
            $this->emailService->sendTenggatWaktuToPemilik($kontrak, 'perpanjangan');
            $this->emailService->sendTenggatWaktuToPenghuni($kontrak, 'perpanjangan');

            return redirect()->back()->with('success', 'Kontrak berhasil diperpanjang. Email notifikasi telah dikirim.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperpanjang kontrak: ' . $e->getMessage());
        }
    }
    
    /**
     * TAMBAHKAN: Metode untuk melihat email notifikasi tenggat waktu
     */
    public function notifikasiTenggat()
    {
        $user = auth('penghuni')->user();
        
        // Ambil kontrak aktif yang mendekati tenggat waktu
        $penghuni = $user->penghuni;
        $kontrakAktif = KontrakSewa::with(['kos', 'kamar'])
            ->where('id_penghuni', $penghuni->id_penghuni)
            ->where('status_kontrak', 'aktif')
            ->orderBy('tanggal_selesai', 'asc')
            ->get();
            
        // Hitung hari tersisa untuk setiap kontrak
        foreach ($kontrakAktif as $k) {
            $k->hari_tersisa = now()->diffInDays($k->tanggal_selesai, false);
        }

        return view('penghuni.kontrak.notifikasi', compact('kontrakAktif', 'user'));
    }
}
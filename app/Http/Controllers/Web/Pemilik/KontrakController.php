<?php

namespace App\Http\Controllers\Web\Pemilik;

use App\Http\Controllers\Controller;
use App\Services\Kontrak\KontrakService;
use App\Models\KontrakSewa;
use Illuminate\Http\Request;

class KontrakController extends Controller
{
    public function __construct(
        protected KontrakService $kontrakService
    ) {}

    public function index()
    {
        $user = auth()->user();
        $idPemilik = $user->pemilik->id_pemilik;

        $data = $this->kontrakService->getPemilikKontrak($idPemilik);

        return view('pemilik.kontrak.index', [
            'user' => $user,
            'kontrakPending' => $data['pending'],
            'kontrakAktif' => $data['aktif'],
            'kontrakSelesai' => $data['selesai'],
            'kontrakDitolak' => $data['ditolak'],
            'kontrakPendingCount' => $data['pendingCount'],
            'kontrakAktifCount' => $data['aktifCount'],
            'kontrakSelesaiCount' => $data['selesaiCount'],
            'kontrakDitolakCount' => $data['ditolakCount'],
        ]);
    }

    public function approve($idKontrak)
    {
        try {
            $this->kontrakService->approveKontrak(auth()->user()->pemilik->id_pemilik, $idKontrak);

            return redirect()->route('pemilik.kontrak.index')
                ->with('success', 'Kontrak disetujui. Notifikasi Email dikirim ke penghuni.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyetujui kontrak: ' . $e->getMessage());
        }
    }

    public function reject(Request $request, $idKontrak)
    {
        try {
            $this->kontrakService->rejectKontrak(
                auth()->user()->pemilik->id_pemilik,
                $idKontrak,
                $request->alasan_ditolak
            );

            return redirect()->route('pemilik.kontrak.index')
                ->with('success', 'Kontrak ditolak. Notifikasi Email dikirim ke calon penghuni.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menolak kontrak: ' . $e->getMessage());
        }
    }

    public function show($idKontrak)
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kos', 'kamar'])->findOrFail($idKontrak);

        if ($kontrak->kos->id_pemilik != auth()->user()->pemilik->id_pemilik) {
            abort(403, 'Anda tidak memiliki akses!');
        }

        return view('pemilik.kontrak.show', compact('kontrak'));
    }

    public function selesai($idKontrak)
    {
        try {
            $this->kontrakService->selesaiKontrak(auth()->user()->pemilik->id_pemilik, $idKontrak);

            return redirect()->route('pemilik.kontrak.index')
                ->with('success', 'Kontrak telah ditandai sebagai selesai. Kamar kini tersedia. Email notifikasi telah dikirim.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menandai kontrak selesai: ' . $e->getMessage());
        }
    }

    public function testEmail($idKontrak, $type)
    {
        try {
            $kontrak = KontrakSewa::with(['penghuni', 'kos'])->findOrFail($idKontrak);

            if ($kontrak->kos->id_pemilik != auth()->user()->pemilik->id_pemilik) {
                return redirect()->back()->with('error', 'Anda tidak memiliki akses!');
            }

            $emailService = app(\App\Services\Notification\KontrakNotificationService::class);

            switch ($type) {
                case 'diterima':
                    $emailService->sendKontrakDiterima($kontrak);
                    $message = 'Email kontrak diterima berhasil dikirim ke ' . $kontrak->penghuni->email;
                    break;
                case 'ditolak':
                    $emailService->sendKontrakDitolak($kontrak);
                    $message = 'Email kontrak ditolak berhasil dikirim ke ' . $kontrak->penghuni->email;
                    break;
                case 'tenggat_7hari':
                    $emailService->sendTenggatWaktuToPenghuni($kontrak, '7_hari');
                    $emailService->sendTenggatWaktuToPemilik($kontrak, '7_hari');
                    $message = 'Email notifikasi 7 hari berhasil dikirim';
                    break;
                case 'tenggat_hariini':
                    $emailService->sendTenggatWaktuToPenghuni($kontrak, 'tenggat');
                    $emailService->sendTenggatWaktuToPemilik($kontrak, 'tenggat');
                    $message = 'Email notifikasi hari ini berhasil dikirim';
                    break;
                default:
                    throw new \Exception('Tipe email tidak valid');
            }

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengirim email: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->kontrakService->destroyKontrak(auth()->user()->pemilik->id_pemilik, $id);

            return redirect()->route('pemilik.kontrak.index')
                ->with('success', 'Riwayat kontrak berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('pemilik.kontrak.index')
                ->with('error', $e->getMessage());
        }
    }
}

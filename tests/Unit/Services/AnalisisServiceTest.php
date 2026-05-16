<?php

namespace Tests\Unit\Services;

use App\Models\Pembayaran;
use App\Models\Pemilik;
use App\Models\Kos;
use App\Models\KontrakSewa;
use App\Models\Penghuni;
use App\Services\Analisis\AnalisisService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnalisisServiceTest extends TestCase
{
    use RefreshDatabase;

    private AnalisisService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = app(AnalisisService::class);
    }

    public function test_get_pendapatan_tahunan_returns_collection()
    {
        $pemilik = Pemilik::factory()->create();
        $kos = Kos::factory()->create(['id_pemilik' => $pemilik->id_pemilik]);
        $penghuni = Penghuni::factory()->create();
        $kontrak = KontrakSewa::factory()->create([
            'id_kos' => $kos->id_kos,
            'id_penghuni' => $penghuni->id_penghuni,
            'status_kontrak' => 'aktif',
        ]);
        Pembayaran::factory()->count(2)->lunas()->create([
            'id_kontrak' => $kontrak->id_kontrak,
            'id_penghuni' => $penghuni->id_penghuni,
            'tanggal_bayar' => now(),
        ]);

        $result = $this->service->getPendapatanTahunan($pemilik->id_pemilik, now()->year);

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $result);
    }

    public function test_get_aktivitas_terbaru_returns_latest_payments()
    {
        $pemilik = Pemilik::factory()->create();
        $kos = Kos::factory()->create(['id_pemilik' => $pemilik->id_pemilik]);
        $penghuni = Penghuni::factory()->create();
        $kontrak = KontrakSewa::factory()->create([
            'id_kos' => $kos->id_kos,
            'id_penghuni' => $penghuni->id_penghuni,
        ]);
        Pembayaran::factory()->count(5)->create([
            'id_kontrak' => $kontrak->id_kontrak,
            'id_penghuni' => $penghuni->id_penghuni,
        ]);

        $result = $this->service->getAktivitasTerbaru($pemilik->id_pemilik, 3);

        $this->assertCount(3, $result);
    }

    public function test_get_pemilik_dashboard_stats_returns_all_keys()
    {
        $pemilik = Pemilik::factory()->create();

        $stats = $this->service->getPemilikDashboardStats($pemilik->id_pemilik);

        $expectedKeys = ['totalKos', 'totalKamar', 'kamarTersedia', 'totalPenghuni',
            'semuaKos', 'semuaKamar', 'kontrakPending', 'pembayaranTerbaru', 'pendapatanBulanIni'];
        foreach ($expectedKeys as $key) {
            $this->assertArrayHasKey($key, $stats);
        }
    }
}

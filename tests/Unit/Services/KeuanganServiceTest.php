<?php

namespace Tests\Unit\Services;

use App\Models\Pembayaran;
use App\Models\Pemilik;
use App\Models\Kos;
use App\Models\KontrakSewa;
use App\Models\Penghuni;
use App\Services\Keuangan\KeuanganService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KeuanganServiceTest extends TestCase
{
    use RefreshDatabase;

    private KeuanganService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = app(KeuanganService::class);
    }

    public function test_ringkasan_keuangan_has_correct_keys()
    {
        $ringkasan = $this->service->getRingkasanKeuangan();

        $expectedKeys = [
            'totalPendapatanPlatform', 'totalPendapatanTahun', 'totalPendapatanBulan',
            'totalTransaksiLunas', 'totalTransaksiTahun',
        ];
        foreach ($expectedKeys as $key) {
            $this->assertArrayHasKey($key, $ringkasan);
        }
    }

    public function test_ringkasan_keuangan_calculates_correctly()
    {
        $penghuni = Penghuni::factory()->create();
        $kontrak = KontrakSewa::factory()->create(['id_penghuni' => $penghuni->id_penghuni]);

        $pembayaran = Pembayaran::factory()->lunas()->create([
            'id_kontrak' => $kontrak->id_kontrak,
            'id_penghuni' => $penghuni->id_penghuni,
            'jumlah' => 1000000,
            'bagian_pemilik' => 900000,
            'bagian_platform' => 100000,
            'tanggal_bayar' => now(),
        ]);

        $ringkasan = $this->service->getRingkasanKeuangan();

        $this->assertEquals(100000, $ringkasan['totalPendapatanPlatform']);
        $this->assertEquals(1, $ringkasan['totalTransaksiLunas']);
    }

    public function test_get_pendapatan_bulanan_returns_monthly_data()
    {
        $penghuni = Penghuni::factory()->create();
        $kontrak = KontrakSewa::factory()->create(['id_penghuni' => $penghuni->id_penghuni]);

        Pembayaran::factory()->create([
            'id_kontrak' => $kontrak->id_kontrak,
            'id_penghuni' => $penghuni->id_penghuni,
            'jumlah' => 1000000,
            'status_pembayaran' => 'lunas',
            'tanggal_bayar' => now(),
            'bagian_pemilik' => 900000,
            'bagian_platform' => 100000,
        ]);

        $result = $this->service->getPendapatanBulanan(now()->year);

        $this->assertNotEmpty($result);
        $this->assertEquals(now()->month, $result->first()->bulan);
        $this->assertEquals(900000, (int) $result->first()->pendapatan_pemilik);
        $this->assertEquals(100000, (int) $result->first()->pendapatan_platform);
    }

    public function test_get_statistik_pemilik_returns_grouped_data()
    {
        $pemilik = Pemilik::factory()->create();
        $kos = Kos::factory()->create(['id_pemilik' => $pemilik->id_pemilik]);
        $penghuni = Penghuni::factory()->create();
        $kontrak = KontrakSewa::factory()->create([
            'id_kos' => $kos->id_kos,
            'id_penghuni' => $penghuni->id_penghuni,
        ]);

        Pembayaran::factory()->create([
            'id_kontrak' => $kontrak->id_kontrak,
            'id_penghuni' => $penghuni->id_penghuni,
            'jumlah' => 1000000,
            'status_pembayaran' => 'lunas',
            'tanggal_bayar' => now(),
            'bagian_pemilik' => 900000,
            'bagian_platform' => 100000,
        ]);

        $result = $this->service->getStatistikPemilik();

        $this->assertNotEmpty($result);
        $this->assertEquals($kos->nama_kos, $result->first()->nama_kos);
    }
}

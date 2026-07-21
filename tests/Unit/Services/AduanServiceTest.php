<?php

namespace Tests\Unit\Services;

use App\Models\Aduan;
use App\Models\AduanKomentar;
use App\Models\User;
use App\Services\Aduan\AduanService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AduanServiceTest extends TestCase
{
    use RefreshDatabase;

    private AduanService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = app(AduanService::class);
    }

    public function test_create_aduan()
    {
        $user = User::factory()->create();

        $aduan = $this->service->createAduan($user->id, 'penghuni', [
            'judul' => 'Test Aduan',
            'kategori' => 'kebersihan',
            'deskripsi' => 'Ini adalah deskripsi aduan testing.',
        ]);

        $this->assertDatabaseHas('aduan', [
            'id_aduan' => $aduan->id_aduan,
            'judul' => 'Test Aduan',
            'status_aduan' => 'diajukan',
        ]);
        $this->assertEquals('penghuni', $aduan->pengirim_role);
        $this->assertEquals($user->id, $aduan->id_pengirim);
    }

    public function test_update_status_aduan()
    {
        $user = User::factory()->create();
        $aduan = $this->service->createAduan($user->id, 'penghuni', [
            'judul' => 'Test Status',
            'kategori' => 'fasilitas',
            'deskripsi' => 'Deskripsi perubahan status.',
        ]);

        $this->service->updateStatus($aduan->id_aduan, 'diproses');

        $this->assertDatabaseHas('aduan', [
            'id_aduan' => $aduan->id_aduan,
            'status_aduan' => 'diproses',
        ]);
    }

    public function test_tambah_komentar()
    {
        $user = User::factory()->create();
        $aduan = $this->service->createAduan($user->id, 'penghuni', [
            'judul' => 'Test Komentar',
            'kategori' => 'keamanan',
            'deskripsi' => 'Deskripsi untuk komentar.',
        ]);

        $this->service->tambahKomentar($aduan->id_aduan, $user->id, [
            'isi' => 'Ini adalah komentar testing.',
        ]);

        $this->assertDatabaseHas('aduan_komentar', [
            'id_aduan' => $aduan->id_aduan,
            'id_pengirim' => $user->id,
            'isi' => 'Ini adalah komentar testing.',
        ]);
    }

    public function test_get_aduan_list_filter_by_pengirim()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $this->service->createAduan($user1->id, 'penghuni', [
            'judul' => 'Aduan User 1',
            'kategori' => 'kebersihan',
            'deskripsi' => 'Deskripsi aduan user 1.',
        ]);
        $this->service->createAduan($user2->id, 'pemilik', [
            'judul' => 'Aduan User 2',
            'kategori' => 'fasilitas',
            'deskripsi' => 'Deskripsi aduan user 2.',
        ]);

        $result = $this->service->getAduanList(['pengirim_id' => $user1->id]);

        $this->assertCount(1, $result);
        $this->assertEquals('Aduan User 1', $result->first()->judul);
    }

    public function test_get_statistik_returns_all_keys()
    {
        $user = User::factory()->create();
        $this->service->createAduan($user->id, 'penghuni', [
            'judul' => 'Aduan Statistik',
            'kategori' => 'kebersihan',
            'deskripsi' => 'Deskripsi statistik.',
        ]);

        $statistik = $this->service->getStatistik();

        $expectedKeys = ['total', 'diajukan', 'ditinjau', 'diproses', 'selesai', 'ditolak', 'perKategori'];
        foreach ($expectedKeys as $key) {
            $this->assertArrayHasKey($key, $statistik);
        }
        $this->assertEquals(1, $statistik['total']);
        $this->assertEquals(1, $statistik['diajukan']);
    }

    public function test_get_aduan_detail_with_komentar()
    {
        $user = User::factory()->create();
        $aduan = $this->service->createAduan($user->id, 'penghuni', [
            'judul' => 'Aduan Detail',
            'kategori' => 'kebersihan',
            'deskripsi' => 'Deskripsi detail.',
        ]);
        $this->service->tambahKomentar($aduan->id_aduan, $user->id, [
            'isi' => 'Komentar 1',
        ]);

        $detail = $this->service->getAduanDetail($aduan->id_aduan);

        $this->assertInstanceOf(Aduan::class, $detail);
        $this->assertCount(1, $detail->komentar);
        $this->assertEquals('Komentar 1', $detail->komentar->first()->isi);
    }
}

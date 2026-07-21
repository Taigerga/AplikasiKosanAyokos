<?php

namespace Tests\Feature\Api;

use App\Models\Kos;
use App\Models\Kamar;
use App\Models\Pemilik;
use App\Models\Penghuni;
use App\Models\Pembayaran;
use App\Models\KontrakSewa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class PembayaranTest extends TestCase
{
    use RefreshDatabase;

    public function test_penghuni_can_create_pembayaran()
    {
        $user = User::factory()->penghuni()->create();
        $penghuni = Penghuni::factory()->create(['user_id' => $user->id]);
        $kos = Kos::factory()->create(['status_kos' => 'aktif', 'tipe_sewa' => 'bulanan']);
        $kamar = Kamar::factory()->create([
            'id_kos' => $kos->id_kos,
            'status_kamar' => 'tersedia',
            'harga' => 500000,
        ]);
        $kontrak = KontrakSewa::factory()->aktif()->create([
            'id_penghuni' => $penghuni->id_penghuni,
            'id_kos' => $kos->id_kos,
            'id_kamar' => $kamar->id_kamar,
            'harga_sewa' => 500000,
        ]);
        $token = $user->createToken('test')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->post('/api/penghuni/pembayaran', [
                'id_kontrak' => $kontrak->id_kontrak,
                'jumlah_waktu' => 1,
                'metode_pembayaran' => 'transfer',
                'bukti_pembayaran' => UploadedFile::fake()->image('bukti.jpg'),
            ]);

        $response->assertStatus(201)
            ->assertJsonStructure(['success', 'data']);
    }

    public function test_pemilik_can_approve_pembayaran()
    {
        $user = User::factory()->pemilik()->create();
        $pemilik = Pemilik::factory()->create(['user_id' => $user->id]);
        $kos = Kos::factory()->create(['id_pemilik' => $pemilik->id_pemilik, 'tipe_sewa' => 'bulanan']);
        $kamar = Kamar::factory()->create(['id_kos' => $kos->id_kos]);
        $penghuni = Penghuni::factory()->create();
        $kontrak = KontrakSewa::factory()->aktif()->create([
            'id_penghuni' => $penghuni->id_penghuni,
            'id_kos' => $kos->id_kos,
            'id_kamar' => $kamar->id_kamar,
        ]);
        $pembayaran = Pembayaran::factory()->create([
            'id_kontrak' => $kontrak->id_kontrak,
            'id_penghuni' => $penghuni->id_penghuni,
            'status_pembayaran' => 'pending',
            'jumlah' => 1000000,
        ]);
        $token = $user->createToken('test')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->postJson("/api/pemilik/pembayaran/{$pembayaran->id_pembayaran}/approve");

        $response->assertStatus(200)
            ->assertJson(['success' => true]);
    }

    public function test_approve_sets_bagian_pemilik_90_percent()
    {
        $user = User::factory()->pemilik()->create();
        $pemilik = Pemilik::factory()->create(['user_id' => $user->id]);
        $kos = Kos::factory()->create(['id_pemilik' => $pemilik->id_pemilik, 'tipe_sewa' => 'bulanan']);
        $kamar = Kamar::factory()->create(['id_kos' => $kos->id_kos]);
        $penghuni = Penghuni::factory()->create();
        $kontrak = KontrakSewa::factory()->aktif()->create([
            'id_penghuni' => $penghuni->id_penghuni,
            'id_kos' => $kos->id_kos,
            'id_kamar' => $kamar->id_kamar,
        ]);
        $pembayaran = Pembayaran::factory()->create([
            'id_kontrak' => $kontrak->id_kontrak,
            'id_penghuni' => $penghuni->id_penghuni,
            'status_pembayaran' => 'pending',
            'jumlah' => 1000000,
        ]);
        $token = $user->createToken('test')->plainTextToken;

        $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->postJson("/api/pemilik/pembayaran/{$pembayaran->id_pembayaran}/approve");

        $this->assertDatabaseHas('pembayaran', [
            'id_pembayaran' => $pembayaran->id_pembayaran,
            'status_pembayaran' => 'lunas',
            'jumlah' => 1000000,
            'bagian_pemilik' => 900000,
            'bagian_platform' => 100000,
        ]);
    }

    public function test_penghuni_can_list_pembayaran()
    {
        $user = User::factory()->penghuni()->create();
        $penghuni = Penghuni::factory()->create(['user_id' => $user->id]);
        $token = $user->createToken('test')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->getJson('/api/penghuni/pembayaran');

        $response->assertStatus(200)
            ->assertJson(['success' => true]);
    }
}

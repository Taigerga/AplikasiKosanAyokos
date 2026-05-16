<?php

namespace Tests\Feature\Api;

use App\Models\Kos;
use App\Models\Kamar;
use App\Models\Pemilik;
use App\Models\Penghuni;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class KontrakTest extends TestCase
{
    use RefreshDatabase;

    public function test_penghuni_can_create_kontrak()
    {
        $user = User::factory()->penghuni()->create();
        $penghuni = Penghuni::factory()->create(['user_id' => $user->id]);
        $kos = Kos::factory()->create(['status_kos' => 'aktif']);
        $kamar = Kamar::factory()->create(['id_kos' => $kos->id_kos, 'status_kamar' => 'tersedia']);
        $token = $user->createToken('test')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->post('/api/penghuni/kontrak', [
                'id_kos' => $kos->id_kos,
                'id_kamar' => $kamar->id_kamar,
                'durasi_sewa' => 6,
                'tanggal_mulai' => now()->addDay()->format('Y-m-d'),
                'foto_ktp' => UploadedFile::fake()->image('ktp.jpg'),
            ]);

        $response->assertStatus(201)
            ->assertJsonStructure(['success', 'data']);
    }

    public function test_pemilik_can_approve_kontrak()
    {
        $user = User::factory()->pemilik()->create();
        $pemilik = Pemilik::factory()->create(['user_id' => $user->id]);
        $kos = Kos::factory()->create(['id_pemilik' => $pemilik->id_pemilik]);
        $kamar = Kamar::factory()->create(['id_kos' => $kos->id_kos]);
        $penghuni = Penghuni::factory()->create();
        $kontrak = \App\Models\KontrakSewa::factory()->create([
            'id_penghuni' => $penghuni->id_penghuni,
            'id_kos' => $kos->id_kos,
            'id_kamar' => $kamar->id_kamar,
            'status_kontrak' => 'pending',
        ]);
        $token = $user->createToken('test')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->postJson("/api/pemilik/kontrak/{$kontrak->id_kontrak}/approve");

        $response->assertStatus(200)
            ->assertJson(['success' => true]);
    }

    public function test_penghuni_can_list_kontrak()
    {
        $user = User::factory()->penghuni()->create();
        $penghuni = Penghuni::factory()->create(['user_id' => $user->id]);
        $token = $user->createToken('test')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->getJson('/api/penghuni/kontrak');

        $response->assertStatus(200)
            ->assertJson(['success' => true]);
    }

    public function test_approve_fails_with_invalid_kontrak_id()
    {
        $user = User::factory()->pemilik()->create();
        $pemilik = Pemilik::factory()->create(['user_id' => $user->id]);
        $token = $user->createToken('test')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->postJson('/api/pemilik/kontrak/99999/approve');

        $response->assertStatus(500)
            ->assertJson(['success' => false]);
    }

    public function test_unauthorized_user_cannot_approve_kontrak()
    {
        $penghuniUser = User::factory()->penghuni()->create();
        $penghuni = Penghuni::factory()->create(['user_id' => $penghuniUser->id]);
        $token = $penghuniUser->createToken('test')->plainTextToken;

        $pemilik = Pemilik::factory()->create();
        $kos = Kos::factory()->create(['id_pemilik' => $pemilik->id_pemilik]);
        $kamar = Kamar::factory()->create(['id_kos' => $kos->id_kos]);
        $kontrak = \App\Models\KontrakSewa::factory()->create([
            'id_penghuni' => $penghuni->id_penghuni,
            'id_kos' => $kos->id_kos,
            'id_kamar' => $kamar->id_kamar,
            'status_kontrak' => 'pending',
        ]);

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->postJson("/api/pemilik/kontrak/{$kontrak->id_kontrak}/approve");

        $response->assertStatus(500)
            ->assertJson(['success' => false]);
    }
}

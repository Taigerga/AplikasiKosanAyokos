<?php

namespace Tests\Feature\Api;

use App\Models\Kos;
use App\Models\Pemilik;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KosTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_kos_index_returns_paginated_kos()
    {
        Kos::factory()->count(3)->create(['status_kos' => 'aktif']);

        $response = $this->getJson('/api/public/kos');

        $response->assertStatus(200)
            ->assertJsonStructure(['success', 'data']);
    }

    public function test_public_kos_show_returns_kos_detail()
    {
        $kos = Kos::factory()->create(['status_kos' => 'aktif']);

        $response = $this->getJson("/api/public/kos/{$kos->id_kos}");

        $response->assertStatus(200)
            ->assertJson(['success' => true]);
    }

    public function test_pemilik_can_create_kos()
    {
        $user = User::factory()->pemilik()->create();
        $pemilik = Pemilik::factory()->create(['user_id' => $user->id]);
        $token = $user->createToken('test')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->postJson('/api/pemilik/kos', [
                'nama_kos' => 'Kos Bahagia',
                'alamat' => 'Jl. Bahagia No. 1',
                'kecamatan' => 'Sukajadi',
                'kota' => 'Bandung',
                'provinsi' => 'Jawa Barat',
                'jenis_kos' => 'putra',
                'tipe_sewa' => 'bulanan',
                'status_kos' => 'aktif',
            ]);

        $response->assertStatus(201)
            ->assertJsonStructure(['success', 'data']);
    }

    public function test_pemilik_can_list_own_kos()
    {
        $user = User::factory()->pemilik()->create();
        $pemilik = Pemilik::factory()->create(['user_id' => $user->id]);
        Kos::factory()->count(2)->create(['id_pemilik' => $pemilik->id_pemilik]);
        $token = $user->createToken('test')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->getJson('/api/pemilik/kos');

        $response->assertStatus(200)
            ->assertJson(['success' => true]);
    }

    public function test_public_kos_show_returns_not_found()
    {
        $response = $this->getJson('/api/public/kos/99999');

        $response->assertStatus(404)
            ->assertJson(['success' => false]);
    }

    public function test_pemilik_cannot_create_kos_without_required_fields()
    {
        $user = User::factory()->pemilik()->create();
        $pemilik = Pemilik::factory()->create(['user_id' => $user->id]);
        $token = $user->createToken('test')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->postJson('/api/pemilik/kos', []);

        $response->assertStatus(422)
            ->assertJson(['success' => false]);
    }
}

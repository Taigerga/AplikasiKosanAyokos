<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Penghuni;
use App\Models\Pembayaran;
use App\Models\KontrakSewa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KeuanganTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_keuangan_ringkasan()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $adminToken = $admin->createToken('test')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $adminToken])
            ->getJson('/api/admin/keuangan');

        $response->assertStatus(200)
            ->assertJsonStructure(['success', 'data']);
    }

    public function test_keuangan_returns_correct_data_structure()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $adminToken = $admin->createToken('test')->plainTextToken;

        // Create some payments with bagi hasil
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

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $adminToken])
            ->getJson('/api/admin/keuangan');

        $response->assertStatus(200);
        $response->assertJsonPath('data.totalPendapatanPlatform', 100000);
    }

    public function test_non_admin_cannot_access_keuangan()
    {
        $user = User::factory()->penghuni()->create();
        Penghuni::factory()->create(['user_id' => $user->id]);
        $token = $user->createToken('test')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->getJson('/api/admin/keuangan');

        $response->assertStatus(403);
    }

    public function test_admin_can_access_pendapatan_bulanan()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $adminToken = $admin->createToken('test')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $adminToken])
            ->getJson('/api/admin/keuangan/pendapatan-bulanan?tahun=' . now()->year);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);
    }
}

<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Pemilik;
use App\Models\Penghuni;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class StatusAkunTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_update_pemilik_status_to_diblokir()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $adminToken = $admin->createToken('test')->plainTextToken;

        $pemilikUser = User::factory()->pemilik()->create();
        $pemilik = Pemilik::factory()->create(['user_id' => $pemilikUser->id]);

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $adminToken])
            ->postJson("/api/admin/data-pemilik/{$pemilik->id_pemilik}/status", [
                'status' => 'diblokir',
                'alasan' => 'Melanggar aturan platform.',
            ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('pemilik', [
            'id_pemilik' => $pemilik->id_pemilik,
            'status_pemilik' => 'diblokir',
        ]);
    }

    public function test_admin_can_update_penghuni_status_to_dibatasi()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $adminToken = $admin->createToken('test')->plainTextToken;

        $penghuniUser = User::factory()->penghuni()->create();
        $penghuni = Penghuni::factory()->create(['user_id' => $penghuniUser->id]);

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $adminToken])
            ->postJson("/api/admin/data-penghuni/{$penghuni->id_penghuni}/status", [
                'status' => 'dibatasi',
                'alasan' => 'Menyebarkan informasi palsu.',
            ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('penghuni', [
            'id_penghuni' => $penghuni->id_penghuni,
            'status_penghuni' => 'dibatasi',
        ]);
    }

    public function test_non_admin_cannot_update_status()
    {
        $user = User::factory()->penghuni()->create();
        Penghuni::factory()->create(['user_id' => $user->id]);
        $token = $user->createToken('test')->plainTextToken;

        $pemilikUser = User::factory()->pemilik()->create();
        $pemilik = Pemilik::factory()->create(['user_id' => $pemilikUser->id]);

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->postJson("/api/admin/data-pemilik/{$pemilik->id_pemilik}/status", [
                'status' => 'diblokir',
                'alasan' => 'Test.',
            ]);

        $response->assertStatus(403);
    }

    public function test_blokir_user_cannot_login_via_web()
    {
        $user = User::factory()->create([
            'username' => 'testpemilik',
            'role' => 'pemilik',
        ]);
        Pemilik::factory()->create([
            'user_id' => $user->id,
            'status_pemilik' => 'aktif',
        ]);

        // Set status to diblokir via DB direct update (bypasses CHECK constraint)
        DB::table('pemilik')->where('user_id', $user->id)->update(['status_pemilik' => 'diblokir']);

        $response = $this->post('/login', [
            'username' => 'testpemilik',
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors('login');
        $this->assertGuest();
    }

    public function test_dibatasi_user_cannot_access_protected_route()
    {
        $user = User::factory()->penghuni()->create();
        Penghuni::factory()->create(['user_id' => $user->id]);

        // Set status to dibatasi via DB direct update
        DB::table('penghuni')->where('user_id', $user->id)->update(['status_penghuni' => 'dibatasi']);
        $token = $user->createToken('test')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->getJson('/api/penghuni/pembayaran');

        $response->assertStatus(403);
    }
}

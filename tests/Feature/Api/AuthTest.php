<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_success()
    {
        User::factory()->create([
            'username' => 'testuser',
            'password' => Hash::make('password'),
            'role' => 'penghuni',
        ]);

        $response = $this->post('/login', [
            'username' => 'testuser',
            'password' => 'password',
        ]);

        $response->assertStatus(302);
        $this->assertAuthenticated();
    }

    public function test_login_fails_with_wrong_password()
    {
        User::factory()->create([
            'username' => 'testuser',
            'password' => Hash::make('password'),
        ]);

        $response = $this->post('/login', [
            'username' => 'testuser',
            'password' => 'wrong',
        ]);

        $response->assertStatus(302);
        $this->assertGuest();
    }

    public function test_register_penghuni()
    {
        $response = $this->postJson('/api/auth/register/penghuni', [
            'nama' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'no_hp' => '08123456789',
            'jenis_kelamin' => 'L',
            'tanggal_lahir' => '2000-01-01',
            'alamat' => 'Jl. Test No. 1',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure(['success', 'data' => ['user', 'token']]);
        $this->assertDatabaseHas('users', ['username' => 'johndoe']);
    }

    public function test_authenticated_user_can_access_me()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->getJson('/api/auth/me');

        $response->assertStatus(200)
            ->assertJson(['success' => true]);
    }

    public function test_register_fails_with_missing_fields()
    {
        $response = $this->postJson('/api/auth/register/penghuni', []);

        $response->assertStatus(422)
            ->assertJson(['success' => false]);
    }

    public function test_me_returns_error_without_auth()
    {
        $response = $this->getJson('/api/auth/me');

        $response->assertStatus(401)
            ->assertJson(['success' => false]);
    }

    public function test_logout_returns_unauthorized_without_token()
    {
        $response = $this->postJson('/api/auth/logout');

        $response->assertStatus(401)
            ->assertJson(['success' => false]);
    }
}

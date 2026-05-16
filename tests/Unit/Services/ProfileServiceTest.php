<?php

namespace Tests\Unit\Services;

use App\Models\User;
use App\Services\Profile\ProfileService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ProfileServiceTest extends TestCase
{
    use RefreshDatabase;

    private ProfileService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = app(ProfileService::class);
    }

    public function test_change_password_success()
    {
        $user = User::factory()->create(['password' => Hash::make('oldpass')]);

        $this->service->changePassword($user->id, 'oldpass', 'newpass');

        $user->refresh();
        $this->assertTrue(Hash::check('newpass', $user->password));
    }

    public function test_change_password_fails_with_wrong_old_password()
    {
        $user = User::factory()->create(['password' => Hash::make('oldpass')]);

        $this->expectException(\InvalidArgumentException::class);
        $this->service->changePassword($user->id, 'wrongpass', 'newpass');
    }
}

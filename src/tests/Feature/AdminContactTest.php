<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminContactTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_access_admin(): void
    {
        $this->get('/admin')->assertRedirect('/login');
    }

    /** @test */
    public function logged_in_user_can_access_admin(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/admin')
            ->assertOk();
    }
}

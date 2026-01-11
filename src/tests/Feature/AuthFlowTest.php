<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthFlowTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_register_and_is_redirected_to_home(): void
    {
        $res = $this->post('/register', [
            'name' => 'Taro',
            'email' => 'taro@example.com',
            'password' => 'Password123!', // FortifyのPassword::default()を満たす
        ]);

        $res->assertStatus(302);
        $res->assertRedirect('/admin'); // fortify.home が /admin の想定
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'taro@example.com']);
    }

    /** @test */
    public function user_can_login_and_logout(): void
    {
        // 先に登録（またはUser factory）
        $this->post('/register', [
            'name' => 'Hanako',
            'email' => 'hanako@example.com',
            'password' => 'Password123!',
        ]);

        $this->post('/logout')->assertStatus(302);
        $this->assertGuest();

        $this->post('/login', [
            'email' => 'hanako@example.com',
            'password' => 'Password123!',
        ])->assertStatus(302)->assertRedirect('/admin');

        $this->assertAuthenticated();
    }
}

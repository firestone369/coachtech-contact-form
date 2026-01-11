<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExportTest extends TestCase
{
    use RefreshDatabase;

    public function guest_cannot_export(): void
    {
        $this->get('/admin/export')->assertRedirect('/login');
    }

    public function test_logged_in_user_can_export_csv()
    {
        $user = User::factory()->create();

        $this->seed(\Database\Seeders\CategorySeeder::class);

        Contact::factory()->count(3)->create();

        $response = $this->actingAs($user)->get('/admin/export');

        $response->assertOk();

        $disposition = $response->headers->get('content-disposition');
        $this->assertNotNull($disposition);
        $this->assertMatchesRegularExpression('/attachment;\s*filename="?contacts_/', $disposition);

        $this->assertStringContainsString('メールアドレス', $response->streamedContent());
    }
}

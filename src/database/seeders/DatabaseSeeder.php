<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     * 35件のダミーデータを生成
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        Contact::factory()->count(35)->create();
    }
}

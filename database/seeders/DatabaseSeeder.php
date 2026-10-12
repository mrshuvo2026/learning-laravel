<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use App\Models\News;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::factory(5)->create();
        News::factory(10)->create();
        // User::factory(10)->create();
$this->call(CategorySeeder::class);
      //  User::factory()->create([
      //      'name' => 'Test User',
      //      'email' => 'test@example.com',
       // ]);
    }
}

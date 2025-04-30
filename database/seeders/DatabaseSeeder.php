<?php

namespace Database\Seeders;

use App\Models\Pet;
use App\Models\User;
use App\Models\VeterinarianProfile;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Pet::factory(10)->create();
        $this->call([
            VeterinarianProfileSeeder::class,
        ]);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

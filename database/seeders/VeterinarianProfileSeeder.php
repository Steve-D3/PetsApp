<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\VetClinic;
use App\Models\VeterinarianProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class VeterinarianProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure there are vet clinics to assign vets to
        if (VetClinic::count() === 0) {
            \App\Models\VetClinic::factory()->count(5)->create();
        }

        $clinics = VetClinic::all();

        for ($i = 1; $i <= 5; $i++) {
            $user = User::create([
                'name' => fake()->name(),
                'email' => "vet$i@example.com",
                'password' => Hash::make('password'),
                'role' => 'vet',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            VeterinarianProfile::create([
                'user_id' => $user->id,
                'license_number' => "VET-00$i",
                'specialty' => fake()->randomElement(['Nutrition', 'Oncology', 'Neurosurgery', 'General']),
                'biography' => fake()->sentence(10),
                'phone_number' => fake()->phoneNumber(),
                'vet_clinic_id' => $clinics->random()->id, // New relation
            ]);
        }
    }
}

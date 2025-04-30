<?php

namespace Database\Seeders;

use App\Models\User;
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
        // Create 5 veterinarian users with profiles
        for ($i = 1; $i <= 5; $i++) {
            $user = User::create([
                'name' => "Vet $i",
                'email' => "vet$i@example.com",
                'password' => Hash::make('password'), // default password
                'role' => 'vet',
            ]);

            VeterinarianProfile::create([
                'user_id' => $user->id,
                'license_number' => "VET-00$i",
                'specialty' => fake()->randomElement(['Surgery', 'Dentistry', 'Dermatology']),
                'biography' => fake()->sentence(10),
                'clinic_name' => "Happy Paws Clinic $i",
                'location' => fake()->city(),
                'phone_number' => fake()->phoneNumber(),
            ]);
        }
    }
}

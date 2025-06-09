<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\Pet;
use App\Models\Treatment;
use App\Models\User;
use App\Models\VetClinic;
use App\Models\VeterinarianProfile;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Create a test user with admin privileges (using 'vet' role which should have admin access)
        User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin', // Using 'vet' role which should have admin privileges
            'email_verified_at' => now(),
        ]);
        User::factory()->create([
            'name' => 'Test Vet',
            'email' => 'vet@example.com',
            'password' => bcrypt('password'),
            'role' => 'vet',
            'email_verified_at' => now(),
        ]);
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);



        // Create regular users and pets
        User::factory(20)->create();
        Pet::factory(20)->create();

        // 1. Seed vet clinics first (required for veterinarian profiles)
        $this->call(VetClinicSeeder::class);

        // 2. Create veterinarian profiles
        $testVet = VeterinarianProfile::factory()->create([
            'user_id' => 2,
            "license_number" => "123456",
            "specialty" => "General Practice",
            "biography" => "I am a veterinarian with 10 years of experience.",
            "phone_number" => "123-456-7890",
            "vet_clinic_id" => 1,
            "off_days" => json_encode(["Monday"]) // Ensure off_days is properly encoded
        ]);

        // Create additional veterinarian profiles
        $this->call(VeterinarianProfileSeeder::class);

        // 3. Seed treatment types (needed for treatments)
        $this->call(TreatmentTypesSeeder::class);
        
        // 4. Seed vaccine types (needed for vaccinations)
        $this->call(VaccineTypeSeeder::class);
        
        // 5. Create appointments and medical records
        Appointment::factory()->count(30)->create();
        MedicalRecord::factory()->count(30)->create();

        // 6. Create treatments and vaccinations
        $this->call(TreatmentSeeder::class);
        $this->call(VaccinationSeeder::class);
    }
}

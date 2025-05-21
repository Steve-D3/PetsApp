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



        User::factory(20)->create();
        Pet::factory(20)->create();

        // Seed vet clinics before veterinarian profiles since profiles reference clinics
        $this->call(VetClinicSeeder::class);


        VeterinarianProfile::factory()->create([
            'user_id' => 2,
            "license_number" => "123456",
            "specialty" => "General Practice",
            "biography" => "I am a veterinarian with 10 years of experience.",
            "phone_number" => "123-456-7890",
            "vet_clinic_id" => 1,
            "off_days" => [
                "Monday"
            ]
        ]);


        $this->call(VeterinarianProfileSeeder::class);

        Appointment::factory()->count(30)->create();
        MedicalRecord::factory()->count(30)->create();

        // Treatment types should be seeded before treatments
        $this->call(TreatmentTypesSeeder::class);
        $this->call(TreatmentSeeder::class);

        // Vaccine types should be seeded before vaccinations
        $this->call(VaccineTypeSeeder::class);
        $this->call(VaccinationSeeder::class);
    }
}

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
        User::factory(10)->create();
        Pet::factory(10)->create();
        
        // Seed vet clinics before veterinarian profiles since profiles reference clinics
        $this->call(VetClinicSeeder::class);
        $this->call(VeterinarianProfileSeeder::class);
        
        Appointment::factory()->count(20)->create();
        MedicalRecord::factory()->count(20)->create();
        
        // Treatment types should be seeded before treatments
        $this->call(TreatmentTypesSeeder::class);
        $this->call(TreatmentSeeder::class);
        
        // Vaccine types should be seeded before vaccinations
        $this->call(VaccineTypeSeeder::class);
        $this->call(VaccinationSeeder::class);


        // Create a test user with admin privileges (using 'vet' role which should have admin access)
        User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin', // Using 'vet' role which should have admin privileges
            'email_verified_at' => now(),
        ]);
    }
}

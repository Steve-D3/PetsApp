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
        $this->call(VeterinarianProfileSeeder::class);
        Appointment::factory()->count(20)->create();
        MedicalRecord::factory()->count(20)->create();
        Treatment::factory()->count(20)->create();
        $this->call(TreatmentTypesSeeder::class);


        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

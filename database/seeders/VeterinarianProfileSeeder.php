<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\VetClinic;
use App\Models\VeterinarianProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class VeterinarianProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure vet clinics exist
        if (VetClinic::count() === 0) {
            VetClinic::factory()->count(3)->create();
        }

        $clinics = VetClinic::all();
        
        // Common veterinary specialties
        $specialties = [
            'Small Animal Medicine', 'Surgery', 'Dentistry', 'Dermatology', 'Cardiology',
            'Neurology', 'Oncology', 'Ophthalmology', 'Radiology', 'Emergency & Critical Care'
        ];

        // Create 5-10 veterinarian profiles
        $count = rand(5, 10);
        
        for ($i = 1; $i <= $count; $i++) {
            $firstName = fake()->firstName();
            $lastName = fake()->lastName();
            $email = Str::lower($firstName[0] . $lastName . "@example.com");
            
            // Ensure email is unique
            $email = User::where('email', $email)->exists() 
                ? Str::lower($firstName[0] . $lastName . $i . "@example.com") 
                : $email;
            
            // Create user
            $user = User::create([
                'name' => "Dr. $firstName $lastName",
                'email' => $email,
                'password' => Hash::make('password'),
                'role' => 'vet',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create veterinarian profile with only the fields that exist in the database
            VeterinarianProfile::create([
                'user_id' => $user->id,
                'license_number' => 'VET-' . strtoupper(Str::random(2)) . '-' . 
                                    str_pad($i, 4, '0', STR_PAD_LEFT),
                'specialty' => fake()->randomElement($specialties),
                'biography' => $this->generateBiography($firstName, $lastName),
                'phone_number' => $this->generatePhoneNumber(),
                'vet_clinic_id' => $clinics->random()->id,
                'off_days' => json_encode($this->generateOffDays()),
            ]);
            
            $this->command->info("Created veterinarian profile for Dr. $firstName $lastName");
        }
    }
    
    /**
     * Generate a realistic phone number
     */
    private function generatePhoneNumber(): string
    {
        return sprintf('+1 (%03d) %03d-%04d', 
            rand(200, 999), 
            rand(200, 999), 
            rand(1000, 9999)
        );
    }
    
    /**
     * Generate off days (weekends plus some random days)
     */
    private function generateOffDays(): array
    {
        $weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        
        // Always off on Sunday
        $offDays = ['Sunday'];
        
        // 30% chance to be off on Saturday
        if (fake()->boolean(30)) {
            $offDays[] = 'Saturday';
        }
        
        // Random 1-2 weekdays off
        $weekdayOff = collect($weekdays)
            ->filter(fn($day) => !in_array($day, ['Saturday', 'Sunday']))
            ->random(rand(0, 2))
            ->toArray();
            
        return array_values(array_unique($weekdayOff));
    }
    
    /**
     * Generate a simple biography
     */
    private function generateBiography(string $firstName, string $lastName): string
    {
        $yearsExperience = rand(1, 30);
        $year = date('Y') - $yearsExperience;
        $university = fake()->randomElement([
            'University of California, Davis',
            'Cornell University',
            'Colorado State University',
            'University of Pennsylvania',
            'Texas A&M University'
        ]);
        
        return "Dr. $lastName graduated from $university in $year with a Doctor of Veterinary Medicine degree. " .
               "With $yearsExperience years of experience, Dr. $lastName is dedicated to providing the highest " .
               "quality care for your pets. When not at the clinic, Dr. $lastName enjoys spending time with " .
               "family and participating in outdoor activities.";
    }
}

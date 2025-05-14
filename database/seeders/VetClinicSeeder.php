<?php

namespace Database\Seeders;

use App\Models\VetClinic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class VetClinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Don't seed if we already have clinics
        if (VetClinic::count() > 0) {
            $this->command->info('Vet clinics already exist. Skipping seeding.');
            return;
        }

        $cities = [
            'Brussels' => [
                'postal_codes' => ['1000', '1020', '1030', '1040', '1050'],
                'areas' => ['European Quarter', 'Sablon', 'Marolles', 'Ixelles', 'Uccle']
            ],
            'Antwerp' => [
                'postal_codes' => ['2000', '2018', '2020', '2030', '2050'],
                'areas' => ['Centraal Station', 'Zuid', 'Eilandje', 'Zurenborg', 'Berchem']
            ],
            'Ghent' => [
                'postal_codes' => ['9000', '9030', '9031', '9032', '9040'],
                'areas' => ['Sint-Pieters', 'Dampoort', 'Sint-Amandsberg', 'Ledeberg', 'Gentbrugge']
            ],
            'Bruges' => [
                'postal_codes' => ['8000', '8200', '8210', '8310'],
                'areas' => ['Historic Center', 'Sint-Andries', 'Sint-Michiels', 'Assebroek']
            ],
            'Liège' => [
                'postal_codes' => ['4000', '4020', '4030', '4040'],
                'areas' => ['Le Carré', 'Outremeuse', 'Sainte-Marguerite', 'Cointe']
            ]
        ];

        $clinics = [];
        $clinicNames = [
            'Animal Care Center', 'Paws & Claws', 'Pet Wellness Clinic', 
            'Happy Tails Veterinary', 'Paw Prints Vet', 'Whiskers & Wags',
            'VetCare Associates', 'The Pet Doctors', 'Companion Animal Hospital',
            'Healing Paws', 'PetVet Clinic', 'Animal Wellness Center'
        ];

        foreach ($cities as $city => $data) {
            // Create 1-3 clinics per city
            $numClinics = rand(1, 3);
            
            for ($i = 1; $i <= $numClinics; $i++) {
                $area = $data['areas'][array_rand($data['areas'])];
                $postalCode = $data['postal_codes'][array_rand($data['postal_codes'])];
                $clinicName = $clinicNames[array_rand($clinicNames)] . ' ' . $area;
                
                // Make sure clinic name is unique
                while (in_array($clinicName, array_column($clinics, 'name'))) {
                    $clinicName = $clinicNames[array_rand($clinicNames)] . ' ' . $area . ' ' . rand(1, 5);
                }
                
                $domain = Str::slug(str_replace(' ', '', $clinicName), '');
                $email = strtolower("contact@{$domain}.be");
                
                $clinics[] = [
                    'name' => $clinicName,
                    'address' => $this->generateAddress($area, $city),
                    'city' => $city,
                    'postal_code' => $postalCode,
                    'country' => 'Belgium',
                    'phone' => $this->generateBelgianPhoneNumber(),
                    'email' => $email,
                    'website' => "https://{$domain}.be",
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Insert all clinics
        VetClinic::insert($clinics);
        
        $this->command->info(sprintf('Created %d vet clinics.', count($clinics)));
    }
    
    /**
     * Generate a realistic Belgian address
     */
    private function generateAddress(string $area, string $city): string
    {
        $streetTypes = ['Street', 'Avenue', 'Boulevard', 'Lane', 'Road', 'Square'];
        $streetNames = [
            'Main', 'Church', 'Park', 'Station', 'Market', 'School', 'Hospital', 
            'Castle', 'Churchill', 'Roosevelt', 'De Gaulle', 'Queen', 'King',
            'Oak', 'Maple', 'Cedar', 'Pine', 'Elm', 'Birch', 'Willow'
        ];
        
        $street = sprintf('%s %s %s', 
            $streetNames[array_rand($streetNames)],
            $streetTypes[array_rand($streetTypes)],
            rand(1, 200)
        );
        
        // Sometimes add a box number
        if (rand(1, 4) === 1) { // 25% chance
            $street .= sprintf(', box %s', rand(1, 50));
        }
        
        return $street;
    }
    
    /**
     * Generate a Belgian phone number
     */
    private function generateBelgianPhoneNumber(): string
    {
        $prefixes = ['2', '3', '4', '9']; // Common Belgian area codes
        $prefix = $prefixes[array_rand($prefixes)];
        $number = '';
        
        // Generate 7 more digits (Belgian numbers are 9 digits total including area code)
        for ($i = 0; $i < 7; $i++) {
            $number .= rand(0, 9);
        }
        
        return sprintf('+32 %s %s %s', 
            $prefix, 
            substr($number, 0, 2), 
            substr($number, 2)
        );
    }
}

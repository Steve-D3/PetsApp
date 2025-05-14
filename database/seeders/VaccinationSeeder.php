<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;

class VaccinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        // Get the necessary data from related tables
        $pets = DB::table('pets')->get();
        $vaccineTypes = DB::table('vaccine_types')->get();
        // Get all veterinarian profiles
        $veterinarians = DB::table('veterinarian_profiles')->get();
        $staffIds = $veterinarians->pluck('id')->toArray();

        // If no veterinarian profiles exist, we need to handle this case
        if (empty($staffIds)) {
            $this->command->error('No veterinarian profiles found. Please run the VeterinarianProfileSeeder first.');
            return;
        }

        // Collect medical records for reference
        $medicalRecords = DB::table('medical_records')->get()->groupBy('pet_id');

        $vaccinations = [];
        $count = 0;

        $this->command->info('Starting to create vaccination records...');

        foreach ($pets as $pet) {
            $species = $pet->species;
            $petAge = Carbon::parse($pet->birth_date)->diffInDays(Carbon::now());

            // Get relevant vaccine types for this species
            $relevantVaccineTypes = $vaccineTypes->filter(function($vaccineType) use ($species) {
                return strpos($vaccineType->for_species, $species) !== false;
            });

            foreach ($relevantVaccineTypes as $vaccineType) {
                // Skip if pet is too young for this vaccine
                if ($petAge < $vaccineType->minimum_age_days) {
                    continue;
                }

                // 70% chance of having this vaccine
                if (!$faker->boolean(70)) {
                    continue;
                }

                // Create a base vaccination date (random in past)
                $administrationDate = Carbon::now()->subDays($faker->numberBetween(7, 300));

                // Get a random medical record for this pet if available
                $medicalRecordId = null;
                if (isset($medicalRecords[$pet->id]) && count($medicalRecords[$pet->id]) > 0) {
                    $petRecords = $medicalRecords[$pet->id]->toArray();
                    $medicalRecordId = $faker->randomElement($petRecords)->id;
                }

                // Calculate next due date based on vaccine validity
                $nextDueDate = null;
                if ($vaccineType->default_validity_period) {
                    $nextDueDate = (clone $administrationDate)->addDays($vaccineType->default_validity_period);
                }

                // Determine if this is a booster
                $isBooster = $faker->boolean(30);

                // Select a manufacturer from the comma-separated list
                $manufacturers = explode(',', $vaccineType->common_manufacturers);
                $manufacturer = $faker->randomElement($manufacturers);

                // Create the vaccination record
                $vaccination = [
                    'pet_id' => $pet->id,
                    'medical_record_id' => $medicalRecordId,
                    'vaccine_type_id' => $vaccineType->id,
                    'manufacturer' => $manufacturer,
                    'batch_number' => $faker->bothify('??###??'),
                    'serial_number' => $faker->bothify('??####?####??'),
                    'expiration_date' => Carbon::now()->addMonths($faker->numberBetween(6, 24)),
                    'administration_date' => $administrationDate,
                    'next_due_date' => $nextDueDate,
                    'administered_by' => $faker->boolean(90) ? $faker->randomElement($staffIds) : null, // 90% chance of having an admin, 10% null
                    'administration_site' => $faker->randomElement(['Left shoulder', 'Right shoulder', 'Left hip', 'Right hip', 'Scruff']),
                    'administration_route' => $vaccineType->default_administration_route,
                    'dose' => $species == 'Dog' ? 1.0 : 0.5,
                    'dose_unit' => 'ml',
                    'is_booster' => $isBooster,
                    'certification_number' => $vaccineType->name == 'Rabies' ? $faker->bothify('RAB-########') : null,
                    'reaction_observed' => $faker->boolean(5), // 5% chance of reaction
                    'reaction_details' => $faker->boolean(5) ? $faker->sentence : null,
                    'notes' => $faker->boolean(30) ? $faker->sentence : null,
                    'cost' => $vaccineType->default_cost * $faker->randomFloat(2, 0.9, 1.1), // Small variation in cost
                    'reminder_sent' => $faker->boolean(20),
                    'created_at' => $administrationDate,
                    'updated_at' => $administrationDate
                ];

                $vaccinations[] = $vaccination;
                $count++;

                // Add booster shot if needed and pet is old enough
                if ($vaccineType->requires_booster && !$isBooster && $faker->boolean(80)) {
                    $boosterDate = (clone $administrationDate)->addDays($vaccineType->booster_waiting_period);

                    // Only add booster if it would be in the past
                    if ($boosterDate->isPast()) {
                        $boosterVaccination = [
                            'pet_id' => $pet->id,
                            'medical_record_id' => $medicalRecordId,
                            'vaccine_type_id' => $vaccineType->id,
                            'manufacturer' => $manufacturer, // Use same manufacturer for consistency
                            'batch_number' => $faker->bothify('??###??'),
                            'serial_number' => $faker->bothify('??####?####??'),
                            'expiration_date' => Carbon::now()->addMonths($faker->numberBetween(6, 24)),
                            'administration_date' => $boosterDate,
                            'next_due_date' => (clone $boosterDate)->addDays($vaccineType->default_validity_period),
                            'administered_by' => $faker->boolean(90) ? $faker->randomElement($staffIds) : null, // 90% chance of having an admin, 10% null
                            'administration_site' => $faker->randomElement(['Left shoulder', 'Right shoulder', 'Left hip', 'Right hip', 'Scruff']),
                            'administration_route' => $vaccineType->default_administration_route,
                            'dose' => $species == 'Dog' ? 1.0 : 0.5,
                            'dose_unit' => 'ml',
                            'is_booster' => true,
                            'certification_number' => $vaccineType->name == 'Rabies' ? $faker->bothify('RAB-########') : null,
                            'reaction_observed' => $faker->boolean(5),
                            'reaction_details' => $faker->boolean(5) ? $faker->sentence : null,
                            'notes' => $faker->boolean(30) ? "Booster for vaccination given on " . $administrationDate->format('Y-m-d') : null,
                            'cost' => $vaccineType->default_cost * $faker->randomFloat(2, 0.9, 1.1),
                            'reminder_sent' => $faker->boolean(20),
                            'created_at' => $boosterDate,
                            'updated_at' => $boosterDate
                        ];

                        $vaccinations[] = $boosterVaccination;
                        $count++;
                    }
                }

                // If we've accumulated a lot of records, insert them in chunks to avoid memory issues
                if (count($vaccinations) >= 100) {
                    DB::table('vaccinations')->insert($vaccinations);
                    $this->command->info('Inserted batch of ' . count($vaccinations) . ' vaccination records');
                    $vaccinations = []; // Reset the array
                }
            }
        }

        // Insert any remaining vaccination records
        if (count($vaccinations) > 0) {
            DB::table('vaccinations')->insert($vaccinations);
            $this->command->info('Inserted final batch of ' . count($vaccinations) . ' vaccination records');
        }

        $this->command->info('Created a total of ' . $count . ' vaccination records');

    }
}

<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class TreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        
        // Get all medical records with their pets
        $medicalRecords = DB::table('medical_records')
            ->join('pets', 'medical_records.pet_id', '=', 'pets.id')
            ->select('medical_records.*', 'pets.species')
            ->get()
            ->groupBy('pet_id');

        // Get all treatment types grouped by category
        $treatmentTypes = DB::table('treatment_types')
            ->get()
            ->groupBy('category');

        // Get all veterinarian profiles
        $veterinarianIds = DB::table('veterinarian_profiles')
            ->pluck('user_id')
            ->toArray();

        if (empty($veterinarianIds)) {
            $this->command->error('No veterinarian profiles found. Please run the VeterinarianProfileSeeder first.');
            return;
        }

        $treatments = [];
        $now = Carbon::now();
        $count = 0;

        $this->command->info('Starting to create treatment records...');

        foreach ($medicalRecords as $petId => $records) {
            // Each pet can have multiple medical records
            foreach ($records as $record) {
                // Determine how many treatments to create for this record (1-4)
                $numTreatments = $faker->numberBetween(1, 4);
                
                // Get a random category for this record's treatments
                $category = $faker->randomElement(array_keys($treatmentTypes->toArray()));
                $categoryTreatments = $treatmentTypes[$category];
                
                // Shuffle to get random treatments from this category
                $selectedTreatments = $faker->randomElements(
                    $categoryTreatments,
                    min($numTreatments, count($categoryTreatments))
                );

                foreach ($selectedTreatments as $treatmentType) {
                    $administeredAt = Carbon::parse($record->record_date)
                        ->addMinutes($faker->numberBetween(0, 120));
                    
                    $quantity = $treatmentType->default_unit === 'tooth' 
                        ? $faker->numberBetween(1, 4) 
                        : ($treatmentType->default_unit === 'session' 
                            ? $faker->numberBetween(1, 6) 
                            : 1);
                    
                    $cost = $treatmentType->default_cost * $quantity * $faker->randomFloat(1, 0.9, 1.2);
                    
                    $treatments[] = [
                        'medical_record_id' => $record->id,
                        'treatment_type_id' => $treatmentType->id,
                        'name' => $treatmentType->name,
                        'category' => $treatmentType->category,
                        'description' => $faker->optional(0.7)->sentence(),
                        'cost' => round($cost, 2),
                        'quantity' => $quantity,
                        'unit' => $treatmentType->default_unit,
                        'completed' => $faker->boolean(90), // 90% completed
                        'administered_at' => $administeredAt,
                        'administered_by' => $faker->boolean(85) ? $faker->randomElement($veterinarianIds) : null,
                        'created_at' => $administeredAt,
                        'updated_at' => $administeredAt,
                    ];
                    
                    $count++;
                    
                    // Insert in chunks to avoid memory issues
                    if ($count % 100 === 0) {
                        DB::table('treatments')->insert($treatments);
                        $this->command->info("Inserted $count treatment records...");
                        $treatments = [];
                    }
                }
            }
        }
        
        // Insert any remaining treatments
        if (!empty($treatments)) {
            DB::table('treatments')->insert($treatments);
        }
        
        $this->command->info("Created a total of $count treatment records.");
    }
}

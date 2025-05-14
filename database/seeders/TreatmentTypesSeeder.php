<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class TreatmentTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $treatmentsByCategory = [
            'Medication' => [
                'Injectable antibiotic' => ['cost' => 25.00, 'unit' => 'injection'],
                'Oral antibiotic prescription' => ['cost' => 15.00, 'unit' => 'prescription'],
                'Anti-inflammatory injection' => ['cost' => 30.00, 'unit' => 'injection'],
                'Parasite treatment' => ['cost' => 18.50, 'unit' => 'dose'],
                'Pain medication' => ['cost' => 22.00, 'unit' => 'prescription']
            ],
            'Procedure' => [
                'Wound cleaning and dressing' => ['cost' => 40.00, 'unit' => 'procedure'],
                'Abscess drainage' => ['cost' => 75.00, 'unit' => 'procedure'],
                'Nail trim' => ['cost' => 15.00, 'unit' => 'service'],
                'Ear cleaning' => ['cost' => 25.00, 'unit' => 'procedure'],
                'Anal gland expression' => ['cost' => 20.00, 'unit' => 'procedure']
            ],
            'Surgery' => [
                'Mass removal' => ['cost' => 350.00, 'unit' => 'procedure'],
                'Dental extraction' => ['cost' => 45.00, 'unit' => 'tooth'],
                'Laceration repair' => ['cost' => 150.00, 'unit' => 'procedure'],
                'Foreign body removal' => ['cost' => 650.00, 'unit' => 'procedure'],
                'Abscess surgery' => ['cost' => 200.00, 'unit' => 'procedure']
            ],
            'Diagnostic' => [
                'Blood pressure measurement' => ['cost' => 25.00, 'unit' => 'test'],
                'Otoscopic examination' => ['cost' => 30.00, 'unit' => 'procedure'],
                'Ophthalmic examination' => ['cost' => 35.00, 'unit' => 'procedure'],
                'Cytology' => ['cost' => 45.00, 'unit' => 'test'],
                'Fine needle aspirate' => ['cost' => 65.00, 'unit' => 'procedure']
            ],
            'Laboratory' => [
                'Complete blood count' => ['cost' => 75.00, 'unit' => 'test'],
                'Chemistry panel' => ['cost' => 120.00, 'unit' => 'test'],
                'Urinalysis' => ['cost' => 45.00, 'unit' => 'test'],
                'Fecal examination' => ['cost' => 35.00, 'unit' => 'test'],
                'Thyroid panel' => ['cost' => 95.00, 'unit' => 'test']
            ],
            'Imaging' => [
                'X-ray' => ['cost' => 180.00, 'unit' => 'view'],
                'Ultrasound' => ['cost' => 250.00, 'unit' => 'study'],
                'Echocardiogram' => ['cost' => 350.00, 'unit' => 'procedure'],
                'Dental radiographs' => ['cost' => 150.00, 'unit' => 'study'],
                'CT scan' => ['cost' => 650.00, 'unit' => 'study']
            ],
            'Preventive' => [
                'Core vaccination' => ['cost' => 45.00, 'unit' => 'vaccine'],
                'Rabies vaccination' => ['cost' => 25.00, 'unit' => 'vaccine'],
                'Heartworm test' => ['cost' => 45.00, 'unit' => 'test'],
                'Flea/tick prevention' => ['cost' => 25.00, 'unit' => 'dose'],
                'Microchip placement' => ['cost' => 45.00, 'unit' => 'procedure']
            ],
            'Physical Therapy' => [
                'Laser therapy' => ['cost' => 40.00, 'unit' => 'session'],
                'Hydrotherapy' => ['cost' => 65.00, 'unit' => 'session'],
                'Massage therapy' => ['cost' => 45.00, 'unit' => 'session'],
                'Range of motion exercises' => ['cost' => 50.00, 'unit' => 'session'],
                'Electrical stimulation' => ['cost' => 55.00, 'unit' => 'session']
            ],
            'Fluid Therapy' => [
                'IV catheter placement' => ['cost' => 45.00, 'unit' => 'procedure'],
                'IV fluid administration' => ['cost' => 75.00, 'unit' => 'day'],
                'Subcutaneous fluids' => ['cost' => 35.00, 'unit' => 'procedure'],
                'Blood transfusion' => ['cost' => 350.00, 'unit' => 'unit'],
                'Plasma transfusion' => ['cost' => 250.00, 'unit' => 'unit']
            ],
            'Dental' => [
                'Dental cleaning' => ['cost' => 275.00, 'unit' => 'procedure'],
                'Dental scaling and polishing' => ['cost' => 225.00, 'unit' => 'procedure'],
                'Tooth extraction' => ['cost' => 35.00, 'unit' => 'tooth'],
                'Dental radiographs' => ['cost' => 120.00, 'unit' => 'study'],
                'Oral mass biopsy' => ['cost' => 175.00, 'unit' => 'procedure']
            ]
        ];

        $treatmentTypes = [];

        foreach ($treatmentsByCategory as $category => $treatments) {
            foreach ($treatments as $name => $details) {
                $treatmentTypes[] = [
                    'name' => $name,
                    'category' => $category,
                    'description' => null, // You can add descriptions if needed
                    'default_cost' => $details['cost'],
                    'default_unit' => $details['unit'],
                    'created_at' => $now,
                    'updated_at' => $now
                ];
            }
        }

        DB::table('treatment_types')->insert($treatmentTypes);
    }
}

<?php

namespace Database\Factories;

use App\Models\MedicalRecord;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Treatment>
 */
class TreatmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Common veterinary treatment categories
        $categories = [
            'Medication',
            'Procedure',
            'Surgery',
            'Diagnostic',
            'Laboratory',
            'Imaging',
            'Preventive',
            'Physical Therapy',
            'Fluid Therapy',
            'Dental'
        ];

        // Common treatments by category
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

        // Select a random category
        $category = $this->faker->randomElement($categories);

        // Select a random treatment from that category
        $treatmentName = array_key_first($this->faker->randomElement([$treatmentsByCategory[$category]]));
        $treatmentDetails = $treatmentsByCategory[$category][$treatmentName];

        // Set random quantity (most treatments are qty 1, but sometimes more)
        $quantity = $this->faker->boolean(80) ? 1 : $this->faker->numberBetween(1, 5);

        // Set random completed status (most are completed)
        $completed = $this->faker->boolean(90);

        // Set administered date and user if completed
        $administeredAt = $completed ? $this->faker->dateTimeBetween('-3 days', 'now') : null;
        $administeredBy = $completed ? User::where('role', 'vet')->inRandomOrder()->first()?->id : null;

        // If we don't have any vet users yet, don't set administered_by
        if (!$administeredBy && $completed) {
            $administeredBy = null;
        }

        return [
            'medical_record_id' => MedicalRecord::inRandomOrder()->first()?->id ?? MedicalRecord::factory(),
            'name' => $treatmentName,
            'category' => $category,
            'description' => $this->faker->boolean(70) ? $this->faker->paragraph(1) : null,
            'cost' => $treatmentDetails['cost'],
            'quantity' => $quantity,
            'unit' => $treatmentDetails['unit'],
            'completed' => $completed,
            'administered_at' => $administeredAt,
            'administered_by' => $administeredBy,
        ];
    }

    /**
     * Indicate that the treatment is completed.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function completed()
    {
        return $this->state(function (array $attributes) {
            return [
                'completed' => true,
                'administered_at' => $this->faker->dateTimeBetween('-3 days', 'now'),
                'administered_by' => User::where('role', 'vet')->inRandomOrder()->first()?->id,
            ];
        });
    }

    /**
     * Indicate that the treatment is pending.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function pending()
    {
        return $this->state(function (array $attributes) {
            return [
                'completed' => false,
                'administered_at' => null,
                'administered_by' => null,
            ];
        });
    }
}

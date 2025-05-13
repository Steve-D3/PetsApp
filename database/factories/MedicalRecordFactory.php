<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Pet;
use App\Models\VeterinarianProfile;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MedicalRecord;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedicalRecord>
 */
class MedicalRecordFactory extends Factory
{

    protected $model = MedicalRecord::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $followUpRequired = $this->faker->boolean(30);
        $recordDate = $this->faker->dateTimeBetween('now', '+2 years');

        // Common diagnoses in veterinary medicine
        $diagnoses = [
            'Otitis Externa',
            'Gastroenteritis',
            'Dermatitis',
            'Urinary Tract Infection',
            'Canine Parvovirus',
            'Feline Upper Respiratory Infection',
            'Arthritis',
            'Dental Disease',
            'Obesity',
            'Diabetes Mellitus',
            'Pancreatitis',
            'Hyperthyroidism',
            'Hypothyroidism',
            'Canine Distemper',
            'Feline Leukemia',
            'Heartworm Disease',
            'Tick-borne Disease',
            'Allergic Dermatitis',
            'Trauma/Laceration',
            'Foreign Body Ingestion'
        ];

        // Common treatment plans
        $treatments = [
            'Antibiotics prescribed for 10 days',
            'Anti-inflammatory medication for 7 days',
            'Fluid therapy recommended',
            'Dietary modification: switch to prescription diet',
            'Surgery scheduled for next week',
            'Topical medication applied twice daily',
            'Pain management protocol initiated',
            'Dental cleaning performed, follow-up in 6 months',
            'Wound cleaned and dressed, recheck in 3 days',
            'Blood work monitoring recommended monthly',
            'Prescription diet: low-fat formula',
            'Physical therapy twice weekly for 1 month',
            'Vaccination booster administered',
            'Parasite treatment administered, reapply in 30 days',
            'Insulin therapy initiated, 5 units BID',
            'Ear cleaning performed, continue at home',
            'Strict rest and limited activity for 14 days',
            'Steroid treatment tapered over 10 days',
            'IV catheter placed for fluid administration',
            'Hospitalization for 48-hour observation'
        ];

        // Common medications
        $medications = [
            'Amoxicillin 50mg BID for 10 days',
            'Carprofen 25mg BID for 7 days',
            'Cephalexin 300mg BID for 14 days',
            'Prednisone 5mg SID tapering dose',
            'Omeprazole 10mg daily for 7 days',
            'Metronidazole 250mg BID for 5 days',
            'Clavamox 62.5mg BID for 10 days',
            'Cerenia 16mg daily for 5 days',
            'Apoquel 5.4mg BID for 14 days',
            'Trazodone 50mg as needed for anxiety',
            'Gabapentin 100mg TID for pain',
            'Furosemide 12.5mg BID',
            'Insulin 4 units BID',
            'Methimazole 2.5mg BID',
            'Convenia 80mg/ml injection',
            'Enrofloxacin 68mg daily for 7 days',
            'Famotidine 5mg daily',
            'Buprenorphine 0.3mg/ml as directed',
            'Otibiotic ear drops BID for 7 days',
            'Theophylline 100mg BID'
        ];

        return [
            'pet_id' => Pet::inRandomOrder()->first()?->id ?? Pet::factory(),
            'veterinarian_profile_id' => VeterinarianProfile::inRandomOrder()->first()?->id ?? VeterinarianProfile::factory(),
            'appointment_id' => Appointment::inRandomOrder()->first()?->id ?? Appointment::factory(),
            'record_date' => $recordDate,
            'chief_complaint' => $this->faker->sentence($this->faker->numberBetween(3, 8)),
            'history' => $this->faker->paragraph($this->faker->numberBetween(2, 5)),
            'physical_examination' => 'T: ' . $this->faker->randomFloat(1, 37.5, 40.5) . '°C, ' .
                                     'HR: ' . $this->faker->numberBetween(60, 180) . ' bpm, ' .
                                     'RR: ' . $this->faker->numberBetween(10, 40) . ' rpm. ' .
                                     $this->faker->paragraph($this->faker->numberBetween(2, 4)),
            'diagnosis' => $this->faker->randomElement($diagnoses),
            'treatment_plan' => $this->faker->randomElement($treatments),
            'medications' => $this->faker->boolean(80) ? $this->faker->randomElement($medications) : null,
            'notes' => $this->faker->boolean(70) ? $this->faker->paragraph($this->faker->numberBetween(1, 3)) : null,
            'weight' => $this->faker->randomFloat(2, 0.5, 80),
            'temperature' => $this->faker->randomFloat(1, 37.5, 40.5),
            'heart_rate' => $this->faker->numberBetween(60, 180),
            'respiratory_rate' => $this->faker->numberBetween(10, 40),
            'follow_up_required' => $followUpRequired,
            'follow_up_date' => $followUpRequired ? Carbon::parse($recordDate)->addDays($this->faker->numberBetween(7, 30)) : null,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Pet;
use App\Models\User;
use App\Models\VeterinarianProfile;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MedicalRecord;
use Illuminate\Support\Facades\DB;
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
    /**
     * Get available time slots for a veterinarian on a specific date
     */
    protected function getAvailableSlots($veterinarianId, $date)
    {
        $date = Carbon::parse($date);

        // Get the veterinarian's off days
        $veterinarian = VeterinarianProfile::where('user_id', $veterinarianId)->first();

        if (!$veterinarian) {
            return [];
        }

        // Handle both array and JSON string formats for off_days
        $offDays = $veterinarian->off_days ?? [];
        if (is_string($offDays)) {
            $offDays = json_decode($offDays, true) ?? [];
        } elseif (!is_array($offDays)) {
            $offDays = [];
        }

        $dayName = $date->format('l');

        // Check if the selected day is an off day
        if (in_array($dayName, $offDays)) {
            return [];
        }

        // Define working hours (9:00-12:00 and 13:00-16:00)
        $morningStart = $date->copy()->setTime(9, 0);
        $morningEnd = $date->copy()->setTime(12, 0);
        $afternoonStart = $date->copy()->setTime(13, 0);
        $afternoonEnd = $date->copy()->setTime(16, 0);

        // Generate 30-minute slots
        $morningSlots = CarbonPeriod::create($morningStart, '30 minutes', $morningEnd->copy()->subMinutes(30));
        $afternoonSlots = CarbonPeriod::create($afternoonStart, '30 minutes', $afternoonEnd->copy()->subMinutes(30));

        // Merge both morning and afternoon slots
        $allSlots = collect(iterator_to_array($morningSlots))
            ->merge(collect(iterator_to_array($afternoonSlots)));

        // Get all booked slots for the veterinarian on this day
        $booked = Appointment::where('veterinarian_id', $veterinarianId)
            ->whereDate('start_time', $date)
            ->pluck('start_time')
            ->map(function ($time) {
                return Carbon::parse($time)->format('Y-m-d H:i:s');
            })
            ->toArray();

        // Filter out booked slots
        return $allSlots->filter(function ($slot) use ($booked) {
            return !in_array($slot->format('Y-m-d H:i:s'), $booked);
        })->values()->toArray();
    }

    /**
     * Find the next available appointment slot
     */
    protected function findNextAvailableSlot($veterinarianId, $startDate)
    {
        $date = Carbon::parse($startDate);
        $attempts = 0;
        $maxAttempts = 30; // Prevent infinite loops

        while ($attempts < $maxAttempts) {
            $slots = $this->getAvailableSlots($veterinarianId, $date);

            if (!empty($slots)) {
                return $slots[array_rand($slots)];
            }

            // Move to the next day
            $date->addDay();
            $attempts++;

            // Skip weekends if needed
            if ($date->isWeekend()) {
                $date->nextWeekday();
            }
        }

        // If no slots found, return a fallback date (next week at 9 AM)
        return Carbon::parse($startDate)->addWeek()->setTime(9, 0);
    }

    public function definition(): array
    {
        $followUpRequired = $this->faker->boolean(70);
        $recordDate = $this->faker->dateTimeBetween('-1 year', 'now');

        // Get or create a veterinarian
        $veterinarian = VeterinarianProfile::inRandomOrder()->first() ?? VeterinarianProfile::factory()->create();

        // Get or create a pet
        $pet = Pet::inRandomOrder()->first() ?? Pet::factory()->create();

        // Create a new appointment for this medical record
        $appointment = Appointment::inRandomOrder()->first() ??
            Appointment::create([
                'pet_id' => $pet->id,
                'veterinarian_id' => $veterinarian->user_id,
                'start_time' => $recordDate,
                'end_time' => (clone $recordDate)->addHour(),
                'status' => 'completed',
                'notes' => $this->faker->optional(0.7)->sentence(),
            ]);

        // Initialize follow-up variables
        $followUpDate = null;
        $followUpAppointmentId = null;

        // Handle follow-up appointment if needed
        if ($followUpRequired) {
            // Set follow-up date between 1-4 weeks from record date
            $followUpDate = Carbon::parse($recordDate)->addDays($this->faker->numberBetween(7, 28));

            try {
                // Find next available slot for follow-up
                $followUpSlot = $this->findNextAvailableSlot($veterinarian->user_id, $followUpDate);

                if (!$followUpSlot) {
                    throw new \Exception('No available slots found for follow-up');
                }

                // Create follow-up appointment
                $followUpAppointment = Appointment::create([
                    'pet_id' => $pet->id,
                    'veterinarian_id' => $veterinarian->user_id,
                    'start_time' => $followUpSlot,
                    'end_time' => (clone $followUpSlot)->addHour(),
                    'status' => 'confirmed',
                    'notes' => 'Follow-up appointment',
                ]);

                $followUpAppointmentId = $followUpAppointment->id;
                $followUpDate = $followUpSlot; // Update to the actual slot time

            } catch (\Exception $e) {
                // Log the error
                \Log::error('Failed to create follow-up appointment: ' . $e->getMessage());

                // Reset follow-up if we couldn't create the appointment
                $followUpRequired = false;
                $followUpDate = null;
            }
        }

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
            'pet_id' => $pet->id,
            'veterinarian_profile_id' => $veterinarian->id,
            'appointment_id' => $appointment->id,
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
            'follow_up_date' => $followUpDate,
            'follow_up_appointment_id' => $followUpAppointmentId,
        ];
    }
}

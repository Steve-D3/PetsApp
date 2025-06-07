<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use App\Models\TreatmentType;
use App\Models\MedicalRecord;
use App\Models\VaccineType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class AppointmentDetails extends Component
{
    use WithPagination;

    public $appointment;
    public $notes;
    public $showAllMedicalRecords = false;
    public $showAllTreatments = false;
    public $showAllVaccinations = false;
    public $showMedicalRecordForm = false;
    public $showTreatmentForm = false;
    public $showVaccineForm = false;
    public $showMedicationForm = false;

    // Medical Record Form Properties
    public $chief_complaint = '';
    public $history = '';
    public $physical_examination = '';
    public $diagnosis = '';
    public $treatment_plan = '';
    public $medications = '';
    public $weight = null;
    public $temperature = null;
    public $heart_rate = null;
    public $respiratory_rate = null;
    public $follow_up_required = false;
    public $follow_up_date = null;
    public $showDatePicker = false;
    public $showTimeSlots = false;
    public $availableSlots = [];
    public $selectedDate;
    public $selectedTime;

    // Treatment Form Properties
    public $treatment_types;
    public $treatment_details;
    public $treatment_date;

    public $vaccine_types;
    public $vaccine_details;
    public $vaccine_date;



    public function mount(Appointment $appointment)
    {
        // Eager load relationships
        $appointment->load([
            'pet',
            'pet.owner',
            'pet.medicalRecords',
            'pet.medicalRecords.treatments',
            'pet.vaccinations',
            'vaccinations',
            'veterinarian'
        ]);

        $this->treatment_date = now();

        $this->appointment = $appointment;
        $this->notes = $appointment->notes;
        $this->treatment_types = TreatmentType::all();
        $this->vaccine_types = VaccineType::all();
    }

    public function showAllMedicalRecords()
    {
        $this->showAllMedicalRecords = true;
    }

    public function showAllTreatments()
    {
        $this->showAllTreatments = true;
    }

    public function showAllVaccinations()
    {
        $this->showAllVaccinations = true;
    }

    public function closeAllModals()
    {
        $this->showAllMedicalRecords = false;
        $this->showAllTreatments = false;
        $this->showAllVaccinations = false;
    }

    public function saveNotes()
    {
        $this->validate([
            'notes' => 'nullable|string|max:1000',
        ]);

        $this->appointment->update([
            'notes' => $this->notes,
        ]);

        $this->dispatch('show-message', ['message' => 'Notes updated successfully']);
    }

    public function createMedicalRecord()
    {
        $this->showMedicalRecordForm = true;
    }
    public function updatedSelectedDate($date)
    {
        if (!$date) {
            $this->showTimeSlots = false;
            return;
        }

        \Log::info("Fetching slots for date: {$date}");

        $url = "/vets/{$this->appointment->veterinarian_profile_id}/available-slots?date=" . urlencode($date);
        \Log::info("Request URL: " . $url);

        try {
            $response = Http::get(url($url));
            \Log::info("Response status: " . $response->status());
            \Log::info("Response body: " . $response->body());

            if ($response->successful()) {
                $this->availableSlots = $response->json('slots', []);
                $this->showTimeSlots = !empty($this->availableSlots);
                \Log::info("Available slots:", $this->availableSlots);
            } else {
                $this->availableSlots = [];
                $this->showTimeSlots = false;
                \Log::error("Failed to fetch slots. Status: " . $response->status());
            }
        } catch (\Exception $e) {
            \Log::error("Exception when fetching slots: " . $e->getMessage());
            $this->availableSlots = [];
            $this->showTimeSlots = false;
        }
    }
    public function saveMedicalRecord()
    {
        $validated = $this->validate([
            'chief_complaint' => 'required|string|max:1000',
            'history' => 'nullable|string|max:2000',
            'physical_examination' => 'nullable|string|max:2000',
            'diagnosis' => 'required|string|max:1000',
            'treatment_plan' => 'nullable|string|max:2000',
            'medications' => 'nullable|string|max:1000',
            'notes' => 'nullable|string|max:2000',
            'weight' => 'nullable|numeric|min:0|max:500',
            'temperature' => 'nullable|numeric|min:30|max:45',
            'heart_rate' => 'nullable|integer|min:0|max:300',
            'respiratory_rate' => 'nullable|integer|min:0|max:200',
            'follow_up_required' => 'boolean',
            'follow_up_date' => 'nullable|date|after:now|required_if:follow_up_required,true',
            'selectedDate' => 'required_if:follow_up_required,true|date',
            'selectedTime' => 'required_if:follow_up_required,true',
        ]);

        // Combine date and time if follow-up is required
        if ($this->follow_up_required && $this->selectedDate && $this->selectedTime) {
            $this->follow_up_date = Carbon::parse($this->selectedDate . ' ' . $this->selectedTime);
        }

        try {
            $medicalRecord = MedicalRecord::create([
                'pet_id' => $this->appointment->pet_id,
                'veterinarian_profile_id' => $this->appointment->veterinarian_profile_id,
                'appointment_id' => $this->appointment->id,
                'record_date' => now(),
                'chief_complaint' => $validated['chief_complaint'],
                'history' => $validated['history'] ?? null,
                'physical_examination' => $validated['physical_examination'] ?? null,
                'diagnosis' => $validated['diagnosis'],
                'treatment_plan' => $validated['treatment_plan'] ?? null,
                'medications' => $validated['medications'] ?? null,
                'notes' => $validated['notes'] ?? null,
                'weight' => $validated['weight'] ?? null,
                'temperature' => $validated['temperature'] ?? null,
                'heart_rate' => $validated['heart_rate'] ?? null,
                'respiratory_rate' => $validated['respiratory_rate'] ?? null,
                'follow_up_required' => $validated['follow_up_required'] ?? false,
                'follow_up_date' => $validated['follow_up_date'] ?? null,
            ]);

            $this->showMedicalRecordForm = false;

            // Reset form fields
            $this->reset([
                'chief_complaint',
                'history',
                'physical_examination',
                'diagnosis',
                'treatment_plan',
                'medications',
                'notes',
                'weight',
                'temperature',
                'heart_rate',
                'respiratory_rate',
                'follow_up_required',
                'follow_up_date'
            ]);

            $this->appointment->load('pet.medicalRecords');

            $this->dispatch('show-message', [
                'type' => 'success',
                'message' => 'Medical record created successfully!',
            ]);

        } catch (\Exception $e) {
            $this->dispatch('show-message', [
                'type' => 'error',
                'message' => 'Failed to create medical record. Please try again.',
            ]);
            \Log::error('Error creating medical record: ' . $e->getMessage());
        }
    }

    public function createTreatment()
    {
        $this->showTreatmentForm = true;
    }

    public function createVaccine()
    {
        $this->showVaccineForm = true;
    }

    public function createMedication()
    {
        $this->showMedicationForm = true;
    }

    public function updatedFollowUpRequired($value)
    {
        $this->follow_up_required = $value;
        if (!$value) {
            $this->follow_up_date = null;
        }
    }

    public function render()
    {
        $medicalRecord = $this->appointment->medicalRecord;
        return view('livewire.admin.appointment-details', [
            'medicalRecord' => $medicalRecord,
        ]);
    }
}

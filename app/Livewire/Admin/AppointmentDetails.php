<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use App\Models\TreatmentType;
use App\Models\MedicalRecord;
use App\Models\VaccineType;
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
    public $chief_complaint;
    public $diagnosis;
    public $treatment_plan;
    public $medications;

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

    public function saveMedicalRecord()
    {
        $this->validate([
            'chief_complaint' => 'required|string|max:255',
            'diagnosis' => 'required|string|max:255',
            'treatment_plan' => 'required|string|max:255',
            'medications' => 'nullable|string|max:255',
        ]);

        MedicalRecord::create([
            'appointment_id' => $this->appointment->id,
            'chief_complaint' => $this->chief_complaint,
            'diagnosis' => $this->diagnosis,
            'treatment_plan' => $this->treatment_plan,
            'medications' => $this->medications,
        ]);

        $this->showMedicalRecordForm = false;
        $this->reset(['chief_complaint', 'diagnosis', 'treatment_plan', 'medications']);

        $this->dispatch('show-message', ['message' => 'Medical record created successfully']);
        $this->appointment->load('medicalRecord');
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

    public function render()
    {
        $medicalRecord = $this->appointment->medicalRecord;
        return view('livewire.admin.appointment-details', [
            'medicalRecord' => $medicalRecord,
        ]);
    }
}

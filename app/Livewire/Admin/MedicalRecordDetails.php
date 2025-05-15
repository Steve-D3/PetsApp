<?php

namespace App\Livewire\Admin;

use App\Models\MedicalRecord;

class MedicalRecordDetails extends \Livewire\Component
{
    public $record;
    public $treatments;
    public $vaccinations;

    public function mount($pet, $record)
    {
        $this->record = MedicalRecord::with(['pet', 'vet.user', 'treatments.treatmentType', 'vaccinations.vaccinationType'])
            ->where('pet_id', $pet)
            ->where('id', $record)
            ->firstOrFail();

        $this->treatments = $this->record->treatments;
        $this->vaccinations = $this->record->vaccinations;
    }

    public function render()
    {
        return view('livewire.admin.medical-record-details');
    }

    public function redirectBack(): void
    {
        $this->redirectRoute('medical-records.index', $this->record->pet);
    }
}

<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\MedicalRecord;
use App\Models\Pet;
use Livewire\WithPagination;

class MedicalRecordsIndex extends Component
{
    use WithPagination;
    
    public $pet;
    public $search = '';
    public $sortField = 'record_date';
    public $sortDirection = 'desc';
    public $perPage = 10;
    public $showFilters = false;
    public $filters = [
        'diagnosis' => '',
        'start_date' => '',
        'end_date' => '',
        'follow_up_required' => '',
    ];

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'record_date'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function mount($pet = null)
    {
        if (is_numeric($pet)) {
            // If pet is an ID, find the pet
            $this->pet = Pet::with('owner')->findOrFail($pet);
        } elseif ($pet instanceof \App\Models\Pet) {
            // If pet is already a Pet model instance
            $this->pet = $pet->load('owner');
        } else {
            // Handle case where pet is not provided or invalid
            abort(404, 'Pet not found');
        }
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function render()
    {
        $query = MedicalRecord::with(['vet.user', 'treatments', 'vaccinations'])
            ->where('pet_id', $this->pet->id);

        // Apply search
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('diagnosis', 'like', '%' . $this->search . '%')
                  ->orWhere('chief_complaint', 'like', '%' . $this->search . '%')
                  ->orWhere('notes', 'like', '%' . $this->search . '%');
            });
        }

        // Apply filters
        if ($this->filters['diagnosis']) {
            $query->where('diagnosis', 'like', '%' . $this->filters['diagnosis'] . '%');
        }

        if ($this->filters['start_date']) {
            $query->whereDate('record_date', '>=', $this->filters['start_date']);
        }

        if ($this->filters['end_date']) {
            $query->whereDate('record_date', '<=', $this->filters['end_date']);
        }

        if ($this->filters['follow_up_required'] !== '') {
            $query->where('follow_up_required', $this->filters['follow_up_required']);
        }

        $records = $query->orderBy($this->sortField, $this->sortDirection)
                       ->paginate($this->perPage);

        // Get unique diagnoses for the filter dropdown
        $diagnoses = MedicalRecord::where('pet_id', $this->pet->id)
            ->distinct()
            ->pluck('diagnosis')
            ->filter()
            ->sort()
            ->values();

        return view('livewire.admin.medical-records-index', [
            'records' => $records,
            'diagnoses' => $diagnoses,
        ]);
    }
}

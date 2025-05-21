<?php

namespace App\Livewire;

use App\Models\Pet;
use App\Models\Species;
use App\Models\VeterinarianProfile;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class VetPatients extends Component
{
    use WithPagination;

    public $vetId;
    public $search = '';
    public $speciesFilter = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'speciesFilter' => ['except' => ''],
        'sortField' => ['except' => 'name'],
        'sortDirection' => ['except' => 'asc'],
    ];

    public function mount()
    {
        $this->vetId = auth()->user()->veterinarianProfiles->first()->user_id ?? null;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSpeciesFilter()
    {
        $this->resetPage();
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

    public function render()
    {
        if (!$this->vetId) {
            return view('livewire.vet.patients', [
                'pets' => collect([])->paginate($this->perPage),
                'species' => [],
            ]);
        }

        $query = Pet::query()
            ->select([
                'pets.*',
                DB::raw('(SELECT COUNT(*) FROM appointments WHERE appointments.pet_id = pets.id AND appointments.veterinarian_id = ' . (int) $this->vetId . ') as appointment_count'),
                DB::raw('(SELECT MAX(start_time) FROM appointments WHERE appointments.pet_id = pets.id AND appointments.veterinarian_id = ' . (int) $this->vetId . ') as last_visit')
            ])
            ->with(['owner'])
            ->whereHas('appointments', function ($q) {
                $q->where('veterinarian_id', $this->vetId);
            })
            ->distinct();

        // Apply search
        if ($this->search) {
            $searchTerm = '%' . $this->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('pets.name', 'like', $searchTerm)
                    ->orWhere('pets.microchip_number', 'like', $searchTerm)
                    ->orWhereHas('owner', function ($q) use ($searchTerm) {
                        $q->where('name', 'like', $searchTerm)
                            ->orWhere('email', 'like', $searchTerm);
                    });
            });
        }

        // Apply species filter
        if ($this->speciesFilter) {
            $query->where('pets.species', $this->speciesFilter);
        }

        // Apply sorting
        if ($this->sortField === 'last_visit') {
            $query->orderBy('last_visit', $this->sortDirection);
        } else {
            $query->orderBy($this->sortField, $this->sortDirection);
        }

        $pets = $query->paginate($this->perPage);

        // Get unique species for filter
        $species = Pet::select('species')
            ->join('appointments', 'pets.id', '=', 'appointments.pet_id')
            ->where('appointments.veterinarian_id', $this->vetId)
            ->distinct()
            ->pluck('species')
            ->filter()
            ->mapWithKeys(fn($item) => [$item => $item])
            ->toArray();

        return view('livewire.vet.patients', [
            'pets' => $pets,
            'species' => $species,
        ]);
    }

    public function getPetStatusBadgeClass($status)
    {
        return [
            'active' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
            'inactive' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200',
            'deceased' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
        ][$status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200';
    }
}

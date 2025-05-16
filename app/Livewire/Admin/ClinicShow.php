<?php

namespace App\Livewire\Admin;

use App\Models\VetClinic;
use Livewire\Component;
use Livewire\WithPagination;

class ClinicShow extends Component
{
    use WithPagination;

    public $clinic;
    public $searchVet = '';
    public $perPage = 5;
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $showVetModal = false;
    public $vetToView = null;

    protected $queryString = [
        'searchVet' => ['except' => ''],
        'sortField',
        'sortDirection',
    ];

    public function mount(VetClinic $clinic)
    {
        $this->clinic = $clinic;
    }

    public function viewVet($vetId)
    {
        $this->vetToView = $this->clinic->veterinarians()->findOrFail($vetId);
        $this->showVetModal = true;
    }

    public function closeVetModal()
    {
        $this->showVetModal = false;
        $this->vetToView = null;
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

    public function getVeterinariansProperty()
    {
        return $this->clinic->veterinarians()
            ->select('veterinarian_profiles.*')
            ->join('users', 'veterinarian_profiles.user_id', '=', 'users.id')
            ->with('user') // Eager load the user relationship
            ->when($this->searchVet, function ($query) {
                $query->whereHas('user', function ($q) {
                    $q->where('name', 'like', '%' . $this->searchVet . '%')
                      ->orWhere('email', 'like', '%' . $this->searchVet . '%');
                });
            })
            ->when($this->sortField === 'name', function ($query) {
                $query->orderBy('users.name', $this->sortDirection);
            }, function ($query) {
                if ($this->sortField !== 'name') {
                    $query->orderBy($this->sortField, $this->sortDirection);
                }
            })
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.admin.clinic-show', [
            'veterinarians' => $this->veterinarians,
            'totalVets' => $this->clinic->veterinarians()->count(),
            'upcomingAppointments' => $this->clinic->veterinarians()
                ->withCount(['appointments' => function($query) {
                    $query->where('start_time', '>=', now())
                          ->where('status', 'confirmed');
                }])
                ->get()
                ->sum('appointments_count'),
        ]);
    }
}

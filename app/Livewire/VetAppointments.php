<?php

namespace App\Livewire;

use App\Models\Appointment;
use App\Models\VeterinarianProfile;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class VetAppointments extends Component
{
    use WithPagination;

    public $vetId;
    public $status = 'upcoming';
    public $search = '';
    public $dateFilter = '';
    public $perPage = 10;

    protected $queryString = [
        'status' => ['except' => 'upcoming'],
        'search' => ['except' => ''],
        'dateFilter' => ['except' => ''],
        'page' => ['except' => 1]
    ];

    public function mount()
    {
        $this->vetId = auth()->user()->veterinarianProfiles->first()->user_id ?? null;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingDateFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Appointment::with(['pet.owner', 'clinic'])
            ->where('veterinarian_id', $this->vetId);

        // Apply status filter
        switch ($this->status) {
            case 'upcoming':
                $query->where('start_time', '>=', now())
                    ->whereIn('status', ['scheduled', 'confirmed']);
                break;
            case 'completed':
                $query->where('status', 'completed');
                break;
            case 'cancelled':
                $query->where('status', 'cancelled');
                break;
            case 'all':
                // No additional where clauses needed
                break;
        }

        // Apply date filter
        if ($this->dateFilter) {
            $date = Carbon::parse($this->dateFilter);
            $query->whereDate('start_time', $date);
        }

        // Apply search
        if ($this->search) {
            $searchTerm = '%' . $this->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->whereHas('pet', function ($q) use ($searchTerm) {
                    $q->where('name', 'like', $searchTerm)
                        ->orWhere('id', 'like', $searchTerm);
                })->orWhereHas('pet.owner', function ($q) use ($searchTerm) {
                    $q->where('name', 'like', $searchTerm)
                        ->orWhere('email', 'like', $searchTerm);
                });
            });
        }

        $appointments = $query->orderBy('start_time', 'asc')
            ->paginate($this->perPage);

        return view('livewire.vet.appointments', [
            'appointments' => $appointments,
        ]);
    }

    public function changeStatus($appointmentId, $status)
    {
        $appointment = Appointment::findOrFail($appointmentId);

        // Add authorization check if needed
        if ($appointment->veterinarian_id != $this->vetId) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'You are not authorized to update this appointment.'
            ]);
            return;
        }

        $appointment->update(['status' => $status]);

        $this->dispatch('notify', [
            'type' => 'success',
            'message' => 'Appointment status updated successfully.'
        ]);
    }
}

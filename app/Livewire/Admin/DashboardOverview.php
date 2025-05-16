<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Appointment;
use Livewire\WithPagination;

class DashboardOverview extends Component
{
    use WithPagination;

    public $showAllAppointments = false;
    public $perPage = 10;

    public function showAppointments()
    {
        $this->showAllAppointments = true;
    }

    public function closeModal()
    {
        $this->showAllAppointments = false;
    }

    public function render()
    {
        $appointments = [];
        if ($this->showAllAppointments) {
            $appointments = Appointment::with(['pet.owner', 'veterinarian', 'veterinarian.user'])
                ->orderBy('start_time', 'desc')
                ->paginate($this->perPage);
        }

        return view('livewire.admin.dashboard-overview', [
            'allAppointments' => $appointments
        ]);
    }
}

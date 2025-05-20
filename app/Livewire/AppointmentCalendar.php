<?php

namespace App\Livewire;

use App\Models\Appointment;
use Livewire\Component;
use Carbon\Carbon;

class AppointmentCalendar extends Component
{
    public $view = 'month';
    public $selectedDate;
    public $appointments = [];
    public $vetProfileId;
    public $loading = false;
    public $selectedAppointment = null;
    public $showDetails = false;
    public function mount($veterinarian_profile_id)
    {
        $this->vetProfileId = $veterinarian_profile_id;
        $this->selectedDate = now();
        $this->loadAppointments();
    }

    public function selectAppointment($appointmentId)
    {
        $this->selectedAppointment = $this->appointments->firstWhere('id', $appointmentId);
        $this->showDetails = true;
    }

    public function closeDetails()
    {
        $this->selectedAppointment = null;
        $this->showDetails = false;
    }

    public function loadAppointments()
    {
        $this->loading = true;

        $appointments = Appointment::where('veterinarian_id', $this->vetProfileId)
            ->with('pet', 'pet.owner')
            ->whereDate('start_time', '>=', $this->selectedDate->startOfMonth())
            ->whereDate('start_time', '<=', $this->selectedDate->endOfMonth())
            ->get();

        $this->appointments = $appointments->map(function($appointment) {
            return [
                'id' => $appointment->id,
                'title' => $appointment->pet->name . ' @ ' . $appointment->start_time->format('g:i A'),
                'start' => $appointment->start_time->format('Y-m-d\TH:i:s'),
                'end' => $appointment->end_time->format('Y-m-d\TH:i:s'),
                'url' => route('admin.appointments.show', $appointment->id),
                'backgroundColor' => '#2563eb',
                'borderColor' => '#2563eb',
                'textColor' => '#fff',
                'pet_name' => $appointment->pet->name,
                'owner_name' => $appointment->pet->owner->name,
                'start_time' => $appointment->start_time->format('g:i A'),
                'status' => $appointment->status,
                'notes' => $appointment->notes
            ];
        });

        $this->loading = false;
    }

    public function changeView($view)
    {
        $this->view = $view;
        $this->loadAppointments();
    }

    public function render()
    {
        return view('livewire.appointment-calendar');
    }
}

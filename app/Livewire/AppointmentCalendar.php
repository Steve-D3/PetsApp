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
    public $showCreateModal = false;
    public $pets = [];
    public $newAppointment = [
        'pet_id' => '',
        'start_time' => '',
        'end_time' => '',
        'notes' => ''
    ];
    public function mount($veterinarian_profile_id)
    {
        $this->vetProfileId = $veterinarian_profile_id;
        $this->selectedDate = now();
        $this->loadAppointments();
        $this->loadPets();
    }
    
    public function previousMonth()
    {
        $this->selectedDate = $this->selectedDate->copy()->subMonth();
        $this->emit('monthChanged', $this->selectedDate->format('Y-m-d'));
    }
    
    public function nextMonth()
    {
        $this->selectedDate = $this->selectedDate->copy()->addMonth();
        $this->emit('monthChanged', $this->selectedDate->format('Y-m-d'));
    }
    
    public function today()
    {
        $this->selectedDate = now();
        $this->emit('monthChanged', $this->selectedDate->format('Y-m-d'));
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

    protected function loadPets()
    {
        $this->pets = \App\Models\Pet::with('owner')
            ->whereHas('owner')
            ->orderBy('name')
            ->get();
    }

    public function openCreateModal()
    {
        $this->reset('newAppointment');
        $this->newAppointment['start_time'] = now()->format('Y-m-d\TH:i');
        $this->showCreateModal = true;
    }

    public function closeCreateModal()
    {
        $this->showCreateModal = false;
        $this->reset('newAppointment');
        $this->redirect(route('vet.appointments.calendar', ['veterinarian_profile_id' => $this->vetProfileId]));

    }

    public function createAppointment()
    {
        $validated = $this->validate([
            'newAppointment.pet_id' => 'required|exists:pets,id',
            'newAppointment.start_time' => 'required|date',
            'newAppointment.notes' => 'nullable|string',
        ]);

        try {
            $startTime = new \DateTime($validated['newAppointment']['start_time']);
            $endTime = (clone $startTime)->modify('+30 minutes');

            $appointment = new Appointment([
                'veterinarian_id' => $this->vetProfileId,
                'pet_id' => $validated['newAppointment']['pet_id'],
                'start_time' => $startTime,
                'end_time' => $endTime,
                'notes' => $validated['newAppointment']['notes'] ?? null,
                'status' => 'scheduled',
            ]);

            $appointment->save();

            $this->loadAppointments();
            $this->closeCreateModal();

            $this->dispatch(
                'notify',
                type: 'success',
                message: 'Appointment created successfully!'
            );
        } catch (\Exception $e) {
            $this->dispatch(
                'notify',
                type: 'error',
                message: 'Failed to create appointment. Please try again.'
            );
        }
    }

    public function loadAppointments()
    {
        $this->loading = true;
        
        $startOfMonth = $this->selectedDate->copy()->startOfMonth();
        $endOfMonth = $this->selectedDate->copy()->endOfMonth();
        
        $this->appointments = $this->getAppointmentsForRange($startOfMonth, $endOfMonth);
        $this->loading = false;
    }
    
    public function loadAppointmentsForRange($range)
    {
        $start = Carbon::parse($range['start']);
        $end = Carbon::parse($range['end']);
        
        $appointments = $this->getAppointmentsForRange($start, $end);
        
        return $appointments;
    }
    
    protected function getAppointmentsForRange($start, $end)
    {
        return Appointment::where('veterinarian_id', $this->vetProfileId)
            ->with('pet', 'pet.owner')
            ->whereBetween('start_time', [$start, $end])
            ->get()
            ->map(function ($appointment) {
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
                    'notes' => $appointment->notes,
                    'className' => 'fc-event-' . $appointment->status,
                ];
            });
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

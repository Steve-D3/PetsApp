<?php

namespace App\Livewire\Admin;

use App\Models\Pet;
use App\Models\Appointment;
use App\Models\User;
use Livewire\Component;
use Carbon\Carbon;

class PetShow extends Component
{
    public Pet $pet;
    public $showEditModal = false;
    public $appointmentIdToEdit = null;
    public $startTimeToEdit = '';
    public $statusToEdit = '';
    public $notesToEdit = '';
    public $veterinarianIdToEdit = null;

    // Add new appointment
    public $showAddModal = false;
    public $startTimeToAdd = '';
    public $notesToAdd = '';
    public $veterinarianIdToAdd = null;

    // Veterinarians

    public $veterinarians = [];

    protected $rules = [
        'startTimeToEdit' => 'required|date_format:Y-m-d\TH:i:s',
        'statusToEdit' => 'required|in:pending,confirmed,completed,cancelled',
        'notesToEdit' => 'nullable|string|max:255',
        'veterinarianIdToEdit' => 'required|exists:veterinarian_profiles,id',
    ];

    public function mount(Pet $pet)
    {
        $this->veterinarians = User::where('role', 'vet')->get();
        $this->pet = $pet->load([
            'owner',
            'appointments' => function ($query) {
                $query->orderBy('start_time', 'desc');
            },
            'appointments.veterinarian.user',
            'owner.veterinarianProfiles'
        ]);
    }

    public function editAppointment($appointmentId)
    {
        $appointment = $this->pet->appointments()->findOrFail($appointmentId);

        $this->appointmentIdToEdit = $appointmentId;
        $this->startTimeToEdit = $appointment->start_time ? $appointment->start_time->format('Y-m-d H:i:s') : '';
        $this->statusToEdit = $appointment->status;
        $this->notesToEdit = $appointment->notes;
        $this->veterinarianIdToEdit = $appointment->veterinarian_id;

        $this->showEditModal = true;
    }

    public function addAppointment()
    {
        $this->validate([
            'startTimeToAdd' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    try {
                        $start = Carbon::parse($value);

                        // Only allow times between 09:00–12:00 or 13:00–16:00
                        $hour = $start->hour;
                        $minute = $start->minute;

                        $allowed =
                            ($hour >= 9 && $hour < 12) ||
                            ($hour >= 13 && $hour < 16) ||
                            ($hour == 12 && $minute == 0); // Edge case if needed

                        if (!$allowed) {
                            $fail('Appointments must be scheduled between 09:00–12:00 or 13:00–16:00.');
                        }
                    } catch (\Exception $e) {
                        $fail('The start time is not a valid datetime.');
                    }
                }
            ],
            'notesToAdd' => 'nullable|string|max:255',
            'veterinarianIdToAdd' => 'required|exists:veterinarian_profiles,user_id',
        ]);

        logger($this->startTimeToAdd);

        $startDateTime = Carbon::parse($this->startTimeToAdd);

        Appointment::create([
            'start_time' => $startDateTime->format('Y-m-d H:i:s'),
            'end_time' => $startDateTime->addMinutes(30)->format('Y-m-d H:i:s'),
            'status' => 'pending',
            'notes' => $this->notesToAdd,
            'veterinarian_id' => $this->veterinarianIdToAdd,
            'pet_id' => $this->pet->id,
        ]);

        $this->showAddModal = false;
        $this->reset(['startTimeToAdd', 'notesToAdd', 'veterinarianIdToAdd']);
        $this->dispatch('appointment-added');

        $this->pet->load('appointments');

        session()->flash('message', 'Appointment added successfully.');
    }



    public function updateAppointment()
    {
        $this->validate();

        $appointment = Appointment::findOrFail($this->appointmentIdToEdit);
        $appointment->update([
            'start_time' => $this->startTimeToEdit,
            'status' => $this->statusToEdit,
            'notes' => $this->notesToEdit,
            'veterinarian_id' => $this->veterinarianIdToEdit,
        ]);

        $this->showEditModal = false;
        $this->reset(['appointmentIdToEdit', 'startTimeToEdit', 'statusToEdit', 'notesToEdit', 'veterinarianIdToEdit']);
        $this->dispatch('appointment-updated');

        $this->pet->load('appointments');

        session()->flash('message', 'Appointment updated successfully.');
    }

    public function delete($appointmentId)
    {
        try {
            $appointment = $this->pet->appointments()->findOrFail($appointmentId);
            $appointment->delete();

            // Reload the pet with updated appointments
            $this->pet->load('appointments');

            session()->flash('message', 'Appointment deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete appointment: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.pet-show');
    }
}

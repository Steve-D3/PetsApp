<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\AppointmentForm;
use App\Models\Appointment;
use App\Models\Pet;
use App\Models\VeterinarianProfile;
use Livewire\Component;

class AppointmentEdit extends Component
{
    public AppointmentForm $form;
    public $pets;
    public $vets;
    public $appointment;
    public $pet_name;
    public $vet_name;

    public function mount(Appointment $appointment)
    {
        $this->appointment = $appointment->load(['pet', 'veterinarian']);
        $this->form->setAppointment($appointment);
        $this->pets = Pet::all();
        $this->vets = VeterinarianProfile::with('user')->get();
    }

    public function update()
    {
        try {
            $this->form->update();
            session()->flash('success', 'Appointment updated successfully!');
            return $this->redirect(route('admin.pets.show', $this->appointment->pet_id), navigate: true);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update appointment: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.appointment-edit');
    }
}

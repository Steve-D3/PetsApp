<?php

namespace App\Livewire\Admin;

use App\Models\Pet;
use Livewire\Component;

class PetShow extends Component
{
    public Pet $pet;

    public function mount(Pet $pet)
    {
        $this->pet = $pet->load(['owner', 'appointments']);
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

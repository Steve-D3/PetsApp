<?php

namespace App\Livewire\Appointments;

use App\Livewire\Forms\AppointmentForm;
use App\Models\Appointment;
use App\Models\Pet;
use App\Models\VeterinarianProfile;
use Livewire\Component;

class Form extends Component
{
    public $form;
    public $selectedDate;
    public $veterinarianProfile;
    public $pets;
    public $vets;

    protected $listeners = ['openAppointmentForm' => 'setDate'];

    public function mount($veterinarianProfile = null)
    {
        $this->veterinarianProfile = $veterinarianProfile;
        $this->pets = Pet::all();
        $this->vets = VeterinarianProfile::with('user')->get();
        
        // If we have a veterinarianProfile, make sure it's loaded correctly
        if ($veterinarianProfile && !is_object($veterinarianProfile)) {
            $this->veterinarianProfile = VeterinarianProfile::find($veterinarianProfile);
        }
        
        $this->initializeForm();
    }
    
    protected function initializeForm()
    {
        $this->form = new AppointmentForm($this->veterinarianProfile);
    }

    public function setDate($date)
    {
        $this->selectedDate = $date;
        $this->form->start_time = $date;
    }

    public function save()
    {
        try {
            
            // Create the appointment
            $appointment = new Appointment([
                'pet_id' => $this->form->pet_id,
                'veterinarian_id' => $this->form->veterinarian_id,
                'start_time' => $this->form->start_time,
                'end_time' => (new \DateTime($this->form->start_time))->modify('+30 minutes')->format('Y-m-d H:i:s'),
                'status' => $this->form->status,
                'notes' => $this->form->notes,
            ]);
            
            if ($appointment->save()) {
                session()->flash('message', 'Appointment created successfully!');
                
                // Redirect based on context
                if ($this->veterinarianProfile) {
                    return redirect()->route('admin.vets.show', $this->veterinarianProfile);
                }
                
                return redirect()->route('appointments.index');
            }
            
            session()->flash('error', 'Failed to save appointment. Please try again.');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create appointment: ' . $e->getMessage());
            
            // Re-throw the exception in debug mode
            if (config('app.debug')) {
                throw $e;
            }
        }
    }

    public function render()
    {
        return view('livewire.appointments.form');
    }
}

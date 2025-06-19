<?php

namespace App\Livewire\Vet;

use Livewire\Component;
use Livewire\Attributes\On;
use LivewireUI\Modal\ModalComponent;
use App\Models\Pet;
use App\Models\Appointment;
use App\Models\VeterinarianProfile;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property-read \App\Models\Pet|null $pet
 */
class PetAppointmentModal extends ModalComponent
{
    public $petId;
    public $date;
    public $time;
    public $reason = '';
    public $notes = '';
    public $veterinarian_id;
    public $availableVeterinarians = [];
    public $availableSlots = [];
    public $pets = [];
    public $showPetSelect = false;
    
    protected $rules = [
        'petId' => 'required|exists:pets,id',
        'date' => 'required|date',
        'time' => 'required',
        'reason' => 'required|string|max:255',
        'veterinarian_id' => 'required|exists:users,id',
    ];

    public function mount($petId = null, $veterinarianId = null)
    {
        $this->petId = $petId;
        $this->showPetSelect = is_null($petId);
        
        if ($this->showPetSelect) {
            // Load all pets if we need to show the pet selection
            $this->pets = \App\Models\Pet::with('owner')
                ->orderBy('name')
                ->get();
        }
        $this->date = now()->format('Y-m-d');
        $this->time = now()->addHour()->format('H:00');
        
        // Get veterinarians with role 'vet' and include their user information
        $this->availableVeterinarians = VeterinarianProfile::with('user')
            ->whereHas('user', function($query) {
                $query->where('role', 'vet');
            })
            ->get()
            ->map(function($vet) {
                return (object)[
                    'id' => $vet->user_id,  // Use user_id instead of profile id
                    'name' => $vet->user->name,
                    'specialty' => $vet->specialty
                ];
            });
            
        // Set the veterinarian if provided, otherwise use the first available
        if ($veterinarianId) {
            $this->veterinarian_id = $veterinarianId;
        } elseif ($this->availableVeterinarians->isNotEmpty()) {
            $this->veterinarian_id = $this->availableVeterinarians->first()->id;
        }
        
        $this->loadAvailableSlots();
    }
    
    public static function modalMaxWidth(): string
    {
        return '2xl';
    }
    
    public static function closeModalOnClickAway(): bool
    {
        return true;
    }

    public static function closeModalOnEscape(): bool
    {
        return true;
    }

    public static function closeModalOnEscapeIsForceful(): bool
    {
        return true;
    }
    
    public static function dispatchCloseEvent(): bool
    {
        return true;
    }
    
    public static function destroyOnClose(): bool
    {
        return true;
    }
    
    public function skipPreviousModals($count = 1, $destroy = false): ModalComponent
    {
        return $this;
    }
    
    public function close(): void
    {
        // Reset the form
        $this->reset(['reason', 'notes']);
        
        // Close the modal using LivewireUI Modal's close method
        $this->forceClose()->closeModal();
    }
    
    public function getTitleProperty()
    {
        return 'Schedule New Appointment';
    }
    
    public function getDescriptionProperty()
    {
        if (!$this->pet) {
            return '';
        }
        return 'For ' . $this->pet->name . ' (' . $this->pet->species . ')';
    }
    
    /**
     * Get the pet model with its owner relationship
     *
     * @return \App\Models\Pet|null
     */
    public function getPetProperty()
    {
        if (!$this->petId) {
            return null;
        }
        
        try {
            return Pet::with('owner')->findOrFail($this->petId);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return null;
        }
    }
    

    


    public function loadAvailableSlots()
    {
        if (!$this->date || !$this->veterinarian_id) {
            $this->availableSlots = [];
            return;
        }

        $selectedDate = Carbon::parse($this->date);
        $dayOfWeek = strtolower($selectedDate->englishDayOfWeek);

        // Get veterinarian's working hours using the user_id
        $vet = VeterinarianProfile::where('user_id', $this->veterinarian_id)->first();
        
        if (!$vet) {
            $this->availableSlots = [];
            return;
        }
        
        // Get booked appointments for the selected date and vet
        $bookedAppointments = Appointment::where('veterinarian_id', $this->veterinarian_id)
            ->whereDate('start_time', $this->date)
            ->get()
            ->map(function($appointment) {
                return [
                    'start' => Carbon::parse($appointment->start_time)->format('H:i'),
                    'end' => Carbon::parse($appointment->end_time)->format('H:i')
                ];
            })
            ->toArray();

        // Generate available time slots (every 30 minutes from 9 AM to 5 PM)
        $slots = [];
        $startTime = Carbon::parse($this->date . ' 09:00');
        $endTime = Carbon::parse($this->date . ' 17:00');
        $appointmentDuration = 30; // minutes

        while ($startTime->copy()->addMinutes($appointmentDuration)->lte($endTime)) {
            $slotStart = $startTime->format('H:i');
            $slotEnd = $startTime->copy()->addMinutes($appointmentDuration)->format('H:i');
            
            // Check if this time slot is available
            $isBooked = collect($bookedAppointments)->contains(function ($appt) use ($slotStart, $slotEnd) {
                return !($slotEnd <= $appt['start'] || $slotStart >= $appt['end']);
            });
            
            if (!$isBooked) {
                $slots[] = [
                    'time' => $slotStart,
                    'formatted' => $startTime->format('g:i A')
                ];
            }
            
            $startTime->addMinutes(15); // Check every 15 minutes for availability
        }

        $this->availableSlots = $slots;
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['date', 'veterinarian_id'])) {
            $this->loadAvailableSlots();
        }
    }

    public function createAppointment()
    {
        $this->validate();

        $startTime = Carbon::parse($this->date . ' ' . $this->time);
        $endTime = $startTime->copy()->addMinutes(30); // Default 30-minute appointment

        $appointment = Appointment::create([
            'pet_id' => $this->petId,
            'veterinarian_id' => $this->veterinarian_id,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'reason' => $this->reason,
            'notes' => $this->notes,
            'status' => 'pending',
        ]);

        $this->reset(['reason', 'notes']);
        
        // Emit success event for notification
        $this->dispatch('appointment-created', 
            type: 'success',
            message: 'Appointment scheduled successfully!'
        );

        // Emit event to refresh the parent component
        $this->dispatch('appointment-created');

        // Close the modal
        $this->close();
    }

    public function render()
    {
        return view('livewire.vet.pet-appointment-modal')
            ->layout('components.layouts.app');
    }
}

<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use App\Models\User;
use App\Models\VeterinarianProfile;
use Carbon\Carbon;
use Livewire\Component;

class VetShow extends Component
{
    public VeterinarianProfile $veterinarianProfile;
    public $appointmentsJson;

    public function mount(VeterinarianProfile $veterinarianProfile)
    {
        $this->veterinarianProfile = $veterinarianProfile->load(['user', 'clinic', 'appointments']);

        $appointments = $this->veterinarianProfile->appointments()->with('pet.owner')->get()
        ->map(function ($appt) {
            return [
                'id' => $appt->id,
                'title' => $appt->pet->name,
                'start' => Carbon::parse($appt->start_time)->toIso8601String(),
                'end' => Carbon::parse($appt->end_time)->toIso8601String(),
                'color' => match($appt->status) {
                    'pending' => '#fbbf24', // Yellow for pending
                    'confirmed' => '#60a5fa', // Blue for confirmed
                    'cancelled' => '#f87171', // Red for cancelled
                    'completed' => '#34d399', // Green for completed
                    default => '#60a5fa', // Default blue
                },
                'extendedProps' => [
                    'pet' => $appt->pet->name,
                    'owner_name' => $appt->pet->owner->name,
                    'notes' => $appt->notes,
                    'status' => $appt->status,
                    'pet_id' => $appt->pet->id,
                ],
            ];
        });

    $this->appointmentsJson = $appointments->toJson();
    }

    public function render()
    {
        return view('livewire.admin.vet-show');
    }
}

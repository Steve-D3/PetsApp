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
        $this->veterinarianProfile = $veterinarianProfile->load(['user', 'clinic']);

        $appointments = $this->veterinarianProfile->appointments()->get()
        ->map(function ($appt) {
            return [
                'id' => $appt->id,
                'title' => $appt->pet->name . ' (' . ucfirst($appt->status) . ')',
                'start' => Carbon::parse($appt->start_time)->toIso8601String(),
                'end' => Carbon::parse($appt->end_time)->toIso8601String(),
                'color' => match($appt->status) {
                    'cancelled' => '#f87171',
                    'confirmed' => '#34d399',
                    default => '#60a5fa',
                },
                'extendedProps' => [
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

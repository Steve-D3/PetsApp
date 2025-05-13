<?php

namespace App\Livewire\Forms;

use App\Models\Appointment;
use Carbon\Carbon;
use Livewire\Form;

class AppointmentForm extends Form
{
    public ?Appointment $appointment = null;
    public $pet_id;
    public $veterinarian_id;
    public $start_time;
    public $status = 'pending';
    public $notes;
    public $pet_name = '';
    public $vet_name = '';
    
    protected $veterinarianProfile;
    
    public function __construct($component, $veterinarianProfile = null, $propertyName = 'form')
    {
        parent::__construct($component, $propertyName);
        $this->veterinarianProfile = $veterinarianProfile;
    }

    protected function rules()
    {
        return [
            'pet_id' => 'required|exists:pets,id',
            'veterinarian_id' => 'required|exists:users,id',
            'start_time' => 'required|date',
            'status' => 'required|string|in:pending,confirmed,completed,cancelled',
            'notes' => 'nullable|string',
        ];
    }

    public function setAppointment(Appointment $appointment)
    {
        $this->appointment = $appointment;
        $this->pet_id = $appointment->pet_id;
        $this->veterinarian_id = $appointment->veterinarian_id;

        // Handle start_time - it might be a string or Carbon instance
        if (is_string($appointment->start_time)) {
            $this->start_time = $appointment->start_time ?: now()->format('Y-m-d\TH:i');
        } elseif ($appointment->start_time instanceof Carbon) {
            $this->start_time = $appointment->start_time->format('Y-m-d\TH:i');
        } else {
            $this->start_time = now()->format('Y-m-d\TH:i');
        }

        $this->status = $appointment->status ?? 'pending';
        $this->notes = $appointment->notes ?? '';

        // Set display names with null checks
        $this->pet_name = $appointment->pet ? $appointment->pet->name : 'Unknown Pet';
        $this->vet_name = $appointment->veterinarian ? $appointment->veterinarian->name : 'Unknown Veterinarian';
    }

    public function update()
    {
        $this->validate();

        if (!$this->appointment) {
            throw new \RuntimeException('No appointment set for update');
        }

        try {
            // Ensure we have a valid date string
            $startTimeStr = is_string($this->start_time) ? $this->start_time : now()->format('Y-m-d\TH:i');
            $startTime = Carbon::parse($startTimeStr);

            $this->appointment->update([
                'pet_id' => $this->pet_id,
                'veterinarian_id' => $this->veterinarian_id,
                'start_time' => $startTime,
                'end_time' => $startTime->copy()->addMinutes(30),
                'status' => $this->status,
                'notes' => $this->notes,
            ]);

            return $this->appointment;

        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error updating appointment: ' . $e->getMessage());
            throw new \RuntimeException('Failed to update appointment: ' . $e->getMessage());
        }
    }
}

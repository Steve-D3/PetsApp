<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use Livewire\Form;

class AppointmentForm extends Form
{
    public $pet_id;
    public $veterinarian_id;
    public $start_time;
    public $status = 'pending';
    public $notes;

    protected function rules()
    {
        return [
            'pet_id' => 'required|exists:pets,id',
            'veterinarian_id' => 'required|exists:users,id',
            'start_time' => 'required|date',
            'status' => 'nullable|string',
            'notes' => 'nullable|string',
        ];
    }

    public function __construct($veterinarianProfile = null)
    {
        // parent::__construct($component, $propertyName);
        
        if ($veterinarianProfile) {
            if (is_object($veterinarianProfile) && isset($veterinarianProfile->user_id)) {
                // Handle when a VeterinarianProfile object is passed
                $this->veterinarian_id = $veterinarianProfile->user_id;
            } else if (is_numeric($veterinarianProfile)) {
                // Handle when a user ID is passed directly
                $this->veterinarian_id = $veterinarianProfile;
            }
        }
        
        // Set default status
        $this->status = $this->status ?? 'pending';
    }
}

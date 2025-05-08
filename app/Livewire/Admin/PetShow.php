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

    public function render()
    {
        return view('livewire.admin.pet-show');
    }
}

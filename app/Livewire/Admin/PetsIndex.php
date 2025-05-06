<?php

namespace App\Livewire\Admin;

use App\Models\Pet;
use Livewire\Component;

class PetsIndex extends Component
{
    public $pets;

    public function mount()
    {
        $this->pets = Pet::with(['owner'])->latest()->get();
    }

    public function render()
    {
        return view('livewire.admin.pets-index')->layout('layouts.app');
    }
}
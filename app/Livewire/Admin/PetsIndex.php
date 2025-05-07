<?php

namespace App\Livewire\Admin;

use App\Models\Pet;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Pets')]
class PetsIndex extends Component
{
    public $pets;
    public function mount()
    {
        $this->pets = Pet::with(['owner'])->latest()->get();
    }

    public function delete($petId)
    {
        $pet = Pet::find($petId);
        if ($pet) {
            $pet->delete();
            $this->pets = Pet::with(['owner'])->latest()->get();
            session()->flash('message', 'Pet deleted successfully.');
        } else {
            session()->flash('error', 'Pet not found.');
        }
    }

    public function render()
    {
        return view('livewire.admin.pets-index');
    }
}

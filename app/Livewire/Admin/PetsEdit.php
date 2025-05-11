<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\PetForm;
use App\Models\Pet;
use Livewire\Component;

class PetsEdit extends Component
{
    public PetForm $form;

    public function mount(Pet $pet)
    {
        $this->form->setPet($pet);
    }

    public function save()
    {
        $this->form->save();

        session()->flash('success', 'Pet updated successfully!');
    }

    public function render()
    {
        return view('livewire.admin.pets-edit');
    }
}

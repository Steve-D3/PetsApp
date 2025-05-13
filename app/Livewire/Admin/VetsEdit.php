<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\VetForm;
use App\Models\VetClinic;
use App\Models\VeterinarianProfile;
use Livewire\Component;

class VetsEdit extends Component
{
    public VetForm $form;
    public VeterinarianProfile $veterinarian;

    public function mount(VeterinarianProfile $veterinarianProfile)
    {
        $this->veterinarian = $veterinarianProfile->load('user');
        $this->form->setVeterinarian($this->veterinarian);
    }

    public function update()
    {
        $this->form->update();
        session()->flash('success', 'Veterinarian updated successfully!');
        return $this->redirect(route('vets.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.vets-edit', [
            'clinics' => VetClinic::all(),
        ]);
    }
}

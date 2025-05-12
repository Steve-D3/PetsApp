<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\VetForm;
use App\Models\VetClinic;
use Livewire\Component;

class VetsCreate extends Component
{
    public VetForm $form;

    public function save()
    {
        $this->form->save();

        session()->flash('success', 'Veterinarian created successfully!');

        return $this->redirect(route('vets.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.vets-create', [
            'clinics' => VetClinic::all(),
        ]);
    }
}

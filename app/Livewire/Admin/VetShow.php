<?php

namespace App\Livewire\Admin;

use App\Models\VeterinarianProfile;
use Livewire\Component;

class VetShow extends Component
{
    public VeterinarianProfile $vet;

    public function mount(VeterinarianProfile $veterinarianProfile)
    {
        $this->vet = $veterinarianProfile->load('user', 'clinic');
    }

    public function render()
    {
        return view('livewire.admin.vet-show');
    }
}

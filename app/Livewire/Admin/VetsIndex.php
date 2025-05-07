<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\VeterinarianProfile;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Veterinarians')]
class VetsIndex extends Component
{

    public $vets;
    public function mount()
    {
        $this->vets = VeterinarianProfile::with(['user', 'clinic'])->latest()->get();
    }

    public function render()
    {
        return view('livewire.admin.vets-index');
    }
}

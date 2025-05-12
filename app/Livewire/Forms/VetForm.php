<?php

namespace App\Livewire\Forms;

use App\Models\User;
use App\Models\VetClinic;
use App\Models\VeterinarianProfile;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class VetForm extends Form
{
    public $name;
    public $email;
    public $password = 'password';
    public $license_number;
    public $specialty;
    public $biography;
    public $phone_number;
    public $vet_clinic_id;
    public $off_days = [];

    public function save()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'license_number' => 'required|string|unique:veterinarian_profiles,license_number',
            'specialty' => 'nullable|string',
            'biography' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'vet_clinic_id' => 'required|exists:vet_clinics,id',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => 'vet',
        ]);

        VeterinarianProfile::create([
            'user_id' => $user->id,
            'license_number' => $this->license_number,
            'specialty' => $this->specialty,
            'biography' => $this->biography,
            'phone_number' => $this->phone_number,
            'vet_clinic_id' => $this->vet_clinic_id,
            'off_days' => json_encode($this->off_days),
        ]);

        session()->flash('success', 'Veterinarian created successfully.');
        return redirect()->route('vets.index');
    }


}

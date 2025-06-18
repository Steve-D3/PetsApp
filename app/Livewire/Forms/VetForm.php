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
    public ?User $user = null;
    public ?VeterinarianProfile $veterinarianProfile = null;

    public $name;
    public $email;
    public $password = 'password';
    public $license_number;
    public $specialty;
    public $biography;
    public $phone_number;
    public $vet_clinic_id;
    public $off_days = [];

    public function setVeterinarian(VeterinarianProfile $veterinarianProfile)
    {
        $this->veterinarianProfile = $veterinarianProfile;
        $this->user = $veterinarianProfile->user;

        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->license_number = $veterinarianProfile->license_number;
        $this->specialty = $veterinarianProfile->specialty;
        $this->biography = $veterinarianProfile->biography;
        $this->phone_number = $veterinarianProfile->phone_number;
        $this->vet_clinic_id = $veterinarianProfile->vet_clinic_id;
        $this->off_days = $veterinarianProfile->off_days ? json_decode($veterinarianProfile->off_days, true) : [];
    }

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

    public function update()
    {
        if (!$this->veterinarianProfile || !$this->user) {
            throw new \RuntimeException('Veterinarian profile or user not set');
        }

        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'license_number' => 'required|string|unique:veterinarian_profiles,license_number,' . $this->veterinarianProfile->id,
            'specialty' => 'nullable|string',
            'biography' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'vet_clinic_id' => 'required|exists:vet_clinics,id',
        ]);

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        $this->veterinarianProfile->update([
            'license_number' => $this->license_number,
            'specialty' => $this->specialty,
            'biography' => $this->biography,
            'phone_number' => $this->phone_number,
            'vet_clinic_id' => $this->vet_clinic_id,
            'off_days' => json_encode($this->off_days),
        ]);

        session()->flash('success', 'Veterinarian updated successfully.');
        return redirect()->route('vets.index');
    }


}

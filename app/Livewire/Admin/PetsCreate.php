<?php

namespace App\Livewire\Admin;

use App\Models\Pet;
use App\Models\User;
use Livewire\Component;

class PetsCreate extends Component
{
    public $existingUserId;
    public $newUser = [
        'name' => '',
        'email' => '',
        'phone' => '',
    ];

    public $pet = [
        'name' => '',
        'photo' => '',
        'microchip_number' => '',
        'sterilized' => false,
        'species' => '',
        'breed' => '',
        'gender' => '',
        'weight' => '',
        'birth_date' => null,
        'allergies' => '',
        'food_preferences' => '',
    ];

    public function submit()
    {
        $this->validate([
            'pet.name' => 'required|string|max:255',
            'pet.microchip_number' => 'nullable|string|unique:pets,microchip_number',
            'pet.sterilized' => 'required|boolean',
            'pet.species' => 'required|string',
            'pet.breed' => 'nullable|string',
            'pet.gender' => 'nullable|in:Male,Female',
            'pet.weight' => 'required|numeric|min:0',
            'pet.birth_date' => 'nullable|date',
            'pet.allergies' => 'nullable|string',
            'pet.food_preferences' => 'nullable|string',
        ]);

        // Find or create user
        if ($this->existingUserId) {
            $user = User::findOrFail($this->existingUserId);
        } else {
            $this->validate([
                'newUser.name' => 'required|string|max:255',
                'newUser.email' => 'required|email|unique:users,email',
            ]);

            $user = User::create([
                'name' => $this->newUser['name'],
                'email' => $this->newUser['email'],
                'phone' => $this->newUser['phone'] ?? null,
                'password' => bcrypt('password'), // Temporary password
            ]);
        }

        $pet = new Pet($this->pet);
        $pet->user_id = $user->id;
        $pet->save();

        session()->flash('message', 'Pet added successfully.');
        return redirect()->route('admin.pets.index');
    }

    public function render()
    {
        return view('livewire.admin.pets-create', [
            'users' => User::orderBy('name')->get(),
        ]);
    }
}

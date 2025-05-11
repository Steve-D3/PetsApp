<?php

namespace App\Livewire\Forms;

use App\Models\Pet;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PetForm extends Form
{
    public ?Pet $model = null;

    #[Validate('nullable|string')]
    public string $name = '';

    #[Validate('nullable|string')]
    public ?string $species = null;

    #[Validate('nullable|string')]
    public ?string $breed = null;

    #[Validate('nullable|string')]
    public ?string $microchip_number = null;

    #[Validate('required|boolean')]
    public bool $sterilized = false;

    #[Validate('nullable|in:Male,Female')]
    public ?string $gender = null;

    #[Validate('nullable|numeric')]
    public ?float $weight = null;

    #[Validate('nullable|date')]
    public ?string $birth_date = null;

    #[Validate('nullable|string')]
    public ?string $allergies = null;

    #[Validate('nullable|string')]
    public ?string $food_preferences = null;

    public function setPet(Pet $pet): void
    {
        $this->model = $pet;
        $this->fill($pet); // auto-fills form from model
    }

    public function save(): void
    {
        $this->validate();

        $this->model->fill($this->all())->save();
    }
}

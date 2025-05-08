<?php

namespace App\Livewire\Admin;

use App\Models\Pet;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Pets')]
class PetsIndex extends Component
{
    public $filterSpecies = '';
    public $filterSterilized = '';
    public $filterMicrochip = '';

    public function render()
    {
        $pets = Pet::query()
            ->when($this->filterSpecies, fn($query) => $query->where('species', $this->filterSpecies))
            ->when($this->filterSterilized !== '', fn($query) => $query->where('sterilized', $this->filterSterilized))
            ->when($this->filterMicrochip !== '', function ($query) {
                if ($this->filterMicrochip == '1') {
                    return $query->whereNotNull('microchip_number');
                } elseif ($this->filterMicrochip == '0') {
                    return $query->whereNull('microchip_number');
                }
            })
            ->with('owner')
            ->get();

        return view('livewire.admin.pets-index', compact('pets'));
    }

    public function delete($petId)
    {
        $pet = Pet::find($petId);
        if ($pet) {
            $pet->delete();
            session()->flash('message', 'Pet deleted.');
        } else {
            session()->flash('error', 'Pet not found.');
        }
    }
}

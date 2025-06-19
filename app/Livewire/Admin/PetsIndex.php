<?php

namespace App\Livewire\Admin;

use App\Models\Pet;
use DateTime;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Pets')]
class PetsIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $filterSpecies = '';
    public $filterSterilized = '';
    public $filterMicrochip = '';
    public $search = '';

    public function render()
    {
        $pets = Pet::query()
            ->when($this->search, function ($query) {
                $search = '%' . $this->search . '%';
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', $search)
                        ->orWhere('species', 'like', $search)
                        ->orWhere('breed', 'like', $search);
                });
            })
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
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.admin.pets-index', compact('pets'));
    }

    public function calculateAge($birthDate)
    {
        if (!$birthDate)
            return null;
        $today = new DateTime();
        $birthDate = new DateTime($birthDate);
        $age = $today->diff($birthDate);
        return $age->y;
    }

    public function delete($petId)
    {
        $pet = Pet::with('appointments')->find($petId);
        if ($pet) {
            // Delete all associated appointments
            $pet->appointments()->delete();

            // Delete the pet
            $pet->delete();

            session()->flash('message', 'Pet and all associated appointments deleted successfully.');
        } else {
            session()->flash('error', 'Pet not found.');
        }
    }

    public function resetFilters()
    {
        $this->reset(['search', 'filterSpecies', 'filterSterilized', 'filterMicrochip']);
        $this->resetPage();
    }
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function updatingFilterSpecies()
    {
        $this->resetPage();
    }
    
    public function updatingFilterSterilized()
    {
        $this->resetPage();
    }
    
    public function updatingFilterMicrochip()
    {
        $this->resetPage();
    }
}

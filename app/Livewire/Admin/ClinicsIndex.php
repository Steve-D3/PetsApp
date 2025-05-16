<?php

namespace App\Livewire\Admin;

use App\Models\VetClinic;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class ClinicsIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $country = '';
    public $city = '';
    public $perPage = 10;
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $selectedClinics = [];
    public $selectAll = false;
    
    // Create/Edit Modal
    public $showModal = false;
    public $editing = false;
    public $clinicId = null;
    public $name = '';
    public $address = '';
    public $cityInput = '';
    public $postalCode = '';
    public $countryInput = 'Belgium';
    public $phone = '';
    public $email = '';
    public $website = '';
    
    // Delete Confirmation
    public $confirmingClinicDeletion = false;
    public $clinicIdToDelete = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'country' => ['except' => ''],
        'city' => ['except' => ''],
        'sortField',
        'sortDirection',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCity()
    {
        $this->resetPage();
    }

    public function updatingCountry()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedClinics = $this->clinics->pluck('id')->map(fn($id) => (string)$id)->toArray();
        } else {
            $this->selectedClinics = [];
        }
    }

    public function resetFilters()
    {
        $this->reset(['search', 'country', 'city']);
        $this->resetPage();
    }

    public function getClinicsProperty()
    {
        return VetClinic::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('phone', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->country, function ($query) {
                $query->where('country', $this->country);
            })
            ->when($this->city, function ($query) {
                $query->where('city', 'like', '%' . $this->city . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function getCountriesProperty()
    {
        return VetClinic::select('country')
            ->distinct()
            ->orderBy('country')
            ->pluck('country');
    }

    public function getCitiesProperty()
    {
        return VetClinic::select('city')
            ->when($this->country, function ($query) {
                $query->where('country', $this->country);
            })
            ->distinct()
            ->orderBy('city')
            ->pluck('city');
    }
    
    public function createClinic()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'cityInput' => 'required|string|max:255',
            'postalCode' => 'required|string|max:20',
            'countryInput' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
        ]);

        VetClinic::create([
            'name' => $this->name,
            'address' => $this->address,
            'city' => $this->cityInput,
            'postal_code' => $this->postalCode,
            'country' => $this->countryInput,
            'phone' => $this->phone,
            'email' => $this->email,
            'website' => $this->website,
        ]);

        $this->resetModal();
        session()->flash('message', 'Clinic created successfully.');
    }
    
    public function editClinic($clinicId)
    {
        $clinic = VetClinic::findOrFail($clinicId);
        $this->editing = true;
        $this->clinicId = $clinic->id;
        $this->name = $clinic->name;
        $this->address = $clinic->address;
        $this->cityInput = $clinic->city;
        $this->postalCode = $clinic->postal_code;
        $this->countryInput = $clinic->country;
        $this->phone = $clinic->phone;
        $this->email = $clinic->email;
        $this->website = $clinic->website;
        $this->showModal = true;
    }
    
    public function updateClinic()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'cityInput' => 'required|string|max:255',
            'postalCode' => 'required|string|max:20',
            'countryInput' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
        ]);

        $clinic = VetClinic::findOrFail($this->clinicId);
        $clinic->update([
            'name' => $this->name,
            'address' => $this->address,
            'city' => $this->cityInput,
            'postal_code' => $this->postalCode,
            'country' => $this->countryInput,
            'phone' => $this->phone,
            'email' => $this->email,
            'website' => $this->website,
        ]);

        $this->resetModal();
        session()->flash('message', 'Clinic updated successfully.');
    }
    
    public function confirmClinicDeletion($clinicId)
    {
        $this->clinicIdToDelete = $clinicId;
        $this->confirmingClinicDeletion = true;
    }
    
    public function deleteClinic()
    {
        $clinic = VetClinic::findOrFail($this->clinicIdToDelete);
        $clinic->delete();
        
        $this->selectedClinics = array_diff($this->selectedClinics, [$this->clinicIdToDelete]);
        $this->confirmingClinicDeletion = false;
        
        session()->flash('message', 'Clinic deleted successfully.');
    }
    
    public function deleteSelected()
    {
        VetClinic::whereIn('id', $this->selectedClinics)->delete();
        $this->selectedClinics = [];
        $this->selectAll = false;
        
        session()->flash('message', 'Selected clinics have been deleted successfully.');
    }
    
    public function resetModal()
    {
        $this->reset([
            'showModal', 'editing', 'clinicId', 'name', 'address', 'cityInput', 
            'postalCode', 'countryInput', 'phone', 'email', 'website'
        ]);
    }

    public function render()
    {
        return view('livewire.admin.clinics-index', [
            'clinics' => $this->clinics,
            'countries' => $this->countries,
            'cities' => $this->cities,
        ]);
    }
}

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
    
    // Add Clinic Modal
    public $showAddModal = false;
    public $addName = '';
    public $addAddress = '';
    public $addCityInput = '';
    public $addPostalCode = '';
    public $addCountryInput = 'Belgium';
    public $addPhone = '';
    public $addEmail = '';
    public $addWebsite = '';
    
    // Edit Clinic Modal
    public $showEditModal = false;
    public $clinicId = null;
    public $editName = '';
    public $editAddress = '';
    public $editCityInput = '';
    public $editPostalCode = '';
    public $editCountryInput = '';
    public $editPhone = '';
    public $editEmail = '';
    public $editWebsite = '';
    
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
            'addName' => 'required|string|max:255',
            'addAddress' => 'required|string|max:255',
            'addCityInput' => 'required|string|max:255',
            'addPostalCode' => 'required|string|max:20',
            'addCountryInput' => 'required|string|max:100',
            'addPhone' => 'nullable|string|max:20',
            'addEmail' => 'nullable|email|max:255',
            'addWebsite' => 'nullable|url|max:255',
        ]);

        VetClinic::create([
            'name' => $this->addName,
            'address' => $this->addAddress,
            'city' => $this->addCityInput,
            'postal_code' => $this->addPostalCode,
            'country' => $this->addCountryInput,
            'phone' => $this->addPhone,
            'email' => $this->addEmail,
            'website' => $this->addWebsite,
        ]);

        $this->showAddModal = false;
        session()->flash('message', 'Clinic created successfully.');
    }
    
    public function editClinic($clinicId)
    {
        $clinic = VetClinic::findOrFail($clinicId);
        $this->clinicId = $clinic->id;
        $this->editName = $clinic->name;
        $this->editAddress = $clinic->address;
        $this->editCityInput = $clinic->city;
        $this->editPostalCode = $clinic->postal_code;
        $this->editCountryInput = $clinic->country;
        $this->editPhone = $clinic->phone;
        $this->editEmail = $clinic->email;
        $this->editWebsite = $clinic->website;
        $this->showEditModal = true;
    }
    
    public function updateClinic()
    {
        $this->validate([
            'editName' => 'required|string|max:255',
            'editAddress' => 'required|string|max:255',
            'editCityInput' => 'required|string|max:255',
            'editPostalCode' => 'required|string|max:20',
            'editCountryInput' => 'required|string|max:100',
            'editPhone' => 'nullable|string|max:20',
            'editEmail' => 'nullable|email|max:255',
            'editWebsite' => 'nullable|url|max:255',
        ]);

        $clinic = VetClinic::findOrFail($this->clinicId);
        $clinic->update([
            'name' => $this->editName,
            'address' => $this->editAddress,
            'city' => $this->editCityInput,
            'postal_code' => $this->editPostalCode,
            'country' => $this->editCountryInput,
            'phone' => $this->editPhone,
            'email' => $this->editEmail,
            'website' => $this->editWebsite,
        ]);

        $this->showEditModal = false;
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

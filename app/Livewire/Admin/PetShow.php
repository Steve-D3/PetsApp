<?php

namespace App\Livewire\Admin;

use App\Models\Pet;
use App\Models\Appointment;
use App\Models\User;
use Livewire\Component;
use Carbon\Carbon;

class PetShow extends Component
{
    public $pet;
    public $petId;
    
    // UI State
    public $showEditModal = false;
    public $isLoading = true;
    public $appointmentIdToEdit = null;
    public $startTimeToEdit = '';
    public $statusToEdit = '';
    public $notesToEdit = '';
    public $veterinarianIdToEdit = null;
    public $showAddModal = false;
    
    // Form Fields
    public $startTimeToAdd = '';
    public $notesToAdd = '';
    public $veterinarianIdToAdd = null;

    // Delete Modal
    public $showDeleteModal = false;
    public $appointmentIdToDelete = null;

    // Data
    public $veterinarians = [];
    public $perPage = 5;
    public $appointments = [];
    public $pagination = [];
    public $page = 1;
    public $showAppointmentModal = false;

    protected $queryString = ['page'];

    protected $rules = [
        'startTimeToEdit' => 'required|date_format:Y-m-d\TH:i:s',
        'statusToEdit' => 'required|in:pending,confirmed,completed,cancelled',
        'notesToEdit' => 'nullable|string|max:255',
        'veterinarianIdToEdit' => 'required|exists:veterinarian_profiles,id',
    ];

    public function mount(Pet $pet)
    {
        $this->petId = $pet->id;
        $this->loadPetData();
        $this->veterinarians = User::where('role', 'vet')->get();
        $this->loadAppointments();
    }
    
    protected function loadPetData()
    {
        if ($this->petId) {
            $this->isLoading = true;
            $this->pet = Pet::with([
                'owner',
                'owner.veterinarianProfiles',
                'appointments.veterinarian.user'
            ])->findOrFail($this->petId);
            $this->isLoading = false;
        }
    }
    
    public function hydrate()
    {
        if ($this->petId && (!$this->pet || $this->pet->id != $this->petId)) {
            $this->loadPetData();
        }
    }
    
    public function updatedPage()
    {
        $this->loadAppointments();
    }

    public function loadAppointments()
    {
        // Make sure pet is loaded
        if (!$this->pet && $this->petId) {
            $this->loadPetData();
        }
        
        $paginator = $this->pet->appointments()
            ->with('veterinarian.user')
            ->orderBy('start_time', 'desc')
            ->paginate($this->perPage, ['*'], 'page', $this->page);
            
        $this->appointments = $paginator->items();
        
        // Prepare pagination data
        $this->pagination = [
            'current_page' => $paginator->currentPage(),
            'last_page' => $paginator->lastPage(),
            'per_page' => $paginator->perPage(),
            'total' => $paginator->total(),
            'links' => []
        ];
        
        // Update the current page to match the paginator in case it was adjusted
        $this->page = $paginator->currentPage();
        
        // Prepare pagination links
        if ($paginator->hasPages()) {
            $links = [];
            
            // Previous Page Link
            if ($paginator->onFirstPage()) {
                $links[] = [
                    'url' => null,
                    'label' => '&laquo; Previous',
                    'active' => false
                ];
            } else {
                $links[] = [
                    'url' => '#',
                    'label' => '&laquo; Previous',
                    'active' => false
                ];
            }
            
            // Pagination Elements
            foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url) {
                $links[] = [
                    'url' => '#',
                    'label' => (string) $page,
                    'active' => $page == $paginator->currentPage()
                ];
            }
            
            // Next Page Link
            if ($paginator->hasMorePages()) {
                $links[] = [
                    'url' => '#',
                    'label' => 'Next &raquo;',
                    'active' => false
                ];
            } else {
                $links[] = [
                    'url' => null,
                    'label' => 'Next &raquo;',
                    'active' => false
                ];
            }
            
            $this->pagination['links'] = $links;
        }
    }

    public function updatedPerPage()
    {
        $this->loadAppointments();
    }

    public function editAppointment($appointmentId)
    {
        try {
            $appointment = $this->pet->appointments()->with('veterinarian.user')->findOrFail($appointmentId);

            $this->appointmentIdToEdit = $appointmentId;
            $this->startTimeToEdit = $appointment->start_time ? $appointment->start_time->format('Y-m-d\TH:i') : '';
            $this->statusToEdit = $appointment->status;
            $this->notesToEdit = $appointment->notes;
            $this->veterinarianIdToEdit = $appointment->veterinarian_id;

            $this->showEditModal = true;
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to load appointment: ' . $e->getMessage());
        }
    }

    public function addAppointment()
    {
        $this->validate([
            'startTimeToAdd' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    try {
                        $start = Carbon::parse($value);

                        // Only allow times between 09:00–12:00 or 13:00–16:00
                        $hour = $start->hour;
                        $minute = $start->minute;

                        $allowed =
                            ($hour >= 9 && $hour < 12) ||
                            ($hour >= 13 && $hour < 16) ||
                            ($hour == 12 && $minute == 0); // Edge case if needed

                        if (!$allowed) {
                            $fail('Appointments must be scheduled between 09:00–12:00 or 13:00–16:00.');
                        }
                    } catch (\Exception $e) {
                        $fail('The start time is not a valid datetime.');
                    }
                }
            ],
            'notesToAdd' => 'nullable|string|max:255',
            'veterinarianIdToAdd' => 'required|exists:veterinarian_profiles,user_id',
        ]);

        logger($this->startTimeToAdd);

        $startDateTime = Carbon::parse($this->startTimeToAdd);

        Appointment::create([
            'start_time' => $startDateTime->format('Y-m-d H:i:s'),
            'end_time' => $startDateTime->addMinutes(30)->format('Y-m-d H:i:s'),
            'status' => 'pending',
            'notes' => $this->notesToAdd,
            'veterinarian_id' => $this->veterinarianIdToAdd,
            'pet_id' => $this->pet->id,
        ]);

        $this->showAddModal = false;
        $this->reset(['startTimeToAdd', 'notesToAdd', 'veterinarianIdToAdd']);
        $this->dispatch('appointment-added');

        $this->pet->load('appointments');

        session()->flash('message', 'Appointment added successfully.');
    }



    public function updateAppointment()
    {
        try {
            $this->validate([
                'startTimeToEdit' => 'required|date',
                'statusToEdit' => 'required|in:pending,confirmed,completed,cancelled',
                'notesToEdit' => 'nullable|string|max:1000',
                'veterinarianIdToEdit' => 'required|exists:veterinarian_profiles,id'
            ]);

            $appointment = Appointment::findOrFail($this->appointmentIdToEdit);
            
            $startDateTime = Carbon::parse($this->startTimeToEdit);
            
            $appointment->update([
                'start_time' => $startDateTime->format('Y-m-d H:i:s'),
                'end_time' => $startDateTime->copy()->addMinutes(30)->format('Y-m-d H:i:s'),
                'status' => $this->statusToEdit,
                'notes' => $this->notesToEdit,
                'veterinarian_id' => $this->veterinarianIdToEdit,
            ]);

            // Reload the appointments to reflect changes
            $this->loadAppointments();
            
            $this->showEditModal = false;
            $this->reset(['appointmentIdToEdit', 'startTimeToEdit', 'statusToEdit', 'notesToEdit', 'veterinarianIdToEdit']);
            
            session()->flash('message', 'Appointment updated successfully.');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update appointment: ' . $e->getMessage());
        }
    }

    public function delete($appointmentId)
    {
        try {
            $appointment = $this->pet->appointments()->findOrFail($appointmentId);
            $appointment->delete();

            // Reload the pet with updated appointments
            $this->loadAppointments();

            session()->flash('message', 'Appointment deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete appointment: ' . $e->getMessage());
        }
    }

    /**
     * Show the delete confirmation modal
     */
    public function confirmDelete($appointmentId)
    {
        $this->appointmentIdToDelete = $appointmentId;
        $this->showDeleteModal = true;
    }

    /**
     * Delete the appointment
     */
    public function deleteAppointment()
    {
        try {
            $appointment = \App\Models\Appointment::findOrFail($this->appointmentIdToDelete);
            $appointment->delete();

            $this->showDeleteModal = false;
            $this->appointmentIdToDelete = null;
            
            // Reload appointments to update the list
            $this->loadAppointments();
            
            // Show success message
            session()->flash('message', 'Appointment deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete appointment: ' . $e->getMessage());
        }
    }

    public function render()
    {
        if ($this->isLoading) {
            return view('livewire.admin.pet-show', [
                'isLoading' => true,
                'pet' => null,
                'appointments' => [],
                'pagination' => [],
                'veterinarians' => []
            ]);
        }
        
        return view('livewire.admin.pet-show', [
            'isLoading' => false,
            'pet' => $this->pet,
            'appointments' => $this->appointments,
            'pagination' => $this->pagination,
            'veterinarians' => $this->veterinarians
        ]);
    }
}

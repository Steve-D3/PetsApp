<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;

class UsersIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $role = '';
    public $perPage = 10;
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $selectedUsers = [];
    public $selectAll = false;
    
    // User creation modal
    public $showCreateModal = false;
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $userRole = 'owner';
    public $confirmingUserDeletion = false;
    public $userIdToDelete = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'role' => ['except' => ''],
        'sortField',
        'sortDirection',
    ];

    public function updatingSearch()
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
            $this->selectedUsers = $this->users->pluck('id')->map(fn($id) => (string)$id)->toArray();
        } else {
            $this->selectedUsers = [];
        }
    }

    public function resetFilters()
    {
        $this->reset(['search', 'role']);
        $this->resetPage();
    }

    public function getUsersProperty()
    {
        return User::query()
            ->withCount('pets')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->role, function ($query) {
                $query->where('role', $this->role);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }
    
    public function createUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'userRole' => 'required|in:admin,vet,owner',
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role' => $this->userRole,
            'email_verified_at' => now(),
        ]);

        $this->reset(['name', 'email', 'password', 'password_confirmation', 'userRole']);
        $this->showCreateModal = false;
        
        session()->flash('message', 'User created successfully.');
    }
    
    public function confirmUserDeletion($userId)
    {
        $this->userIdToDelete = $userId;
        $this->confirmingUserDeletion = true;
    }
    
    public function deleteUser()
    {
        if ($this->userIdToDelete === auth()->id()) {
            session()->flash('error', 'You cannot delete your own account.');
            return;
        }
        
        User::findOrFail($this->userIdToDelete)->delete();
        $this->selectedUsers = array_diff($this->selectedUsers, [$this->userIdToDelete]);
        $this->confirmingUserDeletion = false;
        
        session()->flash('message', 'User deleted successfully.');
    }

    public function deleteSelected()
    {
        if (in_array(auth()->id(), $this->selectedUsers)) {
            $this->dispatch('notify', message: 'You cannot delete your own account.', type: 'error');
            return;
        }

        User::whereIn('id', $this->selectedUsers)->delete();
        $this->selectedUsers = [];
        $this->selectAll = false;
        $this->dispatch('notify', message: 'Selected users have been deleted.', type: 'success');
    }

    public function render()
    {
        return view('livewire.admin.users-index', [
            'users' => $this->users,
            'roles' => ['owner' => 'Pet Owner', 'vet' => 'Veterinarian', 'admin' => 'Administrator']
        ]);
    }
}

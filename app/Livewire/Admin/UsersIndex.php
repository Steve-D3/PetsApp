<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

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

    // User edit modal
    public $showEditModal = false;
    public $userIdToEdit = null;
    public $nameToEdit = '';
    public $emailToEdit = '';
    public $passwordToEdit = '';
    public $passwordConfirmationToEdit = '';
    public $userRoleToEdit = 'owner';

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
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'userRole' => 'required|in:admin,vet,owner',
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->userRole,
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
            session()->flash('message', 'You cannot delete your own account.');
            return;
        }

        User::findOrFail($this->userIdToDelete)->delete();
        $this->selectedUsers = array_diff($this->selectedUsers, [$this->userIdToDelete]);
        $this->confirmingUserDeletion = false;

        session()->flash('message', 'User deleted successfully.');
    }

    public function editUser($userId)
    {
        $user = User::findOrFail($userId);
        $this->userIdToEdit = $userId;
        $this->nameToEdit = $user->name;
        $this->emailToEdit = $user->email;
        $this->userRoleToEdit = $user->role;
        $this->showEditModal = true;
    }

    public function updateUser()
    {
        $this->validate([
            'nameToEdit' => 'required|string|max:255',
            'emailToEdit' => 'required|email|unique:users,email,' . $this->userIdToEdit,
            'passwordToEdit' => 'nullable|min:8|confirmed',
            'userRoleToEdit' => 'required|in:admin,vet,owner',
        ]);

        $user = User::findOrFail($this->userIdToEdit);
        $user->update([
            'name' => $this->nameToEdit,
            'email' => $this->emailToEdit,
            'role' => $this->userRoleToEdit,
        ]);

        if ($this->passwordToEdit) {
            $user->password = Hash::make($this->passwordToEdit);
            $user->save();
        }

        $this->reset(['userIdToEdit', 'nameToEdit', 'emailToEdit', 'passwordToEdit', 'passwordConfirmationToEdit', 'userRoleToEdit']);
        $this->showEditModal = false;

        session()->flash('message', 'User updated successfully.');
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

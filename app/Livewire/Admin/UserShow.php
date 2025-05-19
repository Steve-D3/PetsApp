<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Carbon\Carbon;

class UserShow extends Component
{
    public $user;
    public $userId;

    public function mount($id)
    {
        $this->userId = $id;
        $this->loadUserData();
    }

    public function loadUserData()
    {
        $this->user = User::with('pets')->findOrFail($this->userId);
        
        // Format birth_date for each pet
        foreach ($this->user->pets as $pet) {
            if ($pet->birth_date) {
                $pet->birth_date = \Carbon\Carbon::parse($pet->birth_date);
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.user-show');
    }
}

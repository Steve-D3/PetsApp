<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\VeterinarianProfile;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Veterinarians')]
class VetsIndex extends Component
{
    public $search = '';
    public $perPage = 7;

    public function delete($vetId)
    {
        $vet = VeterinarianProfile::with('appointments')->find($vetId);
        if ($vet) {
            // Delete all associated appointments
            $vet->appointments()->delete();

            // Get the user before deleting the profile
            $user = $vet->user;

            // Delete the veterinarian profile
            $vet->delete();

            // Delete the associated user
            if ($user) {
                $user->delete();
            }

            session()->flash('message', 'Veterinarian and all associated data deleted successfully.');
        } else {
            session()->flash('error', 'Veterinarian not found.');
        }
    }

    public function render()
    {
        $vets = VeterinarianProfile::query()
            ->when($this->search, function ($query) {
                $search = '%' . $this->search . '%';
                return $query->where(function ($q) use ($search) {
                    $q->whereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', $search)
                            ->orWhere('email', 'like', $search);
                    })
                        ->orWhere('specialty', 'like', $search)
                        ->orWhereHas('clinic', function ($clinicQuery) use ($search) {
                            $clinicQuery->where('name', 'like', $search);
                        });
                });
            })
            ->with(['user', 'clinic'])
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.admin.vets-index', [
            'vets' => $vets
        ]);
    }
}

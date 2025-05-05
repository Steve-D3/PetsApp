<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class DashboardOverview extends Component
{

    public function render()
    {
        return (view('livewire.admin.dashboard-overview')
        ->layout('layouts.app'));
    }
}

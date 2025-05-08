<?php

use App\Livewire\Admin\DashboardOverview;
use App\Livewire\Admin\PetsCreate;
use App\Livewire\Admin\PetsIndex;
use App\Livewire\Admin\VetShow;
use App\Livewire\Admin\VetsIndex;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/admin/dashboard', DashboardOverview::class)->name('admin.dashboard');
    Route::get('/admin/pets', PetsIndex::class)->name('pets.index');
    Route::get('/admin/vets', VetsIndex::class)->name('admin.vets');
    Route::get('/admin/vets/{veterinarianProfile}', VetShow::class)->name('admin.vets.show');
    Route::get('/admin/pets/create', PetsCreate::class)->name('admin.pets.create');


});

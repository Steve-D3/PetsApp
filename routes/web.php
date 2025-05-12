<?php

use App\Http\Controllers\AppointmentController;
use App\Livewire\Admin\DashboardOverview;
use App\Livewire\Admin\PetsCreate;
use App\Livewire\Admin\PetShow;
use App\Livewire\Admin\PetsEdit;
use App\Livewire\Admin\VetsCreate;
use App\Livewire\Admin\PetsIndex;
use App\Livewire\Admin\VetShow;
use App\Livewire\Admin\VetsIndex;
use App\Livewire\Appointments\Form;
use App\Livewire\Forms\AppointmentForm;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:admin,vet',
])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/admin/dashboard', DashboardOverview::class)->name('admin.dashboard');
    Route::get('/admin/pets', PetsIndex::class)->name('pets.index');
    Route::get('/admin/vets', VetsIndex::class)->name('vets.index');
    Route::get('/admin/vets/{veterinarianProfile}', VetShow::class)->name('admin.vets.show');
    Route::get('/admin/vet/create', VetsCreate::class)->name('admin.vets.create');
    Route::get('/admin/pet/create', PetsCreate::class)->name('admin.pets.create');
    Route::get('/admin/pet/{pet}', PetShow::class)->name('admin.pets.show');
    Route::get('/admin/pet/{pet}/edit', PetsEdit::class)->name('admin.pets.edit');
    Route::get('/appointments', Form::class)->name('appointments.index');
    Route::get('/admin/vet/{veterinarianProfile}/appointment/create', Form::class)->name('appointments.create');
});

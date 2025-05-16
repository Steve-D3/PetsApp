<?php

use App\Http\Controllers\AppointmentController;
use App\Livewire\Admin\AppointmentDetails;
use App\Livewire\Admin\AppointmentEdit;
use App\Livewire\Admin\DashboardOverview;
use App\Livewire\Admin\MedicalRecordDetails;
use App\Livewire\Admin\PetsCreate;
use App\Livewire\Admin\PetShow;
use App\Livewire\Admin\PetsEdit;
use App\Livewire\Admin\VetsCreate;
use App\Livewire\Admin\PetsIndex;
use App\Livewire\Admin\VetShow;
use App\Livewire\Admin\VetsIndex;
use App\Livewire\Admin\VetsEdit;
use App\Livewire\Appointments\Form;
use App\Livewire\Forms\AppointmentForm;
use App\Livewire\Admin\MedicalRecordsIndex;
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
    Route::get('/admin/vet/create', VetsCreate::class)->name('admin.vets.create');
    Route::get('/admin/pet/create', PetsCreate::class)->name('admin.pets.create');
    Route::get('/admin/pet/{pet}', PetShow::class)->name('admin.pets.show');
    Route::get('/admin/pet/{pet}/edit', PetsEdit::class)->name('admin.pets.edit');
    Route::get('/admin/pet/{pet}/appointment/create', Form::class)->name('admin.appointments.create');
    Route::get('/admin/appointments/{appointment}/edit', AppointmentEdit::class)->name('admin.appointments.edit');
    Route::get('/admin/appointments/{appointment}', AppointmentDetails::class)->name('admin.appointments.show');

    Route::get('/appointments', Form::class)->name('appointments.index');

    Route::get('/admin/vets', VetsIndex::class)->name('vets.index');
    Route::get('/admin/vets/{veterinarianProfile}', VetShow::class)->name('admin.vets.show');
    Route::get('/admin/vet/{veterinarianProfile}/edit', VetsEdit::class)->name('admin.vets.edit');
    Route::get('/admin/vet/{veterinarianProfile}/appointment/create', Form::class)->name('appointments.create');

    Route::get('/admin/pets/{pet}/medical-records', MedicalRecordsIndex::class)
        ->name('medical-records.index');
        // ->middleware('can:view,pet');
    Route::get('/admin/pets/{pet}/medical-records/{record}', MedicalRecordDetails::class)
        ->name('medical-records.show');
});

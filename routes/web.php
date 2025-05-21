<?php

use App\Http\Controllers\AppointmentController;
use App\Livewire\Admin\AppointmentDetails;
use App\Livewire\Admin\AppointmentEdit;
use App\Livewire\Admin\ClinicShow;
use App\Livewire\Admin\ClinicsIndex;
use App\Livewire\Admin\ClinicsShow;
use App\Livewire\Admin\DashboardOverview;
use App\Livewire\Admin\MedicalRecordDetails;
use App\Livewire\Admin\PetsCreate;
use App\Livewire\Admin\PetShow;
use App\Livewire\Admin\PetsEdit;
use App\Livewire\Admin\UsersIndex;
use App\Livewire\Admin\UserShow;
use App\Livewire\Admin\VetsCreate;
use App\Livewire\Admin\PetsIndex;
use App\Livewire\Admin\VetShow;
use App\Livewire\Admin\VetsIndex;
use App\Livewire\Admin\VetsEdit;
use App\Livewire\Appointments\Form;
use App\Livewire\Forms\AppointmentForm;
use App\Livewire\Admin\MedicalRecordsIndex;
use App\Livewire\VetDashboard;
use App\Livewire\AppointmentCalendar;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Shared dashboard for both roles
    Route::get('/', DashboardOverview::class)
        ->middleware('role:admin,vet')
        ->name('dashboard');

    // Vet-specific routes
    Route::prefix('vet')
        ->name('vet.')
        ->middleware('role:vet')
        ->group(function () {
            Route::get('/dashboard', VetDashboard::class)->name('dashboard');
            Route::get('/appointments', \App\Livewire\VetAppointments::class)->name('appointments.index');
            Route::get('/appointments/calendar/{veterinarian_profile_id}', AppointmentCalendar::class)
                ->name('appointments.calendar');
            Route::get('/patients', \App\Livewire\VetPatients::class)->name('patients.index');
        });

    // Admin-specific routes
    Route::prefix('admin')
        ->name('admin.')
        ->middleware('role:admin')
        ->group(function () {
            // Dashboard
            Route::get('/dashboard', DashboardOverview::class)->name('dashboard');

            // Pets
            Route::prefix('pets')->name('pets.')->group(function () {
                Route::get('/', PetsIndex::class)->name('index');
                Route::get('/create', PetsCreate::class)->name('create');
                Route::get('/{pet}/edit', PetsEdit::class)->name('edit');
                Route::get('/{pet}', PetShow::class)->name('show');
            });

            // Vets
            Route::prefix('vets')->name('vets.')->group(function () {
                Route::get('/', VetsIndex::class)->name('index');
                Route::get('/create', VetsCreate::class)->name('create');
                Route::get('/{veterinarianProfile}', VetShow::class)->name('show');
                Route::get('/{veterinarianProfile}/edit', VetsEdit::class)->name('edit');
            });

            // Users
            Route::prefix('users')->name('users.')->group(function () {
                Route::get('/', UsersIndex::class)->name('index');
                Route::get('/{id}', UserShow::class)->name('show');
            });

            // Clinics
            Route::prefix('clinics')->name('clinics.')->group(function () {
                Route::get('/', ClinicsIndex::class)->name('index');
                Route::get('/{clinic}', ClinicShow::class)->name('show');
            });
        });

    // Shared routes (accessible by both admin and vet)
    Route::middleware('role:admin,vet')->group(function () {
        // Appointments
        Route::get('/appointments', Form::class)->name('appointments.index');
        Route::get('/admin/pet/{pet}/appointment/create', Form::class)
            ->name('admin.appointments.create');
        Route::get('/admin/vet/{veterinarianProfile}/appointment/create', Form::class)
            ->name('appointments.create');
        Route::get('/admin/appointments/{appointment}/edit', AppointmentEdit::class)
            ->name('admin.appointments.edit');
        Route::get('/admin/appointments/{appointment}', AppointmentDetails::class)
            ->name('admin.appointments.show');

        // Medical Records
        Route::get('/admin/pets/{pet}/medical-records', MedicalRecordsIndex::class)
            ->name('medical-records.index');
        Route::get('/admin/pets/{pet}/medical-records/{record}', MedicalRecordDetails::class)
            ->name('medical-records.show');
    });
});


<?php

use App\Livewire\Admin\DashboardOverview;
use App\Livewire\Admin\PetsIndex;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('admin.dashboard');
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
});

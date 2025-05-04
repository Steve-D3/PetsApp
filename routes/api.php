<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\VetClinicController;
use App\Http\Controllers\VeterinarianProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Pets API routes
Route::get('/pets', [PetController::class, 'index']);
Route::get('/pets/{pet}', [PetController::class, 'show']);
Route::post('/pets', [PetController::class, 'store']);
Route::put('/pets/{pet}', [PetController::class, 'update']);
Route::delete('/pets/{pet}', [PetController::class, 'destroy']);

// Vets API routes
Route::get('/vets', [VeterinarianProfileController::class, 'index']);

// Vet Clinics API routes
Route::get('/clinics', [VetClinicController::class, 'index']);
Route::get('/clinics/{id}', [VetClinicController::class, 'show']);


// Appointments API routes
Route::get('/appointments', [AppointmentController::class, 'index']);
Route::get('/appointments/{appointment}', [AppointmentController::class, 'show']);

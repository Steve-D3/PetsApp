<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\TreatmentTypeController;
use App\Http\Controllers\VaccinationController;
use App\Http\Controllers\VaccineTypeController;
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
Route::get('/vets/{veterinarianProfile}', [VeterinarianProfileController::class, 'show']);
Route::post('/vets', [VeterinarianProfileController::class, 'store']);
Route::put('/vets/{veterinarianProfile}', [VeterinarianProfileController::class, 'update']);
Route::delete('/vets/{veterinarianProfile}', [VeterinarianProfileController::class, 'destroy']);

// Vet Clinics API routes
Route::get('/clinics', [VetClinicController::class, 'index']);
Route::get('/clinics/{id}', [VetClinicController::class, 'show']);
Route::post('/clinics', [VetClinicController::class, 'store']);
Route::put('/clinics/{id}', [VetClinicController::class, 'update']);
Route::delete('/clinics/{id}', [VetClinicController::class, 'destroy']);


// Appointments API routes
Route::get('/appointments', [AppointmentController::class, 'index']);
Route::get('/appointments/available-slots/{veterinarianProfile}', [AppointmentController::class, 'availableSlots']);
Route::get('/appointments/{appointment}', [AppointmentController::class, 'show']);
Route::post('/appointments', [AppointmentController::class, 'store']);
Route::put('/appointments/{appointment}', [AppointmentController::class, 'update']);
Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy']);


// Medical records API routes
Route::get('/medical-records', [MedicalRecordController::class, 'index']);
Route::get('/medical-records/{medicalRecord}', [MedicalRecordController::class, 'show']);
Route::post('/medical-records', [MedicalRecordController::class, 'store']);
Route::put('/medical-records/{medicalRecord}', [MedicalRecordController::class, 'update']);
Route::delete('/medical-records/{medicalRecord}', [MedicalRecordController::class, 'destroy']);

// Treatments API routes
Route::get('/treatments', [TreatmentController::class, 'index']);
Route::get('/treatments/{treatment}', [TreatmentController::class, 'show']);
Route::post('/treatments', [TreatmentController::class, 'store']);
Route::put('/treatments/{treatment}', [TreatmentController::class, 'update']);
Route::delete('/treatments/{treatment}', [TreatmentController::class, 'destroy']);

// Treatment types API routes
Route::get('/treatment-types', [TreatmentTypeController::class, 'index']);
Route::get('/treatment-types/{treatmentType}', [TreatmentTypeController::class, 'show']);
Route::post('/treatment-types', [TreatmentTypeController::class, 'store']);
Route::put('/treatment-types/{treatmentType}', [TreatmentTypeController::class, 'update']);
Route::delete('/treatment-types/{treatmentType}', [TreatmentTypeController::class, 'destroy']);

// Vaccine types API routes
Route::get('/vaccine-types', [VaccineTypeController::class, 'index']);
Route::get('/vaccine-types/{vaccineType}', [VaccineTypeController::class, 'show']);
Route::post('/vaccine-types', [VaccineTypeController::class, 'store']);
Route::put('/vaccine-types/{vaccineType}', [VaccineTypeController::class, 'update']);
Route::delete('/vaccine-types/{vaccineType}', [VaccineTypeController::class, 'destroy']);

// Vaccinations API routes
Route::get('/vaccinations', [VaccinationController::class, 'index']);
Route::get('/vaccinations/{vaccination}', [VaccinationController::class, 'show']);
Route::post('/vaccinations', [VaccinationController::class, 'store']);
Route::put('/vaccinations/{vaccination}', [VaccinationController::class, 'update']);
Route::delete('/vaccinations/{vaccination}', [VaccinationController::class, 'destroy']);




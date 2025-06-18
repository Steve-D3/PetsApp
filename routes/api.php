<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\TreatmentTypeController;
use App\Http\Controllers\VaccinationController;
use App\Http\Controllers\VaccineTypeController;
use App\Http\Controllers\VetClinicController;
use App\Http\Controllers\VeterinarianProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Public routes
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

// Password reset routes
Route::post('/forgot-password', [UserController::class, 'sendResetLinkEmail']);
Route::post('/reset-password', [UserController::class, 'reset']);

Route::get('/test-reset-email', function () {
    try {
        $user = \App\Models\User::first();
        \Log::info('Starting password reset for user', ['user_id' => $user->id, 'email' => $user->email]);

        if (!$user) {
            \Log::error('No user found for password reset');
            return response()->json(['error' => 'No users found in the database'], 404);
        }

        // Generate a token
        $token = \Illuminate\Support\Str::random(60);
        \Log::info('Generated token for password reset', ['token' => $token]);

        \DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            ['token' => \Illuminate\Support\Facades\Hash::make($token), 'created_at' => now()]
        );

        \Log::info('Token stored in database');

        // Send the notification
        \Log::info('Dispatching ResetPassword notification');
        $user->notify(new \App\Notifications\ResetPassword($token));
        \Log::info('Notification dispatched');

        return response()->json([
            'message' => 'Password reset email sent successfully',
            'email' => $user->email,
            'token' => $token
        ]);

    } catch (\Exception $e) {
        \Log::error('Error in test-reset-email: ' . $e->getMessage(), [
            'exception' => $e,
            'trace' => $e->getTraceAsString()
        ]);
        return response()->json([
            'error' => 'Failed to send test email',
            'message' => $e->getMessage()
        ], 500);
    }
});

Route::get('/test-email', function () {
    try {
        \Log::info('Attempting to send test email');

        \Mail::send([], [], function ($message) {
            $message->to('test@example.com')
                ->subject('Test Email')
                ->html('<h1>Test Email</h1><p>This is a test email.</p>');
        });

        \Log::info('Test email sent successfully');
        return response()->json(['message' => 'Test email sent']);

    } catch (\Exception $e) {
        \Log::error('Email error: ' . $e->getMessage());
        \Log::error($e->getTraceAsString());
        return response()->json([
            'error' => 'Failed to send test email',
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
});

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // User routes
    Route::get('/me', [UserController::class, 'me']);
    Route::put('/profile', [UserController::class, 'updateProfile']);
    Route::post('/logout', [UserController::class, 'logout']);

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
});




<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterAppointmentsRequest;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\Pet;
use App\Models\User;
use App\Models\VeterinarianProfile;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FilterAppointmentsRequest $request)
    {
        // Start building the query for appointments
        $query = Appointment::query();

        // Filter by veterinarian (if provided)
        if ($request->filled('veterinarian_id')) {
            $query->where('veterinarian_id', $request->veterinarian_id);
        }

        // Filter by pet (if provided)
        if ($request->filled('pet_id')) {
            $query->where('pet_id', $request->pet_id);
        }

        // Filter by status (if provided)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range (start and end date)
        if ($request->filled('start_date')) {
            $query->whereDate('start_time', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('start_time', '<=', $request->end_date);
        }

        // Apply pagination or return all results
        $appointments = $query->with(['pet', 'veterinarian'])->get(); // Or use paginate() if you want pagination

        return response()->json([
            'data' => $appointments,
        ]);
    }


    /**
     * Display available slots for a given veterinarian on a specific date.
     */
    public function availableSlots(Request $request, VeterinarianProfile $veterinarianProfile)
    {
        $date = Carbon::parse($request->query('date'));

        // Decode off_days (stored as JSON), and compare to day name
        $offDays = json_decode($veterinarianProfile->off_days ?? '[]', true);
        $dayName = $date->format('l'); // e.g., 'Monday'

        // If it's an off-day, return empty slots
        if (in_array($dayName, $offDays)) {
            return response()->json(['slots' => []]);
        }

        // Define the opening hours
        $morningStart = $date->copy()->setTime(9, 0);
        $morningEnd = $date->copy()->setTime(12, 0);
        $afternoonStart = $date->copy()->setTime(13, 0);
        $afternoonEnd = $date->copy()->setTime(16, 0);

        // Create time slots for the morning and afternoon sessions
        $morningSlots = CarbonPeriod::create($morningStart, '30 minutes', $morningEnd->subMinutes(30));
        $afternoonSlots = CarbonPeriod::create($afternoonStart, '30 minutes', $afternoonEnd->subMinutes(30));

        // Merge both morning and afternoon slots
        $slots = collect($morningSlots)->merge($afternoonSlots)->map(fn($slot) => $slot->toDateTimeString());

        // Get all booked slots for the veterinarian on this day
        $booked = $veterinarianProfile->appointments()
            ->whereDate('start_time', $date)
            ->pluck('start_time')
            ->map(fn($time) => Carbon::parse($time)->toDateTimeString());

        // Find the available slots by excluding the booked ones
        $available = $slots->diff($booked)->values();

        return response()->json(['slots' => $available]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json(Appointment::create());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'veterinarian_id' => [
                'required',
                'exists:users,id',
                function ($attribute, $value, $fail) {
                    // Check if the user has the role 'vet'
                    $user = User::find($value);

                    if (!$user || $user->role !== 'vet') {
                        $fail('The selected user is not a valid veterinarian.');
                    }
                }
            ],
            'start_time' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    try {
                        $start = Carbon::parse($value);

                        // Only allow times between 09:00–12:00 or 13:00–16:00
                        $hour = $start->hour;
                        $minute = $start->minute;

                        $allowed =
                            ($hour >= 9 && $hour < 12) ||
                            ($hour >= 13 && $hour < 16) ||
                            ($hour == 12 && $minute == 0); // Edge case if needed

                        if (!$allowed) {
                            $fail('Appointments must be scheduled between 09:00–12:00 or 13:00–16:00.');
                        }
                    } catch (\Exception $e) {
                        $fail('The start time is not a valid datetime.');
                    }
                }
            ],
            'status' => 'nullable|string|in:pending,confirmed,cancelled',
            'notes' => 'nullable|string',
        ]);

        // Convert start_time to Carbon instance
        $start = Carbon::parse($validated['start_time']);
        $validated['start_time'] = $start->format('Y-m-d H:i:s');
        $validated['end_time'] = $start->copy()->addMinutes(30)->format('Y-m-d H:i:s');

        // Check if the veterinarian is already booked at this time
        $existingAppointment = Appointment::where('veterinarian_id', $validated['veterinarian_id'])
            ->where(function ($query) use ($start) {
                $query->whereBetween('start_time', [
                    $start->format('Y-m-d H:i:s'),
                    $start->copy()->addMinutes(30)->format('Y-m-d H:i:s')
                ]);
            })
            ->exists();

        if ($existingAppointment) {
            return response()->json([
                'message' => 'The veterinarian is already booked for this time slot.',
            ], 409);  // Conflict
        }

        // Create the new appointment
        $appointment = Appointment::create($validated);

        return response()->json([
            'message' => 'Appointment created successfully',
            'data' => $appointment->load(['pet', 'veterinarian']),
        ], 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        $appointment->load(['pet', 'veterinarian']);
        return response()->json($appointment);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        return response()->json($appointment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'pet_id' => 'sometimes|exists:pets,id',
            'veterinarian_id' => 'sometimes|exists:users,id',
            'scheduled_at' => 'sometimes|date',
            'status' => 'sometimes|string|in:pending,confirmed,cancelled,completed',
            'notes' => 'sometimes|string',
        ]);

        if (isset($validated['scheduled_at'])) {
            $validated['scheduled_at'] = Carbon::parse($validated['scheduled_at'])->format('Y-m-d H:i:s');
        }

        // Check for conflicting appointment (if veterinarian and scheduled_at are updated or one of them)
        if (
            (isset($validated['veterinarian_id']) || isset($validated['scheduled_at']))
            && ($validated['veterinarian_id'] ?? $appointment->veterinarian_id)
            && ($validated['scheduled_at'] ?? $appointment->scheduled_at)
        ) {
            $vetId = $validated['veterinarian_id'] ?? $appointment->veterinarian_id;
            $scheduledAt = $validated['scheduled_at'] ?? $appointment->scheduled_at;

            $alreadyBooked = Appointment::where('veterinarian_id', $vetId)
                ->where('scheduled_at', $scheduledAt)
                ->where('id', '!=', $appointment->id) // exclude current appointment
                ->exists();

            if ($alreadyBooked) {
                return response()->json([
                    'message' => 'This veterinarian already has an appointment at the selected time.',
                ], 409);
            }
        }

        $appointment->update($validated);

        return response()->json([
            'message' => 'Appointment updated successfully',
            'data' => $appointment->load(['pet', 'veterinarian']),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {

        $appointment->delete();
        return response()->json([
            'message' => 'Appointment deleted successfully',
            'appointment' => $appointment,
        ]);
    }
}

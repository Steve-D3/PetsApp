<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use App\Models\TreatmentType;
use App\Models\MedicalRecord;
use App\Models\VaccineType;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class AppointmentDetails extends Component
{
    use WithPagination;

    public $appointment;
    public $notes;
    public $showAllMedicalRecords = false;
    public $showAllTreatments = false;
    public $showAllVaccinations = false;
    public $showMedicalRecordForm = false;
    public $showTreatmentForm = false;
    public $showVaccineForm = false;
    public $showMedicationForm = false;

    // Medical Record Form Properties
    public $chief_complaint = '';
    public $history = '';
    public $physical_examination = '';
    public $diagnosis = '';
    public $treatment_plan = '';
    public $medications = '';
    public $weight = null;
    public $temperature = null;
    public $heart_rate = null;
    public $respiratory_rate = null;
    public $follow_up_required = false;
    public $follow_up_date;
    public $showDatePicker = false;
    public $showTimeSlots = false;
    public $availableSlots = [];
    public $selectedDate;
    public $selectedTime;

    // Toast notification properties
    public $showToast = false;
    public $toastMessage = '';
    public $toastType = 'success'; // 'success' or 'error'

    // Treatment Form Properties
    public $treatment_type_id;
    public $quantity;
    public $unit;
    public $cost;
    public $administered_at;
    public $administered_by;
    public $completed = false;
    public $treatmentTypes = [];

    // Vaccine Form Properties
    public $vaccine_type_id;
    public $manufacturer;
    public $batch_number;
    public $serial_number;
    public $expiration_date;
    public $administration_date;
    public $next_due_date;
    public $vaccine_administered_by;
    public $administration_site;
    public $administration_route;
    public $dose;
    public $dose_unit;
    public $is_booster = false;
    public $certification_number;
    public $reaction_observed = false;
    public $reaction_details;
    public $vaccine_notes;
    public $vaccine_cost;
    public $vaccine_types = [];


    public function mount(Appointment $appointment)
    {
        // Eager load relationships
        $appointment->load([
            'pet',
            'pet.owner',
            'pet.medicalRecords',
            'pet.medicalRecords.treatments',
            'pet.vaccinations',
            'vaccinations',
            'veterinarian'
        ]);

        // dump($appointment);

        $this->notes = $appointment->notes;
        $this->administered_by = auth()->user()->name;
        $this->vaccine_administered_by = auth()->user()->name;
        $this->follow_up_required = false;
        $this->vaccine_types = VaccineType::all();
        $this->treatmentTypes = TreatmentType::all();
        $this->administration_date = now()->format('Y-m-d\TH:i');
        $this->expiration_date = now()->addYear()->format('Y-m-d');
        $this->next_due_date = now()->addYear()->format('Y-m-d');
    }

    public function showAllMedicalRecords()
    {
        $this->showAllMedicalRecords = true;
    }

    public function showAllTreatments()
    {
        $this->showAllTreatments = true;
    }

    public function showAllVaccinations()
    {
        $this->showAllVaccinations = true;
    }

    public function closeAllModals()
    {
        $this->showAllMedicalRecords = false;
        $this->showAllTreatments = false;
        $this->showAllVaccinations = false;
    }

    public function saveNotes()
    {
        $this->validate([
            'notes' => 'nullable|string|max:1000',
        ]);

        $this->appointment->update([
            'notes' => $this->notes,
        ]);

        $this->dispatch('show-message', ['message' => 'Notes updated successfully']);
    }


    public function createTreatment()
    {
        $this->validate([
            'treatment_type_id' => 'required|exists:treatment_types,id',
            'quantity' => 'required|numeric|min:0.1',
            'unit' => 'required|string|max:20',
            'cost' => 'required|numeric|min:0',
            'administered_at' => 'nullable|date',
            'administered_by' => 'nullable|string|max:255',
            'completed' => 'boolean',
            'notes' => 'nullable|string'
        ]);

        try {
            // Get the latest medical record or create a new one
            $medicalRecord = $this->appointment->pet->medicalRecords()->latest()->first();

            if (!$medicalRecord) {
                $medicalRecord = $this->appointment->pet->medicalRecords()->create([
                    'veterinarian_profile_id' => $this->appointment->veterinarian_profile_id,
                    'record_date' => now(),
                    'notes' => 'Auto-created for treatment'
                ]);
            }

            // Get the treatment type to get the name and other details
            $treatmentType = \App\Models\TreatmentType::findOrFail($this->treatment_type_id);

            // Create the treatment
            $treatment = new \App\Models\Treatment([
                'medical_record_id' => $medicalRecord->id,
                'treatment_type_id' => $this->treatment_type_id,
                'name' => $treatmentType->name,
                'category' => $treatmentType->category,
                'description' => $treatmentType->description,
                'quantity' => $this->quantity,
                'unit' => $this->unit,
                'cost' => $this->cost,
                'administered_at' => $this->administered_at,
                'administered_by' => auth()->id(), // Use the authenticated user's ID
                'completed' => $this->completed,
                'notes' => $this->notes
            ]);

            $treatment->save();

            // Reset form
            $this->reset([
                'treatment_type_id',
                'quantity',
                'unit',
                'cost',
                'administered_at',
                'administered_by',
                'completed',
                'notes',
                'showTreatmentForm'
            ]);

            // Refresh the appointment to show the new treatment
            $this->appointment->refresh();

            // Show success toast
            $this->toastMessage = 'Treatment added successfully!';
            $this->toastType = 'success';
            $this->showToast = true;
            
            // Close the form modal
            $this->showTreatmentForm = false;
            
        } catch (\Exception $e) {
            // Show error toast
            $this->toastMessage = 'Error adding treatment: ' . $e->getMessage();
            $this->toastType = 'error';
            $this->showToast = true;
            
            // Log the error
            \Log::error('Error adding treatment', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    public function updatedTreatmentTypeId($value)
    {
        if ($value) {
            $treatmentType = \App\Models\TreatmentType::find($value);
            if ($treatmentType) {
                $this->quantity = $treatmentType->default_quantity;
                $this->unit = $treatmentType->default_unit;
                $this->cost = $treatmentType->default_cost;
            }
        } else {
            $this->reset(['quantity', 'unit', 'cost']);
        }
    }

    public function updatedVaccineTypeId($value)
    {
        if ($value) {
            $vaccineType = \App\Models\VaccineType::find($value);
            if ($vaccineType) {
                $this->manufacturer = $vaccineType->common_manufacturers ? json_decode($vaccineType->common_manufacturers, true)[0] ?? '' : '';
                $this->administration_route = $vaccineType->default_administration_route ?? '';
                $this->dose = 1; // Default dose
                $this->dose_unit = 'ml'; // Default unit
                $this->vaccine_cost = $vaccineType->default_cost ?? 0;
                
                // Set default administration date to now
                $this->administration_date = now()->format('Y-m-d\TH:i');
                
                // Set default expiration date (1 year from now)
                $this->expiration_date = now()->addYear()->format('Y-m-d');
                
                // Set next due date based on vaccine's default validity period
                if ($vaccineType->default_validity_period) {
                    $this->next_due_date = now()->addMonths($vaccineType->default_validity_period)->format('Y-m-d');
                } else {
                    $this->next_due_date = now()->addYear()->format('Y-m-d');
                }
                
                // Set administration site based on route
                $this->administration_site = $this->getDefaultAdministrationSite($vaccineType->default_administration_route ?? '');
            }
        } else {
            $this->reset([
                'manufacturer',
                'administration_route',
                'dose',
                'dose_unit',
                'vaccine_cost',
                'administration_date',
                'expiration_date',
                'next_due_date',
                'administration_site'
            ]);
        }
    }
    
    protected function getDefaultAdministrationSite($route)
    {
        $sites = [
            'subcutaneous' => 'Right Scapular Region',
            'intramuscular' => 'Right Thigh',
            'intranasal' => 'Nasal Passage',
            'oral' => 'Mouth',
            'topical' => 'Dorsal Neck',
        ];
        
        return $sites[strtolower($route)] ?? 'Right Scapular Region';
    }

    public function showMedicalRecordForm()
    {
        $this->showMedicalRecordForm = true;
    }

    public function updatedSelectedDate($date)
    {
        if (!$date) {
            $this->showTimeSlots = false;
            $this->availableSlots = [];
            return;
        }

        // Reset selected time when date changes
        $this->selectedTime = null;
        $this->resetErrorBag('selectedDate');

        try {
            // Ensure the date is in YYYY-MM-DD format
            $formattedDate = Carbon::parse($date)->format('Y-m-d');

            // Log the request with veterinarian ID
            $veterinarianId = $this->appointment->veterinarian_id;
            $veterinarianProfileId = $this->appointment->veterinarian->user_id;

            // Use the formatted date in the URL
            $url = route('admin.vets.available-slots', [
                'veterinarianProfile' => $veterinarianId,
                'date' => $formattedDate
            ]);

            // Log to server
            \Log::info('Fetching available slots', [
                'veterinarian_id' => $veterinarianId,
                'original_date' => $date,
                'formatted_date' => $formattedDate,
                'url' => $url
            ]);
            $selectedDate = Carbon::parse($date);
            $veterinarian = $this->appointment->veterinarian;

            // Check if the selected day is an off day
            $offDays = is_array($veterinarian->off_days)
                ? $veterinarian->off_days
                : (is_string($veterinarian->off_days) ? json_decode($veterinarian->off_days, true) : []);

            $dayName = $selectedDate->format('l');

            if (is_array($offDays) && in_array($dayName, $offDays)) {
                $this->availableSlots = [];
                $this->showTimeSlots = true;
                $this->addError('selectedDate', 'The selected date is an off day. Please choose another date.');
                return;
            }

            // Define working hours (9:00-12:00 and 13:00-16:00)
            $morningStart = $selectedDate->copy()->setTime(9, 0);
            $morningEnd = $selectedDate->copy()->setTime(12, 0);
            $afternoonStart = $selectedDate->copy()->setTime(13, 0);
            $afternoonEnd = $selectedDate->copy()->setTime(16, 0);

            // Generate 30-minute slots
            $morningSlots = CarbonPeriod::create($morningStart, '30 minutes', $morningEnd->copy()->subMinutes(30));
            $afternoonSlots = CarbonPeriod::create($afternoonStart, '30 minutes', $afternoonEnd->copy()->subMinutes(30));

            // Merge both morning and afternoon slots and format them
            $allSlots = collect(iterator_to_array($morningSlots))
                ->merge(collect(iterator_to_array($afternoonSlots)))
                ->map(function ($slot) {
                    return [
                        'time' => $slot->format('H:i:s'),
                        'formatted' => $slot->format('g:i A'),
                        'full' => $slot->toDateTimeString()
                    ];
                });

            // Get all booked slots for the veterinarian on this day
            $booked = $veterinarian->appointments()
                ->whereDate('start_time', $selectedDate)
                ->pluck('start_time')
                ->map(function ($time) {
                    return Carbon::parse($time)->format('H:i:s');
                })
                ->toArray();

            // Filter out booked slots
            $availableSlots = $allSlots->filter(function ($slot) use ($booked) {
                return !in_array($slot['time'], $booked);
            })->values()->toArray();

            $this->availableSlots = $availableSlots;
            $this->showTimeSlots = true;

            if (empty($availableSlots)) {
                $this->addError('selectedDate', 'No available time slots for ' . $selectedDate->format('F j, Y') . '. Please choose another date.');
            }

        } catch (\Exception $e) {
            $errorMessage = 'Error: ' . $e->getMessage();
            $this->availableSlots = [];
            $this->showTimeSlots = false;
            $this->addError('selectedDate', 'Failed to fetch available time slots. Please try again.');

            // Log exception
            \Log::error('Error in updatedSelectedDate', [
                'error' => $e->getMessage(),
                'date' => $date ?? 'null',
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    public function createMedicalRecord()
    {
        // Debug appointment data
        \Log::info('Appointment data', [
            'appointment_id' => $this->appointment->id,
            'veterinarian_id' => $this->appointment->veterinarian_id,
            'appointment' => $this->appointment->toArray()
        ]);

        // Verify the veterinarian relationship
        if (!$this->appointment->veterinarian) {
            \Log::error('No veterinarian found for appointment', ['appointment_id' => $this->appointment->id]);
            throw new \Exception('No veterinarian is assigned to this appointment.');
        }

        // Get the veterinarian profile
        $veterinarianProfile = \App\Models\VeterinarianProfile::where('user_id', $this->appointment->veterinarian_id)->first();

        if (!$veterinarianProfile) {
            \Log::error('Veterinarian profile not found', ['user_id' => $this->appointment->veterinarian_id]);
            throw new \Exception('Veterinarian profile not found for this appointment.');
        }

        // Debug information
        \Log::info('Creating medical record', [
            'appointment_id' => $this->appointment->id,
            'pet_id' => $this->appointment->pet_id,
            'veterinarian_user_id' => $this->appointment->veterinarian_id,
            'veterinarian_profile_id' => $veterinarianProfile->id
        ]);

        // Start database transaction
        \DB::beginTransaction();

        try {
            // Create the medical record
            $medicalRecord = new MedicalRecord([
                'appointment_id' => $this->appointment->id,
                'pet_id' => $this->appointment->pet_id,
                'veterinarian_profile_id' => $veterinarianProfile->id,
                'record_date' => now(),
                'chief_complaint' => $this->chief_complaint,
                'history' => $this->history ?? null,
                'physical_examination' => $this->physical_examination ?? null,
                'diagnosis' => $this->diagnosis,
                'treatment_plan' => $this->treatment_plan ?? null,
                'medications' => $this->medications ?? null,
                'notes' => $this->notes ?? null,
                'weight' => $this->weight ?? null,
                'temperature' => $this->temperature ?? null,
                'heart_rate' => $this->heart_rate ?? null,
                'respiratory_rate' => $this->respiratory_rate ?? null,
                'follow_up_required' => $this->follow_up_required ?? false,
                'follow_up_date' => $this->follow_up_date ?? null,
            ]);

            $medicalRecord->save();

            // Handle follow-up appointment if needed
            if ($this->follow_up_required && $this->selectedDate && $this->selectedTime) {
                $followUpDateTime = Carbon::parse($this->selectedDate . ' ' . $this->selectedTime);

                // Validate that the selected time is in the available slots
                $slotTimes = array_column($this->availableSlots, 'time');
                if (!in_array($this->selectedTime, $slotTimes)) {
                    throw new \Exception('The selected time slot is no longer available.');
                }

                // Create the follow-up appointment
                $followUpAppointment = new Appointment([
                    'pet_id' => $this->appointment->pet_id,
                    'veterinarian_id' => $this->appointment->veterinarian_id,
                    'clinic_id' => $this->appointment->clinic_id,
                    'start_time' => $followUpDateTime,
                    'end_time' => $followUpDateTime->copy()->addMinutes(30), // 30-minute appointment
                    'status' => 'pending',
                    'type' => 'follow_up',
                    'reason' => 'Follow-up appointment for ' . $this->appointment->pet->name,
                    'notes' => 'Follow-up for appointment #' . $this->appointment->id . ' - ' . $this->diagnosis,
                ]);

                $followUpAppointment->save();

                // Link the medical record to the follow-up appointment
                $medicalRecord->follow_up_appointment_id = $followUpAppointment->id;
                $medicalRecord->save();
            }

            // Commit the transaction
            \DB::commit();

            // Show success toast
            $this->toastMessage = 'Medical record created successfully';
            if ($this->follow_up_required) {
                $this->toastMessage .= ' and follow-up appointment scheduled for ' . $followUpDateTime->format('M j, Y \a\t g:i A');
            }
            $this->toastType = 'success';
            $this->showToast = true;

        } catch (\Exception $e) {
            // Rollback the transaction on error
            \DB::rollBack();
            \Log::error('Error saving medical record', [
                'error' => $e->getMessage(),
                'appointment_id' => $this->appointment->id,
                'trace' => $e->getTraceAsString()
            ]);

            // Show error toast
            $this->toastMessage = 'Error saving medical record: ' . $e->getMessage();
            $this->toastType = 'error';
            $this->showToast = true;

            // Reset the form
            $this->reset([
                'chief_complaint',
                'history',
                'physical_examination',
                'diagnosis',
                'treatment_plan',
                'medications',
                'notes',
                'weight',
                'temperature',
                'heart_rate',
                'respiratory_rate',
                'follow_up_required',
                'follow_up_date',
                'showMedicalRecordForm',
                'selectedDate',
                'selectedTime',
                'availableSlots',
                'showTimeSlots'
            ]);

            // Close the modal
            $this->showMedicalRecordForm = false;

            // Dispatch event to refresh parent components if needed
            $this->dispatch('medicalRecordCreated');
        }
    }

    public function createMedication()
    {
        $this->showMedicationForm = true;
    }

    public function updatedFollowUpRequired($value)
    {
        $this->reset(['follow_up_date', 'selectedDate', 'selectedTime', 'availableSlots']);
        $this->showTimeSlots = false;

        if ($value) {
            // Set default follow-up date to 1 week from now
            $this->selectedDate = now()->addWeek()->format('Y-m-d');
            $this->updatedSelectedDate($this->selectedDate);
        }
    }

    // Close toast notification
    public function closeToast()
    {
        $this->showToast = false;
    }
    
    public function createVaccine()
    {
        $this->validate([
            'vaccine_type_id' => 'required|exists:vaccine_types,id',
            'manufacturer' => 'required|string|max:255',
            'batch_number' => 'required|string|max:100',
            'serial_number' => 'nullable|string|max:100',
            'expiration_date' => 'required|date',
            'administration_date' => 'required|date',
            'next_due_date' => 'required|date|after:administration_date',
            'vaccine_administered_by' => 'required|string|max:255',
            'administration_site' => 'required|string|max:100',
            'administration_route' => 'required|string|max:100',
            'dose' => 'required|numeric|min:0.1',
            'dose_unit' => 'required|string|max:20',
            'is_booster' => 'boolean',
            'certification_number' => 'nullable|string|max:100',
            'reaction_observed' => 'boolean',
            'reaction_details' => 'nullable|string',
            'vaccine_notes' => 'nullable|string',
            'vaccine_cost' => 'required|numeric|min:0',
        ]);

        try {
            // Get the latest medical record or create a new one
            $medicalRecord = $this->appointment->pet->medicalRecords()->latest()->first();

            if (!$medicalRecord) {
                $medicalRecord = $this->appointment->pet->medicalRecords()->create([
                    'veterinarian_profile_id' => $this->appointment->veterinarian_profile_id,
                    'record_date' => now(),
                    'notes' => 'Auto-created for vaccine record'
                ]);
            }


            // Create the vaccine record
            $vaccination = new \App\Models\Vaccination([
                'pet_id' => $this->appointment->pet_id,
                'medical_record_id' => $medicalRecord->id,
                'vaccine_type_id' => $this->vaccine_type_id,
                'manufacturer' => $this->manufacturer,
                'batch_number' => $this->batch_number,
                'serial_number' => $this->serial_number,
                'expiration_date' => $this->expiration_date,
                'administration_date' => $this->administration_date,
                'next_due_date' => $this->next_due_date,
                'administered_by' => auth()->id(), // Use authenticated user's ID
                'administration_site' => $this->administration_site,
                'administration_route' => $this->administration_route,
                'dose' => $this->dose,
                'dose_unit' => $this->dose_unit,
                'is_booster' => $this->is_booster ?? false,
                'certification_number' => $this->certification_number,
                'reaction_observed' => $this->reaction_observed ?? false,
                'reaction_details' => $this->reaction_details,
                'notes' => $this->vaccine_notes,
                'cost' => $this->vaccine_cost,
            ]);

            $vaccination->save();

            // Reset form
            $this->reset([
                'vaccine_type_id',
                'manufacturer',
                'batch_number',
                'serial_number',
                'expiration_date',
                'administration_date',
                'next_due_date',
                'vaccine_administered_by',
                'administration_site',
                'administration_route',
                'dose',
                'dose_unit',
                'is_booster',
                'certification_number',
                'reaction_observed',
                'reaction_details',
                'vaccine_notes',
                'vaccine_cost',
                'showVaccineForm'
            ]);

            // Refresh the appointment to show the new vaccination
            $this->appointment->refresh();

            // Show success toast
            $this->toastMessage = 'Vaccination record added successfully!';
            $this->toastType = 'success';
            $this->showToast = true;
            
            // Close the form modal
            $this->showVaccineForm = false;
            
        } catch (\Exception $e) {
            // Show error toast
            $this->toastMessage = 'Error adding vaccination record: ' . $e->getMessage();
            $this->toastType = 'error';
            $this->showToast = true;
            
            // Log the error
            \Log::error('Error adding vaccination record', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    public function render()
    {
        $medicalRecord = $this->appointment->medicalRecord;

        // Add JavaScript to auto-hide toast after 5 seconds
        $this->dispatch('toast-timeout');

        return view('livewire.admin.appointment-details', [
            'medicalRecord' => $medicalRecord,
        ]);
    }
}

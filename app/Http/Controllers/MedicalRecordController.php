<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterMedicalRecordRequest;
use App\Http\Requests\StoreMedicalRecordRequest;
use App\Http\Requests\UpdateMedicalRecordRequest;
use App\Models\MedicalRecord;
use Illuminate\Http\JsonResponse;

class MedicalRecordController extends Controller
{

    /**
     * Display a listing of the filtered medical records.
     *
     * @param FilterMedicalRecordRequest $request
     * @return JsonResponse
     */
    public function index(FilterMedicalRecordRequest $request)
    {
        $validated = $request->validated();

        $query = MedicalRecord::with(['pet', 'vet', 'appointment', 'treatments', 'vaccinations']);

        // Apply filters
        if (isset($validated['pet_id'])) {
            $query->where('pet_id', $validated['pet_id']);
        }

        if (isset($validated['veterinarian_id'])) {
            $query->where('veterinarian_profile_id', $validated['veterinarian_id']);
        }

        if (isset($validated['appointment_id'])) {
            $query->where('appointment_id', $validated['appointment_id']);
        }

        if (isset($validated['diagnosis'])) {
            $query->where('diagnosis', 'like', '%' . $validated['diagnosis'] . '%');
        }

        if (isset($validated['follow_up_required'])) {
            $query->where('follow_up_required', $validated['follow_up_required']);
        }

        // Date range filter
        if (isset($validated['start_date'])) {
            $query->whereDate('record_date', '>=', $validated['start_date']);
        }

        if (isset($validated['end_date'])) {
            $query->whereDate('record_date', '<=', $validated['end_date']);
        }

        // Sorting
        $sortBy = $validated['sort_by'] ?? 'record_date';
        $sortOrder = $validated['sort_order'] ?? 'desc';
        $query->orderBy($sortBy, $sortOrder);

        $medicalRecords = $query->get();

        return response()->json($medicalRecords);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created medical record in storage.
     *
     * @param StoreMedicalRecordRequest $request
     * @return JsonResponse
     */
    public function store(StoreMedicalRecordRequest $request)
    {
        try {
            // Get the validated data
            $validated = $request->validated();

            // Create the medical record
            $medicalRecord = MedicalRecord::create([
                'pet_id' => $validated['pet_id'],
                'veterinarian_profile_id' => $validated['veterinarian_profile_id'],
                'appointment_id' => $validated['appointment_id'] ?? null,
                'record_date' => $validated['record_date'],
                'chief_complaint' => $validated['chief_complaint'],
                'history' => $validated['history'] ?? null,
                'physical_examination' => $validated['physical_examination'] ?? null,
                'diagnosis' => $validated['diagnosis'],
                'treatment_plan' => $validated['treatment_plan'] ?? null,
                'medications' => $validated['medications'] ?? null,
                'notes' => $validated['notes'] ?? null,
                'weight' => $validated['weight'] ?? null,
                'temperature' => $validated['temperature'] ?? null,
                'heart_rate' => $validated['heart_rate'] ?? null,
                'respiratory_rate' => $validated['respiratory_rate'] ?? null,
                'follow_up_required' => $validated['follow_up_required'],
                'follow_up_date' => $validated['follow_up_date'] ?? null,
            ]);

            // Load relationships for the response
            $medicalRecord->load(['pet', 'vet', 'appointment']);

            return response()->json([
                'message' => 'Medical record created successfully',
                'data' => $medicalRecord
            ], 201);

        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error creating medical record: ' . $e->getMessage());

            return response()->json([
                'message' => 'Failed to create medical record',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicalRecord $medicalRecord)
    {
        $data = $medicalRecord->load(['pet', 'vet', 'appointment', 'treatments', 'vaccinations']);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicalRecord $medicalRecord)
    {
        //
    }

    /**
     * Update the specified medical record in storage.
     *
     * @param UpdateMedicalRecordRequest $request
     * @param MedicalRecord $medicalRecord
     * @return JsonResponse
     */
    public function update(UpdateMedicalRecordRequest $request, MedicalRecord $medicalRecord)
    {
        try {
            // Get the validated data
            $validated = $request->validated();

            // Prepare the update data
            $updateData = [
                'pet_id' => $validated['pet_id'] ?? $medicalRecord->pet_id,
                'veterinarian_profile_id' => $validated['veterinarian_profile_id'] ?? $medicalRecord->veterinarian_profile_id,
                'appointment_id' => $validated['appointment_id'] ?? $medicalRecord->appointment_id,
                'record_date' => $validated['record_date'] ?? $medicalRecord->record_date,
                'chief_complaint' => $validated['chief_complaint'] ?? $medicalRecord->chief_complaint,
                'history' => $validated['history'] ?? $medicalRecord->history,
                'physical_examination' => $validated['physical_examination'] ?? $medicalRecord->physical_examination,
                'diagnosis' => $validated['diagnosis'] ?? $medicalRecord->diagnosis,
                'treatment_plan' => $validated['treatment_plan'] ?? $medicalRecord->treatment_plan,
                'medications' => $validated['medications'] ?? $medicalRecord->medications,
                'notes' => $validated['notes'] ?? $medicalRecord->notes,
                'weight' => $validated['weight'] ?? $medicalRecord->weight,
                'temperature' => $validated['temperature'] ?? $medicalRecord->temperature,
                'heart_rate' => $validated['heart_rate'] ?? $medicalRecord->heart_rate,
                'respiratory_rate' => $validated['respiratory_rate'] ?? $medicalRecord->respiratory_rate,
                'follow_up_required' => $validated['follow_up_required'] ?? $medicalRecord->follow_up_required,
                'follow_up_date' => $validated['follow_up_date'] ?? $medicalRecord->follow_up_date,
            ];

            // Update the medical record
            $medicalRecord->update($updateData);

            // Load relationships for the response
            $medicalRecord->load(['pet', 'vet', 'appointment']);

            return response()->json([
                'message' => 'Medical record updated successfully',
                'data' => $medicalRecord
            ]);

        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error updating medical record: ' . $e->getMessage());

            return response()->json([
                'message' => 'Failed to update medical record',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalRecord $medicalRecord)
    {
        $medicalRecord->delete();
        return response()->json([
            'message' => 'Medical record deleted successfully',
            'medicalRecord' => $medicalRecord,
        ]);
    }
}

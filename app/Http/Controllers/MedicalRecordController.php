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
    public function edit($pet, $record)
    {
        $medicalRecord = MedicalRecord::with(['pet', 'vet', 'treatments', 'vaccinations'])
            ->findOrFail($record);
            
        return view('admin.medical-records.edit', [
            'record' => $medicalRecord,
            'pet' => $medicalRecord->pet,
            'treatments' => $medicalRecord->treatments,
            'vaccinations' => $medicalRecord->vaccinations
        ]);
    }

    /**
     * Update the specified medical record in storage.
     *
     * @param UpdateMedicalRecordRequest $request
     * @param MedicalRecord $medicalRecord
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateMedicalRecordRequest $request, $pet, $record)
    {
        try {
            $medicalRecord = MedicalRecord::findOrFail($record);
            
            // Get the validated data
            $validated = $request->validated();

            // Prepare the update data
            $updateData = [
                'record_date' => $validated['record_date'],
                'chief_complaint' => $validated['chief_complaint'],
                'diagnosis' => $validated['diagnosis'],
                'treatment_plan' => $validated['treatment_plan'] ?? null,
                'notes' => $validated['notes'] ?? null,
                'follow_up_required' => $request->has('follow_up_required'),
                'follow_up_date' => $request->has('follow_up_required') ? $validated['follow_up_date'] : null,
            ];

            // Update the medical record
            $medicalRecord->update($updateData);

            return redirect()
                ->route('medical-records.show', ['pet' => $pet, 'record' => $record])
                ->with('status', 'Medical record updated successfully!');

        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error updating medical record: ' . $e->getMessage());

            return back()
                ->withInput()
                ->withErrors(['error' => 'Failed to update medical record. Please try again.']);
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

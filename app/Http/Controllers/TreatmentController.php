<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTreatmentRequest;
use App\Http\Requests\UpdateTreatmentRequest;
use App\Models\Treatment;
use Illuminate\Http\JsonResponse;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $treatments = Treatment::all();
        return response()->json($treatments);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTreatmentRequest $request
     * @return JsonResponse
     */
    public function store(StoreTreatmentRequest $request): JsonResponse
    {
        try {
            // Set default values if not provided
            $validated = $request->validated();

            // Set default values if not provided
            if (!isset($validated['completed'])) {
                $validated['completed'] = true; // Default to completed if not specified
            }

            if (!isset($validated['quantity'])) {
                $validated['quantity'] = 1.00; // Default quantity to 1 if not specified
            }

            // Create the treatment with validated data
            $treatment = Treatment::create($validated);

            // Load the relationships for the response
            $treatment->load(['medicalRecord', 'administeredBy']);

            return response()->json([
                'message' => 'Treatment created successfully',
                'data' => $treatment
            ], 201);

        } catch (\Exception $e) {
            \Log::error('Error creating treatment: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to create treatment',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Treatment $treatment)
    {
        return response()->json($treatment);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Treatment $treatment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTreatmentRequest $request
     * @param Treatment $treatment
     * @return JsonResponse
     */
    public function update(UpdateTreatmentRequest $request, Treatment $treatment): JsonResponse
    {
        try {
            // Update the treatment with validated data
            $treatment->update($request->validated());

            // Refresh the model to get any changes from the database
            $treatment->refresh();

            // Load the relationships for the response
            $treatment->load(['medicalRecord', 'administeredBy']);

            return response()->json([
                'message' => 'Treatment updated successfully',
                'data' => $treatment
            ]);

        } catch (\Exception $e) {
            \Log::error('Error updating treatment: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to update treatment',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Treatment $treatment)
    {
        $treatment->delete();
        return response()->json([
            'message' => 'Treatment deleted successfully',
            'data' => $treatment
        ]);
    }
}

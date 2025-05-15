<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTreatmentTypeRequest;
use App\Http\Requests\UpdateTreatmentTypeRequest;
use App\Models\TreatmentType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TreatmentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $treatmentTypes = TreatmentType::all();
        return response()->json($treatmentTypes);
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
     * @param StoreTreatmentTypeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreTreatmentTypeRequest $request): JsonResponse
    {
        try {
            // Create the treatment type with validated data
            $treatmentType = TreatmentType::create($request->validated());

            return response()->json([
                'message' => 'Treatment type created successfully',
                'data' => $treatmentType
            ], 201);
            
        } catch (\Exception $e) {
            \Log::error('Error creating treatment type: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to create treatment type',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TreatmentType $treatmentType)
    {
        return response()->json($treatmentType);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TreatmentType $treatmentType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTreatmentTypeRequest $request
     * @param TreatmentType $treatmentType
     * @return JsonResponse
     */
    public function update(UpdateTreatmentTypeRequest $request, TreatmentType $treatmentType): JsonResponse
    {
        try {
            // Update the treatment type with validated data
            $treatmentType->update($request->validated());
            
            // Refresh the model to get any changes from the database
            $treatmentType->refresh();

            return response()->json([
                'message' => 'Treatment type updated successfully',
                'data' => $treatmentType
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Error updating treatment type: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to update treatment type',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TreatmentType $treatmentType)
    {
        $treatmentType->delete();
        return response()->json([
            'message' => 'Treatment type deleted successfully',
            'data' => $treatmentType
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVaccineTypeRequest;
use App\Http\Requests\UpdateVaccineTypeRequest;
use App\Models\VaccineType;

class VaccineTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vaccineTypes = VaccineType::all();
        return response()->json($vaccineTypes);
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
    public function store(StoreVaccineTypeRequest $request)
    {
        try {
            // Create the vaccine type with validated data
            $vaccineType = VaccineType::create($request->validated());

            return response()->json([
                'message' => 'Vaccine type created successfully',
                'data' => $vaccineType
            ], 201);

        } catch (\Exception $e) {
            \Log::error('Error creating vaccine type: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to create vaccine type',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(VaccineType $vaccineType)
    {
        return response()->json($vaccineType);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VaccineType $vaccineType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVaccineTypeRequest $request, VaccineType $vaccineType)
    {
        try {
            // Update the vaccine type with the validated data
            $vaccineType->update($request->validated());
            
            // Refresh the model to get any changes from the database
            $vaccineType->refresh();

            return response()->json([
                'message' => 'Vaccine type updated successfully',
                'data' => $vaccineType
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Error updating vaccine type: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to update vaccine type',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VaccineType $vaccineType)
    {
        $vaccineType->delete();
        return response()->json([
            'message' => 'Vaccine type deleted successfully',
            'data' => $vaccineType
        ]);
    }
}

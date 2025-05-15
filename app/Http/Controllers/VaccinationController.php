<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVaccinationRequest;
use App\Http\Requests\UpdateVaccinationRequest;
use App\Models\Vaccination;

class VaccinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vaccinations = Vaccination::all();
        return response()->json($vaccinations);
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
    public function store(StoreVaccinationRequest $request)
    {
        try {
            // Create the vaccination record
            $vaccination = Vaccination::create($request->validated());

            // Load the related data for the response
            $vaccination->load('vaccinationType');

            return response()->json([
                'message' => 'Vaccination record created successfully',
                'data' => $vaccination
            ], 201);

        } catch (\Exception $e) {
            \Log::error('Error creating vaccination record: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to create vaccination record',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Vaccination $vaccination)
    {
        $vaccination = Vaccination::with('vaccinationType')->find($vaccination->id);
        return response()->json($vaccination);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vaccination $vaccination)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVaccinationRequest $request, Vaccination $vaccination)
    {
        try {
            // Update the vaccination record with the validated data
            $vaccination->update($request->validated());
            
            // Load the updated record with its relationships
            $vaccination->load('vaccinationType');
            
            return response()->json([
                'message' => 'Vaccination record updated successfully',
                'data' => $vaccination
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Error updating vaccination record: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to update vaccination record',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vaccination $vaccination)
    {
        $vaccination->delete();
        return response()->json([
            'message' => 'Vaccination deleted successfully',
            'data' => $vaccination
        ]);
    }
}

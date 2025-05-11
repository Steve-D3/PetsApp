<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVetClinicRequest;
use App\Http\Requests\UpdateVetClinicRequest;
use App\Models\VetClinic;

class VetClinicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(VetClinic::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json(VetClinic::create());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVetClinicRequest $request)
    {
        $vetClinic = VetClinic::create($request->validated());
        return response()->json([
            'message' => 'Vet clinic created successfully',
            'data' => $vetClinic
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(VetClinic $id)
    {
        $id = VetClinic::with('veterinarians')->find($id->id);
        return response()->json($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VetClinic $vetClinic)
    {
        return response()->json(VetClinic::create($vetClinic->id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVetClinicRequest $request, VetClinic $vetClinic)
    {
        $vetClinic->update($request->validated());
        return response()->json([
            'message' => 'Vet clinic updated successfully',
            'data' => $vetClinic
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VetClinic $vetClinic)
    {
        $vetClinic->delete();
        return response()->json([
            'message' => 'Vet clinic deleted successfully',
            'data' => $vetClinic
        ]);
    }
}

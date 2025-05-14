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
        //
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
        //
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

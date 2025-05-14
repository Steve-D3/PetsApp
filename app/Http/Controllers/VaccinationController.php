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
        //
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
        //
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

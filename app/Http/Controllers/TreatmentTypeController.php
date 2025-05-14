<?php

namespace App\Http\Controllers;

use App\Models\TreatmentType;
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TreatmentType $treatmentType)
    {
        //
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
    public function update(Request $request, TreatmentType $treatmentType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TreatmentType $treatmentType)
    {
        //
    }
}

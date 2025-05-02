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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVetClinicRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(VetClinic $id)
    {
        return response()->json($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VetClinic $vetClinic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVetClinicRequest $request, VetClinic $vetClinic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VetClinic $vetClinic)
    {
        //
    }
}

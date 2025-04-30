<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePetRequest;
use App\Http\Requests\UpdatePetRequest;
use App\Models\Pet;

class PetController extends Controller
{
    /**
     * Display all pets in the database.
     */
    public function index()
    {
        return response()->json(Pet::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a new pet in the database.
     */
    public function store(StorePetRequest $request)
    {
        $pet = Pet::create($request->all());
        return response()->json([
            'message' => 'Pet created successfully',
            'pet' => $pet
        ]);
    }

    /**
     * Display a specific pet.
     */
    public function show(Pet $id)
    {

        return response()->json($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pet $pet)
    {
        //
    }

    /**
     * Update the info of a specific pet.
     */
    public function update(UpdatePetRequest $request, $petId)
    {
        $pet = Pet::findOrFail($petId);
        $pet->update($request->all());
        return response()->json([
            'message' => 'Pet updated successfully',
            'pet' => $pet
        ]);
    }

    /**
     * Remove a specific pet.
     */
    public function destroy(Pet $pet)
    {
        Pet::destroy($pet->id);
        return response()->json([
            'message' => 'Pet deleted successfully',
            'pet' => $pet
        ]);
    }
}

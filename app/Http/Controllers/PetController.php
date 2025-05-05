<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetFilterRequest;
use App\Http\Requests\StorePetRequest;
use App\Http\Requests\UpdatePetRequest;
use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Display all pets in the database.
     */
    public function index(PetFilterRequest $request)
    {
        $query = Pet::query();

        $filters = $request->validated();

        if (isset($filters['species'])) {
            $query->where('species', $filters['species']);
        }

        if (isset($filters['breed'])) {
            $query->where('breed', $filters['breed']);
        }

        if (isset($filters['gender'])) {
            $query->where('gender', $filters['gender']);
        }

        if (isset($filters['sterilized'])) {
            $query->where('sterilized', $filters['sterilized']);
        }

        if (isset($filters['min_weight'])) {
            $query->where('weight', '>=', $filters['min_weight']);
        }

        if (isset($filters['max_weight'])) {
            $query->where('weight', '<=', $filters['max_weight']);
        }

        if (isset($filters['birth_date_from'])) {
            $query->where('birth_date', '>=', $filters['birth_date_from']);
        }

        if (isset($filters['birth_date_to'])) {
            $query->where('birth_date', '<=', $filters['birth_date_to']);
        }

        if (isset($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (isset($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }

        return response()->json($query->get()->load('owner'));
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
        $pet = Pet::create($request->validated());

        return response()->json([
            'message' => 'Pet created successfully',
            'data' => $pet
        ], 201);
    }

    /**
     * Display a specific pet.
     */
    public function show(Pet $pet)
    {
        $pet->load('owner');
        return response()->json($pet);
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
    public function update(UpdatePetRequest $request, Pet $pet)
    {
        $pet->update($request->validated());

        return response()->json([
            'message' => 'Pet updated successfully',
            'data' => $pet->fresh() // to return the updated instance
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

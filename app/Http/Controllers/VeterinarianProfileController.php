<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVeterinarianProfileRequest;
use App\Http\Requests\UpdateVeterinarianProfileRequest;
use App\Models\VeterinarianProfile;

class VeterinarianProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(VeterinarianProfile::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json(VeterinarianProfile::create());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVeterinarianProfileRequest $request)
    {
        $veterinarianProfile = VeterinarianProfile::create($request->validated());

        return response()->json([
            'message' => 'Veterinarian profile created successfully',
            'data' => $veterinarianProfile
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(VeterinarianProfile $veterinarianProfile)
    {
        return response()->json($veterinarianProfile);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VeterinarianProfile $veterinarianProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVeterinarianProfileRequest $request, VeterinarianProfile $veterinarianProfile)
    {
        $veterinarianProfile->update($request->validated());

        return response()->json([
            'message' => 'Veterinarian profile updated successfully',
            'data' => $veterinarianProfile
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VeterinarianProfile $veterinarianProfile)
    {
        // Get the user before deleting the profile
        $user = $veterinarianProfile->user;

        // Delete the veterinarian profile
        $veterinarianProfile->delete();

        // delete appointments
        $veterinarianProfile->appointments()->delete();

        // Delete the associated user
        if ($user) {
            $user->delete();
        }

        return response()->json([
            'message' => 'Veterinarian profile and associated user deleted successfully',
            'data' => $veterinarianProfile
        ]);
    }
}

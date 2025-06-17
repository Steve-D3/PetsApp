<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetFilterRequest;
use App\Http\Requests\StorePetRequest;
use App\Http\Requests\UpdatePetRequest;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        try {
            // Get all validated data
            $validated = $request->validated();
            
            // Handle photo upload if present
            if ($request->filled('photo') && is_string($request->photo)) {
                $photo = $request->photo;
                
                // Check if it's a base64 image
                if (preg_match('/^data:image\/(\w+);base64,/', $photo, $matches)) {
                    $imageType = $matches[1];
                    $image = substr($photo, strpos($photo, ',') + 1);
                    $image = str_replace(' ', '+', $image);
                    
                    // Validate base64 data
                    if (!preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $image)) {
                        throw new \Exception('Invalid base64 image data');
                    }
                    
                    // Generate filename and path
                    $imageName = 'pet_' . time() . '_' . uniqid() . '.' . $imageType;
                    $path = 'pet-photos/' . $imageName;
                    
                    // Save to storage
                    if (!Storage::disk('public')->put($path, base64_decode($image))) {
                        throw new \Exception('Failed to save image');
                    }
                    
                    // Update the validated data with the new path
                    $validated['photo'] = $path;
                } else {
                    // If it's not a base64 string, remove it from validated data
                    unset($validated['photo']);
                }
            }
            
            // Create the pet
            $pet = Pet::create($validated);
            
            return response()->json([
                'message' => 'Pet created successfully',
                'data' => $pet->load('owner')
            ], 201);
            
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error creating pet: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            
            return response()->json([
                'message' => 'Error creating pet',
                'error' => $e->getMessage()
            ], 500);
        }
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
        try {
            // Get all validated data
            $validated = $request->validated();
            
            // Handle photo upload if present
            if ($request->filled('photo') && is_string($request->photo)) {
                $photo = $request->photo;
                
                // Check if it's a base64 image
                if (preg_match('/^data:image\/(\w+);base64,/', $photo, $matches)) {
                    $imageType = $matches[1];
                    $image = substr($photo, strpos($photo, ',') + 1);
                    $image = str_replace(' ', '+', $image);
                    
                    // Validate base64 data
                    if (!preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $image)) {
                        throw new \Exception('Invalid base64 image data');
                    }
                    
                    // Delete old photo if it exists
                    if ($pet->photo && Storage::disk('public')->exists($pet->photo)) {
                        Storage::disk('public')->delete($pet->photo);
                    }
                    
                    // Generate filename and path
                    $imageName = 'pet_' . time() . '_' . uniqid() . '.' . $imageType;
                    $path = 'pet-photos/' . $imageName;
                    
                    // Save to storage
                    if (!Storage::disk('public')->put($path, base64_decode($image))) {
                        throw new \Exception('Failed to save image');
                    }
                    
                    // Update the validated data with the new path
                    $validated['photo'] = $path;
                } elseif ($photo === 'null' || $photo === '') {
                    // If photo is explicitly set to null or empty string, delete the existing photo
                    if ($pet->photo && Storage::disk('public')->exists($pet->photo)) {
                        Storage::disk('public')->delete($pet->photo);
                    }
                    $validated['photo'] = null;
                } else {
                    // If it's not a base64 string and not null/empty, keep the existing photo
                    unset($validated['photo']);
                }
            } else {
                // If no photo is provided, keep the existing one
                unset($validated['photo']);
            }
            
            // Update the pet
            $pet->update($validated);
            
            return response()->json([
                'message' => 'Pet updated successfully',
                'data' => $pet->load('owner')
            ]);
            
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error updating pet: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            
            return response()->json([
                'message' => 'Error updating pet',
                'error' => $e->getMessage()
            ], 500);
        }
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

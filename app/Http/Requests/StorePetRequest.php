<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $petId = $this->route('pet')->id ?? null;

        return [
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'photo' => 'nullable|string',
            'microchip_number' => 'nullable|string|unique:pets,microchip_number,' . $petId,
            'sterilized' => 'required|boolean',
            'species' => 'required|string',
            'breed' => 'nullable|string',
            'gender' => 'nullable|in:Male,Female',
            'weight' => 'required|numeric|min:0',
            'birth_date' => 'nullable|date',
            'allergies' => 'nullable|string',
            'food_preferences' => 'nullable|string',
        ];
    }
}

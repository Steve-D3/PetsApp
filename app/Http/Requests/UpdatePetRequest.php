<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePetRequest extends FormRequest
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
        return [
            'name' => 'string|max:255',
            'photo' => 'nullable|image|max:2048',
            'microchip_number' => 'nullable|string|max:255',
            'sterilized' => 'boolean',
            'species' => 'nullable|string',
            'breed' => 'nullable|string',
            'gender' => 'nullable|in:Male,Female',
            'weight' => 'numeric|min:0.01|max:100',
            'birth_date' => 'nullable|date|before:today',
            'allergies' => 'nullable|string',
            'food_preferences' => 'nullable|string',
        ];
    }
}

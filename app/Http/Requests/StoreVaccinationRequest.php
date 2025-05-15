<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVaccinationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Update this based on your authentication/authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'pet_id' => 'required|exists:pets,id',
            'medical_record_id' => 'nullable|exists:medical_records,id',
            'vaccine_type_id' => 'required|exists:vaccine_types,id',
            'manufacturer' => 'nullable|string|max:255',
            'batch_number' => 'nullable|string|max:100',
            'serial_number' => 'nullable|string|max:100',
            'expiration_date' => 'nullable|date|after_or_equal:today',
            'administration_date' => 'required|date|before_or_equal:today',
            'next_due_date' => 'nullable|date|after:administration_date',
            'administered_by' => 'nullable|exists:veterinarian_profiles,id',
            'administration_site' => 'nullable|string|max:100',
            'administration_route' => 'nullable|string|max:100',
            'dose' => 'nullable|numeric|min:0',
            'dose_unit' => 'nullable|string|max:50',
            'is_booster' => 'boolean',
            'certification_number' => 'nullable|string|max:100',
            'reaction_observed' => 'boolean',
            'reaction_details' => 'nullable|string',
            'notes' => 'nullable|string',
            'cost' => 'nullable|numeric|min:0',
        ];
    }
}

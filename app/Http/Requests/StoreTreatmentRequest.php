<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTreatmentRequest extends FormRequest
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
            'medical_record_id' => 'required|exists:medical_records,id',
            'treatment_type_id' => 'required|exists:treatment_types,id',
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'cost' => 'nullable|numeric|min:0',
            'quantity' => 'sometimes|numeric|min:0.01',
            'unit' => 'nullable|string|max:50',
            'completed' => 'sometimes|boolean',
            'administered_at' => 'nullable|date',
            'administered_by' => 'nullable|exists:users,id',
        ];
    }
    
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'medical_record_id.required' => 'A medical record is required for this treatment.',
            'medical_record_id.exists' => 'The selected medical record does not exist.',
            'treatment_type_id.required' => 'A treatment type is required.',
            'treatment_type_id.exists' => 'The selected treatment type does not exist.',
            'name.required' => 'The treatment name is required.',
            'cost.numeric' => 'The cost must be a valid number.',
            'cost.min' => 'The cost must be at least 0.',
            'quantity.min' => 'The quantity must be at least 0.01.',
            'administered_by.exists' => 'The selected administrator does not exist.',
        ];
    }
}

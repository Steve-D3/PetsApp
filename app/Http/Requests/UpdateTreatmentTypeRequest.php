<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTreatmentTypeRequest extends FormRequest
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
        $treatmentTypeId = $this->route('treatment_type');
        
        return [
            'name' => 'sometimes|required|string|max:255|unique:treatment_types,name,' . $treatmentTypeId,
            'category' => 'sometimes|required|string|max:100',
            'description' => 'nullable|string',
            'default_cost' => 'nullable|numeric|min:0',
            'default_unit' => 'nullable|string|max:50',
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
            'name.required' => 'The treatment type name is required.',
            'name.unique' => 'A treatment type with this name already exists.',
            'category.required' => 'The category field is required.',
            'default_cost.numeric' => 'The default cost must be a valid number.',
            'default_cost.min' => 'The default cost must be at least 0.',
        ];
    }
}

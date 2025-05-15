<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVaccineTypeRequest extends FormRequest
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
        $vaccineTypeId = $this->route('vaccine_type');
        
        return [
            'name' => 'sometimes|required|string|max:255|unique:vaccine_types,name,' . $vaccineTypeId,
            'category' => 'sometimes|required|string|in:Core,Non-core,Not recommended',
            'for_species' => 'sometimes|required|string|in:Dog,Cat,Both,Exotic,Other',
            'description' => 'nullable|string',
            'default_validity_period' => 'nullable|integer|min:1',
            'is_required_by_law' => 'sometimes|boolean',
            'minimum_age_days' => 'nullable|integer|min:0',
            'administration_protocol' => 'nullable|string',
            'common_manufacturers' => 'nullable|string|max:500',
            'requires_booster' => 'sometimes|boolean',
            'booster_waiting_period' => 'nullable|integer|min:1|required_if:requires_booster,true',
            'default_administration_route' => 'nullable|string|max:100',
            'default_cost' => 'nullable|numeric|min:0',
        ];
    }
}

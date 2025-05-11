<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVeterinarianProfileRequest extends FormRequest
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
            'user_id' => 'exists:users,id',
            'license_number' => 'string|max:255',
            'specialty' => 'string|max:255',
            'biography' => 'string',
            'phone_number' => 'string|max:255',
            'vet_clinic_id' => 'exists:vet_clinics,id',
            'off_days' => 'array',
        ];
    }
}

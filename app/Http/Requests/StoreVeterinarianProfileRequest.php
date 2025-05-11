<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVeterinarianProfileRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'license_number' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'biography' => 'required|string',
            'phone_number' => 'required|string|max:255',
            'vet_clinic_id' => 'required|exists:vet_clinics,id',
            'off_days' => 'required|array',
        ];
    }
}

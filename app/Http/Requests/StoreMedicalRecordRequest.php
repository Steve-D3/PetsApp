<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicalRecordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Update this based on your authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'pet_id' => 'required|integer|exists:pets,id',
            'veterinarian_profile_id' => 'required|integer|exists:veterinarian_profiles,id',
            'appointment_id' => 'nullable|integer|exists:appointments,id',
            'record_date' => 'required|date|before_or_equal:today',
            'chief_complaint' => 'required|string|max:500',
            'history' => 'nullable|string',
            'physical_examination' => 'nullable|string',
            'diagnosis' => 'required|string|max:500',
            'treatment_plan' => 'nullable|string',
            'medications' => 'nullable|string',
            'notes' => 'nullable|string',
            'weight' => 'nullable|numeric|min:0.1|max:200',
            'temperature' => 'nullable|numeric|min:30|max:42',
            'heart_rate' => 'nullable|integer|min:20|max:300',
            'respiratory_rate' => 'nullable|integer|min:5|max:200',
            'follow_up_required' => 'required|boolean',
            'follow_up_date' => 'required_if:follow_up_required,true|date|after_or_equal:today',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'pet_id.required' => 'Please select a pet.',
            'veterinarian_profile_id.required' => 'Please select a veterinarian.',
            'record_date.required' => 'The record date is required.',
            'chief_complaint.required' => 'The chief complaint field is required.',
            'diagnosis.required' => 'The diagnosis field is required.',
            'follow_up_date.required_if' => 'Follow up date is required when follow up is required.',
            'follow_up_date.after_or_equal' => 'Follow up date must be today or a future date.',
        ];
    }
}

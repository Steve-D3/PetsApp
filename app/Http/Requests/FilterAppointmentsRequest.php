<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterAppointmentsRequest extends FormRequest
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
            'veterinarian_id' => 'nullable|exists:users,id',  // Ensure it's a valid vet user
            'status' => 'nullable|in:pending,confirmed,cancelled,completed',
            'start_date' => 'nullable|date|before_or_equal:end_date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ];
    }

    /**
     * Prepare the data for validation, such as converting any necessary values.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        // Optionally, prepare any request data before validation if needed
        if ($this->has('start_date')) {
            $this->merge([
                'start_date' => \Carbon\Carbon::parse($this->start_date)->toDateString(),
            ]);
        }

        if ($this->has('end_date')) {
            $this->merge([
                'end_date' => \Carbon\Carbon::parse($this->end_date)->toDateString(),
            ]);
        }
    }
}

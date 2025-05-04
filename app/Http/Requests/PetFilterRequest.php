<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetFilterRequest extends FormRequest
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
            'user_id' => 'integer|exists:users,id',
            'name' => 'string',
            'species' => 'string |in:Dog,Cat,Bird,Fish,Rabbit,Hamster,Turtle,Lizard,Other',
            'breed' => 'string',
            'gender' => 'in:Male,Female',
            'sterilized' => 'numeric|in:0,1',
            'min_weight' => 'numeric',
            'max_weight' => 'numeric',
            'birth_date_from' => 'date',
            'birth_date_to' => 'date',
        ];
    }
}

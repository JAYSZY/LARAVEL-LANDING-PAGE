<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFacilityRequest extends FormRequest
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
            'facility_name' => ['required', 'string', 'max:255'],
            'region' => ['required', 'string', 'max:255'],
            'contact_name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'contact_number' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['nullable', 'string', 'max:2000'],
            'status' => ['required', 'in:pending,contacted,approved,declined'],
            'admin_notes' => ['nullable', 'string', 'max:2000'],
        ];
    }
}

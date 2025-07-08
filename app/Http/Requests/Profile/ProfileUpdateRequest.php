<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->user()->id;

        return [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'username' => ['required', 'alpha_dash', 'max:50', Rule::unique('users')->ignore($userId)],
            'email' => ['required', 'email', 'max:100', Rule::unique('users')->ignore($userId)],

            // ✅ Este campo es solo validado si está presente en el formulario
            'consent_data_processing' => ['sometimes', 'boolean'],
        ];
    }
}

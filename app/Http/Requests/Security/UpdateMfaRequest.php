<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMfaRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'mfa_enabled' => ['required', 'boolean'],
            'mfa_secret' => ['required_if:mfa_enabled,true'],
            'phone_for_otp' => ['nullable', 'string', 'max:20'],
        ];
    }
}

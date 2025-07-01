<?php
// File: app/Http/Requests/Security/VerifyMFARequest.php
namespace App\Http\Requests\Security;

use Illuminate\Foundation\Http\FormRequest;

class VerifyMFARequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return ['otp_code' => ['required', 'digits:6']];
    }
}

<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Security\MFAService;
use App\Models\AccessControl\UserSecurity;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Security\EnableMFARequest;
use App\Http\Requests\Security\VerifyMFARequest;

class MFAController extends Controller
{
    protected MFAService $mfa;

    public function __construct(MFAService $mfa)
    {
        $this->mfa = $mfa;
    }

    public function enable(EnableMFARequest $request)
    {
        $user = Auth::user();
        $record = UserSecurity::firstOrNew(['user_id' => $user->id]);

        $secret = $this->mfa->generateSecret();
        $record->mfa_secret = $this->mfa->encryptSecret($secret);
        $record->mfa_enabled = true;
        $record->mfa_enabled_at = now();
        $record->save();

        return response()->json([
            'message' => 'MFA activado.',
            'otp_url' => "otpauth://totp/SGPTI:{$user->email}?secret={$secret}&issuer=SGPTI"
        ]);
    }

    public function verify(VerifyMFARequest $request)
    {
        $user = Auth::user();
        $record = UserSecurity::where('user_id', $user->id)->firstOrFail();
        $secret = $this->mfa->decryptSecret($record->mfa_secret);

        if (!$this->mfa->verifyCode($secret, $request->otp_code)) {
            return response()->json(['message' => 'Código inválido.'], 401);
        }

        $record->mfa_last_verified_at = now();
        $record->mfa_last_ip = $request->ip();
        $record->save();

        return response()->json(['message' => 'MFA verificado correctamente.']);
    }
}

<?php

namespace App\Services\Security;

use Illuminate\Support\Facades\Crypt;
use OTPHP\TOTP;
use App\Models\Security\UserSecurity;

class MFAService
{
    public function generateSecret(): string
    {
        return TOTP::create()->getSecret();
    }

    public function encryptSecret(string $secret): string
    {
        return Crypt::encryptString($secret);
    }

    public function decryptSecret(string $encrypted): string
    {
        return Crypt::decryptString($encrypted);
    }

    public function verifyCode(string $secret, string $code): bool
    {
        return TOTP::create($secret)->verify($code);
    }
}


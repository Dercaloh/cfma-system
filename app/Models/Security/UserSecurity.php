<?php

namespace App\Models\Security;

use Illuminate\Database\Eloquent\Model;

class UserSecurity extends Model
{
    protected $table = 'user_security';
    protected $fillable = [
        'user_id', 'mfa_secret', 'mfa_enabled', 'mfa_enabled_at',
        'mfa_last_ip', 'mfa_last_verified_at', 'created_by', 'updated_by'
    ];

    protected $casts = [
        'mfa_enabled' => 'boolean',
        'mfa_enabled_at' => 'datetime',
        'mfa_last_verified_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}

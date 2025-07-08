<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Model, Factories\HasFactory
};

class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'action', 'module', 'details', 'ip_address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

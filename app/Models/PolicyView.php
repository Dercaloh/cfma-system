<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PolicyView extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'user_agent',
        'user_id',
        'policy_version',
        'viewed_at',
    ];

    protected $casts = [
        'viewed_at' => 'datetime',
    ];

    public $timestamps = false; // <- Esto evita que intente usar created_at y updated_at

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

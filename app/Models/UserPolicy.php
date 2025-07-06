<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserPolicy extends Model
{
    use HasFactory;

    protected $table = 'user_policies';

    protected $fillable = [
        'user_id',
        'policy_name',
        'policy_version',
        'accepted_at',
        'accepted_ip',
        'accepted_user_agent',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'accepted_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

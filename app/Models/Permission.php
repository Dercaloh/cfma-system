<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'created_by'];

    // Relaciones
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Model, SoftDeletes, Factories\HasFactory
};

class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

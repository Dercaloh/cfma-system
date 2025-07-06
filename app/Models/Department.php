<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes, \App\Traits\NormalizesTextFields;

    protected $fillable = [
        'name',
        'active',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
    protected static $normalizeTextFields = ['name'];
    // Relaciones para trazabilidad
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
    // Department.php
    public function getNameAttribute($value)
    {
        return ucwords(strtolower($value)); // "Coordinación Académica"
    }
}

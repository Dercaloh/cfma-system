<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'location_code', 'location_id', 'active',
        'created_by', 'updated_by', 'deleted_by',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssetType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'description',
        'created_by', 'updated_by', 'deleted_by',
    ];

    public function assets()
    {
        return $this->hasMany(Asset::class, 'type_id');
    }
}

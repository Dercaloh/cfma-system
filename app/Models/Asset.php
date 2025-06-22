<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Model, SoftDeletes, Factories\HasFactory
};

class Asset extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'serial_number', 'type', 'brand', 'model',
        'status', 'description'
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Model, SoftDeletes, Factories\HasFactory
};

class Asset extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'serial_number', 'placa', 'type', 'brand', 'model',
        'status', 'condition', 'location',
        'ownership', 'assigned_to', 'loanable', 'movable',
        'description',
    ];

    public function cuentadante()
    {
    return $this->belongsTo(User::class, 'assigned_to');
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }
}


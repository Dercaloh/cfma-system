<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Loan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'asset_id',
        'status_id',
        'requested_at',
        'approved_at',
        'delivered_at',
        'returned_at',
        'notes',
    ];

    protected $casts = [
        'requested_at' => 'datetime',
        'approved_at'  => 'datetime',
        'delivered_at' => 'datetime',
        'returned_at'  => 'datetime',
    ];

    // Relaciones con soporte a datos eliminados (soft deletes)
    public function user()
{
    return $this->belongsTo(User::class)->withTrashed()->withDefault([
        'name' => 'Desconocido',
        'email' => '—'
    ]);
}


    public function asset()
{
    return $this->belongsTo(Asset::class)->withTrashed()->withDefault([
        'name' => 'Activo eliminado',
    ]);
}

    public function status()
    {
        return $this->belongsTo(LoanStatus::class)->withDefault([
            'name' => 'Desconocido'
        ]);
    }

    public function details()
    {
        return $this->hasOne(LoanDetail::class);
    }

    public function signatures()
    {
        return $this->hasMany(Signature::class);
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modelo Loan: representa un préstamo de activo.
 *
 * Relaciones:
 * - user(): Usuario solicitante.
 * - asset(): Activo prestado.
 * - status(): Estado actual del préstamo.
 * - details(): Detalles adicionales (uso administrativo o formativo).
 * - signatures(): Firmas registradas en el ciclo de préstamo.
 * - documents(): Documentos adjuntos al préstamo.
 */
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

    // Relaciones Eloquent
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function status()
    {
        return $this->belongsTo(LoanStatus::class);
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

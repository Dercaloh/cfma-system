<?php

namespace App\Models\Loans;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modelo LoanDetail
 *
 * 📚 Clasificación Institucional:
 * - 🟡 Clasificada: Todos los campos (uso interno, entrega, ficha, modalidad, propósito)
 */
class LoanDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'cantidad',
        'dias_solicitados',
        'modalidad_entrega',
        'hora_entrega',
        'tipo_de_uso',         // 🟡
        'ficha',               // 🟡
        'programa',            // 🟡
        'instructor',          // 🟡
        'cargo',               // 🟡
        'departamento',        // 🟡
        'proposito',           // 🟡
        'sede',                // 🟡
    ];

    protected $casts = [
        'cantidad' => 'integer',
        'dias_solicitados' => 'integer',
        'hora_entrega' => 'datetime:H:i',
    ];

    /**
     * Relación con el préstamo principal
     */
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}

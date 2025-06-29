<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoanDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_de_uso',
        'ficha', 'programa', 'instructor',
        'cargo', 'departamento','proposito',
        'sede', 'hora_entrega', 'cantidad',
    ];

    // Relación inversa con Loan
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}

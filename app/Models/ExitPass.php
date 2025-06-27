<?php
// ExitPass Model
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExitPass extends Model
{
    use HasFactory;

    protected $fillable = [
        'gate_log_id',
        'cuentadante',
        'cedula',
        'dependencia',
        'permiso',
        'autorizado_salida',
        'autorizado_regreso',
        'firmado_por',
        'archivo_pdf',
    ];

    public function gateLog()
    {
        return $this->belongsTo(GateLog::class);
    }
}

<?php
// File: app/Models/LoanRequestData.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoanRequestData extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id', 'tipo_de_uso', 'program_id', 'instructor_id',
        'proposito', 'department_id', 'position_id', 'branch_id',
        'fecha_entrega_deseada', 'reclamado_por_apoderado',
        'nombre_apoderado', 'documento_apoderado', 'proxy_type_id'
    ];

    public function loan() {
        return $this->belongsTo(Loan::class);
    }

    public function instructor() {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function program() {
        return $this->belongsTo(Program::class);
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function position() {
        return $this->belongsTo(Position::class);
    }

    public function branch() {
        return $this->belongsTo(Branch::class);
    }

    public function proxyType() {
        return $this->belongsTo(ProxyType::class);
    }
}

<?php

namespace App\Models\Loans;

use App\Models\{
    Loans\Loan,
    Programs\Program,
    Programs\Position,
    Programs\ProxyType,
    Locations\Branch,
    Locations\Department,
    Users\User
};
use App\Traits\CryptoHelperTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class LoanRequestData extends Model
{
    use HasFactory, SoftDeletes, LogsActivity, CryptoHelperTrait;

    protected $table = 'loan_request_data';

    protected $fillable = [
        'loan_id',                 // 🔴 FK
        'tipo_de_uso',            // 🟡
        'program_id',             // 🟢 FK
        'instructor_id',          // 🟢 FK
        'proposito',              // 🟡
        'department_id',          // 🟢 FK
        'position_id',            // 🟢 FK
        'branch_id',              // 🟢 FK
        'fecha_entrega_deseada',  // 🟡
        'reclamado_por_apoderado',// 🟡
        'nombre_apoderado',       // 🔴 (cifrado)
        'documento_apoderado',    // 🔴 (cifrado)
        'proxy_type_id',          // 🟢 FK
        'created_by',             // 🔴 FK
        'updated_by',             // 🔴 FK
    ];

    protected static $logFillable = true;
    protected static $logName = 'loan_request_data';
    protected static $logOnlyDirty = true;

    protected $casts = [
        'fecha_entrega_deseada' => 'date',
        'reclamado_por_apoderado' => 'boolean',
    ];

    protected $encrypted = [
        'nombre_apoderado',
        'documento_apoderado',
    ];

    // Relaciones principales
    public function loan() {
        return $this->belongsTo(Loan::class);
    }

    public function instructor() {
        return $this->belongsTo(User::class, 'instructor_id')->withDefault(['name' => '—']);
    }

    public function program() {
        return $this->belongsTo(Program::class)->withDefault(['name' => '—']);
    }

    public function department() {
        return $this->belongsTo(Department::class)->withDefault(['name' => '—']);
    }

    public function position() {
        return $this->belongsTo(Position::class)->withDefault(['title' => '—']);
    }

    public function branch() {
        return $this->belongsTo(Branch::class)->withDefault(['name' => '—']);
    }

    public function proxyType() {
        return $this->belongsTo(ProxyType::class)->withDefault(['name' => '—']);
    }

    // Trazabilidad (auditoría interna)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by')->withTrashed();
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by')->withTrashed();
    }

    // Mutadores automáticos para cifrado
    public function getNombreApoderadoAttribute($value)
    {
        return $this->decryptField($value);
    }

    public function setNombreApoderadoAttribute($value)
    {
        $this->attributes['nombre_apoderado'] = $this->encryptField($value);
    }

    public function getDocumentoApoderadoAttribute($value)
    {
        return $this->decryptField($value);
    }

    public function setDocumentoApoderadoAttribute($value)
    {
        $this->attributes['documento_apoderado'] = $this->encryptField($value);
    }
}

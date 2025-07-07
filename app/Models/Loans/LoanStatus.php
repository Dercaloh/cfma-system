<?php

namespace App\Models\Loans;

use App\Models\Users\User;
use App\Models\Loans\Loan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;

class LoanStatus extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $table = 'loan_statuses';

    protected $fillable = [
        'name',           // 🟢 Pública
        'description',    // 🟢 Pública
        'order_index',    // 🟢 Pública
        'created_by',     // 🔴 Reservada
        'updated_by',     // 🔴 Reservada
        'deleted_by'      // 🔴 Reservada
    ];

    protected static $logFillable = true;
    protected static $logName = 'loan_status';
    protected static $logOnlyDirty = true;

    protected $casts = [
        'order_index' => 'integer',
    ];

    // Relaciones de auditoría institucional
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by')->withTrashed();
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by')->withTrashed();
    }

    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by')->withTrashed();
    }

    // Relación con préstamos
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}

<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanApproval extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'loan_id',
        'decided_by',
        'status',
        'justification',
        'approved_at',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    // Relaciones
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'decided_by');
    }
}

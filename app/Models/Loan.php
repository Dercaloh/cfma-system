<?php
//  * Loan Model
namespace App\Models;

use Illuminate\Database\Eloquent\{
    Model, SoftDeletes, Factories\HasFactory
};

class Loan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'asset_id', 'status_id',
        'requested_at', 'approved_at',
        'delivered_at', 'returned_at', 'notes'
    ];

    public function user()   { return $this->belongsTo(User::class); }
    public function asset()  { return $this->belongsTo(Asset::class); }
    public function status() { return $this->belongsTo(LoanStatus::class); }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }
}



<?php
 /* Asset Model
 *
 * This model represents an asset in the inventory system.
 * It includes properties such as serial number, type, brand, model,
 * status, condition, location, ownership, and more.
 *
 * @package App\Models
 */
namespace App\Models;

use Illuminate\Database\Eloquent\{
    Model, SoftDeletes, Factories\HasFactory
};

class Asset extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name','serial_number', 'placa', 'type', 'brand', 'model',
        'status', 'condition', 'location',
        'ownership', 'assigned_to', 'loanable', 'movable',
        'description',
    ];

    public function cuentadante()
    {
    return $this->belongsTo(User::class, 'assigned_to');
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }
    public function gateLogs()
    {
        return $this->hasMany(GateLog::class);
    }

    public function exitPasses()
    {
        return $this->hasManyThrough(ExitPass::class, GateLog::class);
    }
    protected $casts = [
        'loanable' => 'boolean',
        'movable'  => 'boolean',
    ];

    public function asset()
{
    return $this->belongsTo(Asset::class)->withTrashed();
}

}


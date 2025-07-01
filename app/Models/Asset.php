<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asset extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'serial_number', 'placa',
        'type_id', 'ownership', 'brand', 'model', 'year_purchased',
        'status', 'condition', 'location_id',
        'loanable', 'movable', 'assigned_to',
        'description', 'created_by', 'updated_by', 'deleted_by',
    ];

    protected $casts = [
        'loanable' => 'boolean',
        'movable' => 'boolean',
        'year_purchased' => 'integer',
    ];

    // === Relaciones ===

    public function type()
    {
        return $this->belongsTo(AssetType::class, 'type_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function cuentadante()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function hardwareDetails()
    {
        return $this->hasOne(AssetHardwareDetail::class);
    }

    public function softwareDetails()
    {
        return $this->hasMany(AssetSoftwareDetail::class);
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
}

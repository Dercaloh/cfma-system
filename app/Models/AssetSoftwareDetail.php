<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssetSoftwareDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_id', 'name', 'version', 'vendor',
        'license_status', 'install_date',
        'created_by', 'updated_by',
    ];

    protected $casts = [
        'install_date' => 'date',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class)->withTrashed();
    }
}

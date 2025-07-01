<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssetHardwareDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_id', 'mac_address', 'os', 'bios_version',
        'cpu', 'ram', 'storage',
        'created_by', 'updated_by',
    ];

    protected $casts = [
        'mac_address' => 'string',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class)->withTrashed();
    }
}

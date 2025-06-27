<?php
// app/Models/GateLog.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GateLog extends Model
{

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function user()
    {
    return $this->belongsTo(User::class);
    }

    public function exitPass()
    {
    return $this->hasOne(ExitPass::class);
    }

    public function gateLog()
    {
    return $this->belongsTo(GateLog::class);
    }


}

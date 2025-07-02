<?php
// app/Models/Position.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'active', 'created_by', 'updated_by', 'deleted_by'];

    // Relaciones con usuarios auditores
    public function creator() { return $this->belongsTo(User::class, 'created_by'); }
    public function updater() { return $this->belongsTo(User::class, 'updated_by'); }
    public function deleter() { return $this->belongsTo(User::class, 'deleted_by'); }
}

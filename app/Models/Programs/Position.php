<?php
// app/Models/Position.php
namespace App\Models\Programs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Position extends Model
{
    use SoftDeletes, HasFactory, \App\Traits\NormalizesTextFields;

    protected $fillable = ['title', 'active', 'created_by', 'updated_by', 'deleted_by'];
    protected static $normalizeTextFields = ['name'];
    // Relaciones con usuarios auditores


    // Position.php
    public function getTitleAttribute($value)
    {
        return ucwords(strtolower($value)); // "Apoyo De Biblioteca"
    }
}

<?php

namespace App\Models\Programs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use SoftDeletes, \App\Traits\NormalizesTextFields;

    protected $fillable = ['name', 'code', 'created_by', 'updated_by', 'deleted_by'];
    protected static $normalizeTextFields = ['name'];
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}

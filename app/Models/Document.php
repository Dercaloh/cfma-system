<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Model, Factories\HasFactory
};

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename', 'path', 'type', 'description'
    ];

    public function documentable()
    {
        return $this->morphTo();
    }
}


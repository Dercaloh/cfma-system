<?php
//  * LoanStatus Model
namespace App\Models;

use Illuminate\Database\Eloquent\{
    Model, Factories\HasFactory
};

class LoanStatus extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}

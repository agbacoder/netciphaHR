<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeWork extends Model
{
    use HasFactory;

    protected $casts =
    [
        'body'  => 'array'
    ];

    public function employee()
    {
        return $this->belongsTo(Employees::class, 'user_id');
    }
}

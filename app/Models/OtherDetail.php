<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherDetail extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'department', 'manager'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['employeeName', 'role', 'startDate', 'endDate', 'salary', 'terms'];


    protected $casts = [
        'startDate' => 'date',
        'endDate' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($employee) {
            $employee->employee_agreen_number = Str::random(20);
        });
    }

    public function otherDetails()
    {
        return $this->hasMany(OtherDetail::class);
    }
}

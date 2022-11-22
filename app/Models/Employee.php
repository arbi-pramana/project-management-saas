<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public function department()
    {
        return $this->hasOne(Department::class,'id','department_id');
    }

    public function employee_type()
    {
        return $this->hasOne(EmployeeType::class,'id','employee_type_id');
    }
}

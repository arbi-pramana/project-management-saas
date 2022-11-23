<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function milestone()
    {
        return $this->hasOne(Milestone::class,'id','milestone_id');
    }

    public function employee()
    {
        return $this->hasOne(Employee::class,'id','employee_id');
    }

    public function complexity()
    {
        return $this->hasOne(Complexity::class,'id','complexity_id');
    }

    public function priority()
    {
        return $this->hasOne(Priority::class,'id','priority_id');
    }

    public function status()
    {
        return $this->hasOne(Status::class,'id','status_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
protected $fillable = ['employee_id', 'total_leave', 'leave_start','leave_end','remaining_leave','year','type'];

public function Employees(){
    return $this->belongsTo(Employee::class);
}
}

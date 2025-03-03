<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable=['national_id','name','department','grade'];

    public function Holidays(){
        return $this->hasMany(Holiday::class);
    }
}

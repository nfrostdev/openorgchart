<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name', 'employee_id'];

    public function employees()
    {
        return $this->hasMany('App\Employee');
    }

    public function leader()
    {
        return $this->hasOne('App\Employee', 'id', 'employee_id');
    }
}

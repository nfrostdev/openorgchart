<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['first_name', 'last_name', 'title', 'supervisor_id'];

    public function supervisor()
    {
        return $this->hasOne('App\Employee', 'id', 'supervisor_id');
    }

    public function team()
    {
        return $this->hasMany('App\Employee', 'supervisor_id', 'id');
    }
}

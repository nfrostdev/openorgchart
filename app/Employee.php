<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['team_id', 'supervisor_id', 'first_name', 'last_name', 'title', 'rank'];

    public function team()
    {
        return $this->belongsTo('App\Team');
    }

    public function supervisor()
    {
        return $this->hasOne('App\Employee', 'id', 'supervisor_id');
    }

    public function employees()
    {
        return $this->hasMany('App\Employee', 'supervisor_id', 'id');
    }
}

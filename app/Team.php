<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['department_id', 'name'];

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function employees()
    {
        return $this->hasMany('App\Employee');
    }

    public function leader()
    {
        return $this->hasOne('App\Employee', 'id', 'leader_id');
    }
}

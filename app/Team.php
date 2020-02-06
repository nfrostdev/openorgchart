<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['department_id', 'name', 'leader_id'];

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function employees()
    {
        return $this->hasMany('App\Employee')->where('id', '!=', $this->leader_id);
    }

    public function leader()
    {
        return $this->hasOne('App\Employee', 'id', 'leader_id');
    }
}

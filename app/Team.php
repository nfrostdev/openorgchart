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
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['team_id', 'first_name', 'last_name', 'title', 'rank'];

    public function team()
    {
        return $this->belongsTo('App\Team');
    }
}

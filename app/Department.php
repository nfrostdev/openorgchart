<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name', 'employee_id'];

    public function leader()
    {
        return $this->hasOne('App\Employee', 'id', 'employee_id');
    }

    public static function recursiveEmployeeCheck($supervisor)
    {
        if ($supervisor) {
            // TODO: This is pretty sloppy. There should to be a better way.
            return $supervisor->team->map(function ($employee) {
                return self::recursiveEmployeeCheck($employee);
            })->push($supervisor)->flatten()->unique();
        } else {
            return $supervisor;
        }
    }

    // https://laravel.com/docs/master/eloquent-mutators#defining-an-accessor
    public function getEmployeesAttribute()
    {
        return self::recursiveEmployeeCheck($this->leader);
    }
}

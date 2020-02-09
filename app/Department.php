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

    private function recursiveEmployeeCount($supervisor)
    {
        $employees = $supervisor->team;
        if ($employees) {
            // Check for nested teams.
            foreach ($supervisor->team as $employee) {
                $employees->push($this->recursiveEmployeeCount($employee));
            }
        }
        $employees->push($supervisor);
        // TODO: This is pretty sloppy. There has to be a better way.
        return $employees->flatten()->unique();
    }

    // https://laravel.com/docs/master/eloquent-mutators#defining-an-accessor
    public function getEmployeesAttribute()
    {
        return $this->recursiveEmployeeCount($this->leader);
    }
}

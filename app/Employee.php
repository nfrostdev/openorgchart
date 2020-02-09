<?php

namespace App;

use App\Department;
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

    // Checking recursively for supervisor assignments.
    public function getRecursiveSupervisor($employee)
    {
        // If this employee has a supervisor, see if the supervisor has one too. Otherwise this should be the highest level of supervision.
        return $employee->supervisor ? $this->getRecursiveSupervisor($employee->supervisor) : $employee;
    }

    // https://laravel.com/docs/master/eloquent-mutators#defining-an-accessor
    public function getDepartmentAttribute()
    {
        // Get the highest level of supervision.
        $employee = $this->getRecursiveSupervisor($this);
        // Return the correlating department.
        return Department::where('employee_id', $employee->id)->first();
    }
}

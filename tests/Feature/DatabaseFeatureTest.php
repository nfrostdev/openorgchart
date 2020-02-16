<?php

namespace Tests\Feature;

use App\User;
use App\Role;
use App\Department;
use App\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DatabaseFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function testUserRolesFeatures()
    {
        // Assert that the Default Administrator account has been created.
        $this->assertDatabaseHas('users', [
            'first_name' => 'Default',
            'last_name' => 'Administrator',
            'role_id' => Role::where('name', 'Administrator')->first()->id
        ]);

        // Create a new user with a new role.
        $user = factory(User::class)->create();
        $role = factory(Role::class)->create();

        $user_role = ['role_id' => $role->id];
        $user->update($user_role);
        $this->assertDatabaseHas('users', $user_role);

        $null_role = ['role_id' => null];
        $user->update($null_role);
        $this->assertDatabaseHas('users', $null_role);
    }

    public function testDepartmentLeaderFeature()
    {
        $employee = factory(Employee::class)->create();
        $department = factory(Department::class)->create();

        $department_leader = ['employee_id' => $employee->id];
        $department->update($department_leader);
        $this->assertDatabaseHas('departments', $department_leader);

        $null_leader = ['employee_id' => null];
        $department->update($null_leader);
        $this->assertDatabaseHas('departments', $null_leader);
    }
}

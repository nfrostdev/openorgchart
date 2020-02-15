<?php

namespace Tests\Feature;

use App\Department;
use App\Employee;
use App\Role;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DatabaseUnitTest extends TestCase
{
    use RefreshDatabase;

    private function unitTest(string $class, string $table, array $create, array $update)
    {
        $model = factory($class)->create($create);
        $this->assertDatabaseHas($table, $create);

        $model->update($update);
        $this->assertDatabaseHas($table, $update);

        $model->delete();
        $this->assertDatabaseMissing($table, $update);
    }

    public function testUserUnit()
    {
        $this->unitTest(
            User::class,
            'users',
            ['first_name' => 'DatabaseTest'],
            ['first_name' => 'DatabaseTestUpdated']
        );
    }

    public function testRoleUnit()
    {
        $this->unitTest(
            Role::class,
            'roles',
            ['name' => 'DatabaseTest'],
            ['name' => 'DatabaseTestUpdated']
        );
    }

    public function testDepartmentUnit()
    {
        $this->unitTest(
            Department::class,
            'departments',
            ['name' => 'DatabaseTest'],
            ['name' => 'DatabaseTestUpdated']
        );
    }

    public function testEmployeeUnit()
    {
        $this->unitTest(
            Employee::class,
            'employees',
            ['first_name' => 'DatabaseTest'],
            ['first_name' => 'DatabaseTestUpdated']
        );
    }
}

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

    private function databaseUnitTest(string $class, string $table, array $create, array $update)
    {
        $model = factory($class)->create($create);
        $this->assertDatabaseHas($table, $create);

        $model->update($update);
        $this->assertDatabaseHas($table, $update);

        $model->delete();
        $this->assertDeleted($model);
        $this->assertDatabaseMissing($table, $update);
    }

    public function testUserUnit()
    {
        $this->databaseUnitTest(
            User::class,
            'users',
            ['first_name' => 'DatabaseTest'],
            ['first_name' => 'DatabaseTestUpdated']
        );
    }

    public function testRoleUnit()
    {
        $this->databaseUnitTest(
            Role::class,
            'roles',
            ['name' => 'DatabaseTest'],
            ['name' => 'DatabaseTestUpdated']
        );
    }

    public function testDepartmentUnit()
    {
        $this->databaseUnitTest(
            Department::class,
            'departments',
            ['name' => 'DatabaseTest'],
            ['name' => 'DatabaseTestUpdated']
        );
    }

    public function testEmployeeUnit()
    {
        $this->databaseUnitTest(
            Employee::class,
            'employees',
            ['first_name' => 'DatabaseTest'],
            ['first_name' => 'DatabaseTestUpdated']
        );
    }
}

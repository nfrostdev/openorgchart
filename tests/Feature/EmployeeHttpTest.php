<?php

namespace Tests\Feature;

use App\Employee;
use App\Role;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeHttpTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $editor;
    private $administrator;
    private $employee;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create(['role_id' => null]);
        $this->editor = factory(User::class)->create(['role_id' => Role::where('name', 'Editor')->first()->id]);
        $this->administrator = factory(User::class)->create(['role_id' => Role::where('name', 'Administrator')->first()->id]);
        $this->employee = factory(Employee::class)->create();
    }

    function testIndex()
    {
        $route = route('employees.index');
        $this->get($route)->assertRedirect();
        $this->actingAs($this->user)->get($route)->assertForbidden();
        $this->actingAs($this->editor)->get($route)->assertSuccessful();
        $this->actingAs($this->administrator)->get($route)->assertSuccessful();
    }

    function testCreate()
    {
        $route = route('employees.create');
        $this->get($route)->assertRedirect();
        $this->actingAs($this->user)->get($route)->assertForbidden();
        $this->actingAs($this->editor)->get($route)->assertSuccessful();
        $this->actingAs($this->administrator)->get($route)->assertSuccessful();
    }

    function testStore()
    {
        $route = route('employees.store');
        $post_data = [
            'first_name' => 'testStore',
            'last_name' => 'testStore',
            'title' => 'testStore',
            'supervisor_id' => Employee::all()->random()->id
        ];
        $this->post($route, $post_data)->assertRedirect();
        $this->actingAs($this->user)->post($route, $post_data)->assertForbidden();
        $this->actingAs($this->editor)->post($route, $post_data)->assertRedirect();
        $this->actingAs($this->administrator)->post($route, $post_data)->assertRedirect();
    }

    function testEdit()
    {
        $route = route('employees.edit', ['employee' => $this->employee->id]);
        $this->get($route)->assertRedirect();
        $this->actingAs($this->user)->get($route)->assertForbidden();
        $this->actingAs($this->editor)->get($route)->assertSuccessful();
        $this->actingAs($this->administrator)->get($route)->assertSuccessful();
    }

    function testUpdate()
    {
        $route = route('employees.update', ['employee' => $this->employee->id]);

        $patch_data = [
            'first_name' => 'testUpdate',
            'last_name' => 'testUpdate',
            'title' => 'testUpdate',
            'supervisor_id' => Employee::all()->random()->id
        ];

        $this->patch($route, $patch_data)->assertRedirect();
        $this->actingAs($this->user)->patch($route, $patch_data)->assertForbidden();
        $this->actingAs($this->editor)->patch($route, $patch_data)->assertRedirect();
        $this->actingAs($this->administrator)->patch($route, $patch_data)->assertRedirect();

        // TODO: This should probably be more complex. The route controller has unannounced restrictions?
        $bad_patch_data = [
            'first_name' => '',
            'last_name' => '',
            'title' => '',
            'supervisor_id' => 99999999999999
        ];

        $this->patch($route, $bad_patch_data)->assertRedirect();
        $this->actingAs($this->user)->patch($route, $bad_patch_data)->assertForbidden();
        $this->actingAs($this->editor)->patch($route, $bad_patch_data)->assertRedirect();
        $this->actingAs($this->administrator)->patch($route, $bad_patch_data)->assertRedirect();
    }

    public function testDestroy()
    {
        $route = route('employees.destroy', ['employee' => $this->employee->id]);
        $this->delete($route)->assertRedirect();
        $this->actingAs($this->user)->delete($route)->assertForbidden();
        $this->actingAs($this->editor)->delete($route)->assertRedirect();

        $scoped_employee = factory(Employee::class)->create();
        $scoped_employee_route = route('employees.destroy', ['employee' => $scoped_employee->id]);
        $this->actingAs($this->administrator)->delete($scoped_employee_route)->assertRedirect();
    }
}

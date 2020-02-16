<?php

namespace Tests\Feature;

use App\Department;
use App\Employee;
use App\Role;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DepartmentHttpTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $editor;
    private $administrator;
    private $department;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create(['role_id' => null]);
        $this->editor = factory(User::class)->create(['role_id' => Role::where('name', 'Editor')->first()->id]);
        $this->administrator = factory(User::class)->create(['role_id' => Role::where('name', 'Administrator')->first()->id]);
        $this->department = factory(Department::class)->create();
        // Seed some employees for random selection.
        factory(Employee::class, 5)->create();
    }

    function testIndex()
    {
        $route = route('departments.index');
        $this->get($route)->assertRedirect();
        $this->actingAs($this->user)->get($route)->assertForbidden();
        $this->actingAs($this->editor)->get($route)->assertSuccessful();
        $this->actingAs($this->administrator)->get($route)->assertSuccessful();
    }

    function testCreate()
    {
        $route = route('departments.create');
        $this->get($route)->assertRedirect();
        $this->actingAs($this->user)->get($route)->assertForbidden();
        $this->actingAs($this->editor)->get($route)->assertSuccessful();
        $this->actingAs($this->administrator)->get($route)->assertSuccessful();
    }

    function testStore()
    {
        $route = route('departments.store');
        $post_data = [
            'name' => 'testStore',
            'employee_id' => Employee::all()->random()->id
        ];
        $this->post($route, $post_data)->assertRedirect();
        $this->actingAs($this->user)->post($route, $post_data)->assertForbidden();
        $this->actingAs($this->editor)->post($route, $post_data)->assertRedirect();
        $this->actingAs($this->administrator)->post($route, $post_data)->assertRedirect();
    }

    function testEdit()
    {
        $route = route('departments.edit', ['department' => $this->department]);
        $this->get($route)->assertRedirect();
        $this->actingAs($this->user)->get($route)->assertForbidden();
        $this->actingAs($this->editor)->get($route)->assertSuccessful();
        $this->actingAs($this->administrator)->get($route)->assertSuccessful();
    }

    function testUpdate()
    {
        $route = route('departments.update', ['department' => $this->department]);

        $patch_data = [
            'name' => 'testUpdate',
            'employee_id' => Employee::all()->random()->id
        ];

        $this->patch($route, $patch_data)->assertRedirect();
        $this->actingAs($this->user)->patch($route, $patch_data)->assertForbidden();
        $this->actingAs($this->editor)->patch($route, $patch_data)->assertRedirect();
        $this->actingAs($this->administrator)->patch($route, $patch_data)->assertRedirect();

        // TODO: This should probably be more complex. The route controller has unannounced restrictions?
        $bad_patch_data = [
            'name' => '',
            'employee_id' => 9999999999999
        ];

        $this->patch($route, $bad_patch_data)->assertRedirect();
        $this->actingAs($this->user)->patch($route, $bad_patch_data)->assertForbidden();
        $this->actingAs($this->editor)->patch($route, $bad_patch_data)->assertRedirect();
        $this->actingAs($this->administrator)->patch($route, $bad_patch_data)->assertRedirect();
    }

    public function testDestroy()
    {
        $route = route('departments.destroy', ['department' => $this->department]);
        $this->delete($route)->assertRedirect();
        $this->actingAs($this->user)->delete($route)->assertForbidden();
        $this->actingAs($this->editor)->delete($route)->assertRedirect();

        $scoped_department = factory(Department::class)->create();
        $scoped_department_route = route('departments.destroy', ['department' => $scoped_department]);
        $this->actingAs($this->administrator)->delete($scoped_department_route)->assertRedirect();
    }
}

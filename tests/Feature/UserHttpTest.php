<?php

namespace Tests\Feature;

use App\Role;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserHttpTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $editor;
    private $administrator;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create(['role_id' => null]);
        $this->editor = factory(User::class)->create(['role_id' => Role::where('name', 'Editor')->first()->id]);
        $this->administrator = factory(User::class)->create(['role_id' => Role::where('name', 'Administrator')->first()->id]);
    }

    function testIndex()
    {
        $route = route('users.index');
        $this->get($route)->assertRedirect();
        $this->actingAs($this->user)->get($route)->assertForbidden();
        $this->actingAs($this->editor)->get($route)->assertForbidden();
        $this->actingAs($this->administrator)->get($route)->assertSuccessful();
    }

    function testCreate()
    {
        $route = route('users.create');
        $this->get($route)->assertRedirect();
        $this->actingAs($this->user)->get($route)->assertForbidden();
        $this->actingAs($this->editor)->get($route)->assertForbidden();
        $this->actingAs($this->administrator)->get($route)->assertSuccessful();
    }

    function testStore()
    {
        $route = route('users.store');
        $post_data = [
            'first_name' => 'testStore',
            'last_name' => 'testStore',
            'email' => 'testStore@openorgchart.com',
            'password' => 'testStore'
        ];
        $this->post($route, $post_data)->assertRedirect();
        $this->actingAs($this->user)->post($route, $post_data)->assertForbidden();
        $this->actingAs($this->editor)->post($route, $post_data)->assertForbidden();
        $this->actingAs($this->administrator)->post($route, $post_data)->assertRedirect();

        // TODO: This should probably be more complex. The route controller has unannounced restrictions.
        $role_post_data = $post_data;
        $role_post_data['role_id'] = Role::where('name', 'Administrator')->first()->id;
        $this->post($route, $role_post_data)->assertRedirect();
        $this->actingAs($this->user)->post($route, $role_post_data)->assertForbidden();
        $this->actingAs($this->editor)->post($route, $role_post_data)->assertForbidden();
        $this->actingAs($this->administrator)->post($route, $role_post_data)->assertRedirect();
    }

    function testEdit()
    {
        $administrator_route = route('users.edit', ['user' => $this->administrator->id]);
        $editor_route = route('users.edit', ['user' => $this->editor->id]);
        $user_route = route('users.edit', ['user' => $this->user->id]);

        $this->get($administrator_route)->assertRedirect();
        $this->get($editor_route)->assertRedirect();
        $this->get($user_route)->assertRedirect();

        $this->actingAs($this->user)->get($administrator_route)->assertForbidden();
        $this->actingAs($this->user)->get($editor_route)->assertForbidden();
        $this->actingAs($this->user)->get($user_route)->assertSuccessful();

        $this->actingAs($this->editor)->get($administrator_route)->assertForbidden();
        $this->actingAs($this->editor)->get($editor_route)->assertSuccessful();
        $this->actingAs($this->editor)->get($user_route)->assertForbidden();

        $this->actingAs($this->administrator)->get($administrator_route)->assertSuccessful();
        $this->actingAs($this->administrator)->get($editor_route)->assertSuccessful();
        $this->actingAs($this->administrator)->get($user_route)->assertSuccessful();
    }

    function testUpdate()
    {
        $administrator_route = route('users.update', ['user' => $this->administrator->id]);
        $editor_route = route('users.update', ['user' => $this->editor->id]);
        $user_route = route('users.update', ['user' => $this->user->id]);

        $patch_data = [
            'first_name' => 'testUpdate',
            'last_name' => 'testUpdate',
            'email' => 'testUpdate@openorgchart.com',
            'password' => 'testUpdate'
        ];

        $this->patch($administrator_route, $patch_data)->assertRedirect();
        $this->patch($editor_route, $patch_data)->assertRedirect();
        $this->patch($user_route, $patch_data)->assertRedirect();

        $this->actingAs($this->user)->patch($administrator_route, $patch_data)->assertForbidden();
        $this->actingAs($this->user)->patch($editor_route, $patch_data)->assertForbidden();
        $this->actingAs($this->user)->patch($user_route, $patch_data)->assertRedirect();

        $this->actingAs($this->editor)->patch($administrator_route, $patch_data)->assertForbidden();
        $this->actingAs($this->editor)->patch($editor_route, $patch_data)->assertRedirect();
        $this->actingAs($this->editor)->patch($user_route, $patch_data)->assertForbidden();

        $this->actingAs($this->administrator)->patch($administrator_route, $patch_data)->assertRedirect();
        $this->actingAs($this->administrator)->patch($editor_route, $patch_data)->assertRedirect();
        $this->actingAs($this->administrator)->patch($user_route, $patch_data)->assertRedirect();

        // TODO: This should probably be more complex. The route controller has unannounced restrictions.
        $bad_patch_data = [
            'first_name' => '',
            'last_name' => '',
            'email' => '',
            'password' => '',
            'role_id' => 9001
        ];

        $this->patch($administrator_route, $bad_patch_data)->assertRedirect();
        $this->patch($editor_route, $bad_patch_data)->assertRedirect();
        $this->patch($user_route, $bad_patch_data)->assertRedirect();

        $this->actingAs($this->user)->patch($administrator_route, $bad_patch_data)->assertForbidden();
        $this->actingAs($this->user)->patch($editor_route, $bad_patch_data)->assertForbidden();
        $this->actingAs($this->user)->patch($user_route, $bad_patch_data)->assertRedirect();

        $this->actingAs($this->editor)->patch($administrator_route, $bad_patch_data)->assertForbidden();
        $this->actingAs($this->editor)->patch($editor_route, $bad_patch_data)->assertRedirect();
        $this->actingAs($this->editor)->patch($user_route, $bad_patch_data)->assertForbidden();

        $this->actingAs($this->administrator)->patch($administrator_route, $bad_patch_data)->assertRedirect();
        $this->actingAs($this->administrator)->patch($editor_route, $bad_patch_data)->assertRedirect();
        $this->actingAs($this->administrator)->patch($user_route, $bad_patch_data)->assertRedirect();
    }

    public function testDestroy()
    {
        $administrator_route = route('users.destroy', ['user' => $this->administrator->id]);
        $editor_route = route('users.destroy', ['user' => $this->editor->id]);
        $user_route = route('users.destroy', ['user' => $this->user->id]);

        $this->delete($administrator_route)->assertRedirect();
        $this->delete($editor_route)->assertRedirect();
        $this->delete($user_route)->assertRedirect();

        $this->actingAs($this->user)->delete($administrator_route)->assertForbidden();
        $this->actingAs($this->user)->delete($editor_route)->assertForbidden();
        $this->actingAs($this->user)->delete($user_route)->assertForbidden();

        $this->actingAs($this->editor)->delete($administrator_route)->assertForbidden();
        $this->actingAs($this->editor)->delete($editor_route)->assertForbidden();
        $this->actingAs($this->editor)->delete($user_route)->assertForbidden();

        // TODO: This should probably be more complex. The route controller has unannounced restrictions.
        $this->actingAs($this->administrator)->delete($administrator_route)->assertRedirect();
        $this->actingAs($this->administrator)->delete($editor_route)->assertRedirect();
        $this->actingAs($this->administrator)->delete($user_route)->assertRedirect();
    }
}

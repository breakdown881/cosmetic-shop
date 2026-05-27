<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AdminRoleCrudTest extends TestCase
{
    use DatabaseTransactions;

    private Admin $manager;

    protected function setUp(): void
    {
        parent::setUp();

        Role::whereIn('name', Role::ALLOWED_ROLES)->delete();

        $this->manager = Admin::create([
            'name' => 'Manager',
            'email' => 'manager-' . uniqid() . '@example.test',
            'password' => 'password',
            'role' => Admin::ROLE['Manager'],
            'is_active' => true,
        ]);
    }

    public function test_manager_can_create_update_and_delete_role(): void
    {
        $this->actingAs($this->manager, 'admin')
            ->post(route('admin.role.store'), [
                'name' => Admin::ROLE['Admin'],
            ])
            ->assertRedirect(route('admin.role.index'));

        $role = Role::where('name', Admin::ROLE['Admin'])->firstOrFail();

        $this->actingAs($this->manager, 'admin')
            ->patch(route('admin.role.update', ['role' => $role->id]), [
                'name' => Admin::ROLE['Staff'],
            ])
            ->assertRedirect(route('admin.role.index'));

        $this->assertDatabaseHas('roles', [
            'id' => $role->id,
            'name' => Admin::ROLE['Staff'],
        ]);

        $this->actingAs($this->manager, 'admin')
            ->delete(route('admin.role.destroy', ['role' => $role->id]))
            ->assertRedirect(route('admin.role.index'));

        $this->assertDatabaseMissing('roles', [
            'id' => $role->id,
        ]);
    }

    public function test_role_name_must_be_one_of_supported_roles(): void
    {
        $this->actingAs($this->manager, 'admin')
            ->from(route('admin.role.create'))
            ->post(route('admin.role.store'), [
                'name' => 'SUPPORT',
            ])
            ->assertRedirect(route('admin.role.create'))
            ->assertSessionHasErrors('name');
    }

    public function test_non_manager_admin_cannot_access_role_crud(): void
    {
        $admin = Admin::create([
            'name' => 'Admin',
            'email' => 'admin-' . uniqid() . '@example.test',
            'password' => 'password',
            'role' => Admin::ROLE['Admin'],
            'is_active' => true,
        ]);

        $this->actingAs($admin, 'admin')
            ->get(route('admin.role.index'))
            ->assertForbidden();
    }
}

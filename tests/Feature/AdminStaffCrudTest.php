<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminStaffCrudTest extends TestCase
{
    use DatabaseTransactions;

    private Admin $manager;

    protected function setUp(): void
    {
        parent::setUp();

        $this->manager = Admin::create([
            'name' => 'Manager',
            'email' => 'manager-' . uniqid() . '@example.test',
            'password' => 'password',
            'role' => Admin::ROLE['Manager'],
            'is_active' => true,
        ]);
    }

    public function test_manager_can_create_staff_account_that_can_login_admin_site(): void
    {
        $email = 'staff-' . uniqid() . '@example.test';

        $this->actingAs($this->manager, 'admin')
            ->post(route('admin.staff.store'), [
                'name' => 'Staff User',
                'email' => $email,
                'password' => 'secret123',
                'password_confirmation' => 'secret123',
                'phone_number' => '0900000000',
                'address' => 'Ho Chi Minh',
                'role' => Admin::ROLE['Staff'],
                'is_active' => 1,
            ])
            ->assertRedirect(route('admin.staff.index'));

        $staff = Admin::where('email', $email)->firstOrFail();

        $this->assertSame(Admin::ROLE['Staff'], $staff->role);
        $this->assertTrue(Hash::check('secret123', $staff->password));

        Auth::guard('admin')->logout();

        $this->post(route('admin.login'), [
            'email' => $email,
            'password' => 'secret123',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticatedAs($staff, 'admin');
    }

    public function test_manager_can_update_and_delete_staff_account(): void
    {
        $staff = $this->createStaff();
        $oldPassword = $staff->password;

        $this->actingAs($this->manager, 'admin')
            ->patch(route('admin.staff.update', ['staff' => $staff->id]), [
                'name' => 'Updated Staff',
                'email' => $staff->email,
                'phone_number' => '0911111111',
                'address' => 'Da Nang',
                'role' => Admin::ROLE['Admin'],
                'is_active' => 0,
            ])
            ->assertRedirect(route('admin.staff.index'));

        $staff->refresh();

        $this->assertSame('Updated Staff', $staff->name);
        $this->assertSame(Admin::ROLE['Admin'], $staff->role);
        $this->assertFalse($staff->is_active);
        $this->assertSame($oldPassword, $staff->password);

        $this->actingAs($this->manager, 'admin')
            ->delete(route('admin.staff.destroy', ['staff' => $staff->id]))
            ->assertRedirect(route('admin.staff.index'));

        $this->assertDatabaseMissing('admins', [
            'id' => $staff->id,
        ]);
    }

    public function test_staff_role_must_be_supported_admin_role(): void
    {
        $this->actingAs($this->manager, 'admin')
            ->from(route('admin.staff.create'))
            ->post(route('admin.staff.store'), [
                'name' => 'Invalid Role',
                'email' => 'invalid-' . uniqid() . '@example.test',
                'password' => 'secret123',
                'password_confirmation' => 'secret123',
                'role' => 'SUPPORT',
                'is_active' => 1,
            ])
            ->assertRedirect(route('admin.staff.create'))
            ->assertSessionHasErrors('role');
    }

    public function test_non_manager_admin_cannot_access_staff_crud(): void
    {
        $admin = Admin::create([
            'name' => 'Admin',
            'email' => 'admin-' . uniqid() . '@example.test',
            'password' => 'password',
            'role' => Admin::ROLE['Admin'],
            'is_active' => true,
        ]);

        $this->actingAs($admin, 'admin')
            ->get(route('admin.staff.index'))
            ->assertForbidden();
    }

    private function createStaff(): Admin
    {
        return Admin::create([
            'name' => 'Staff',
            'email' => 'staff-' . uniqid() . '@example.test',
            'password' => 'secret123',
            'phone_number' => '0900000000',
            'address' => 'Ho Chi Minh',
            'role' => Admin::ROLE['Staff'],
            'is_active' => true,
        ]);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminBrandSearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_search_brands_by_name(): void
    {
        config(['scout.driver' => 'database']);

        $admin = Admin::create([
            'name' => 'Admin',
            'email' => 'admin@example.test',
            'password' => 'password',
            'role' => Admin::ROLE['Manager'],
            'is_active' => true,
        ]);

        Brand::create([
            'name' => 'Laneige',
            'status' => 1,
            'created_by' => $admin->id,
        ]);

        Brand::create([
            'name' => 'Innisfree',
            'status' => 1,
            'created_by' => $admin->id,
        ]);

        $this->actingAs($admin, 'admin')
            ->get(route('admin.brand.index', ['name' => 'Laneige']))
            ->assertOk()
            ->assertSee('Laneige')
            ->assertDontSee('Innisfree')
            ->assertSee('value="Laneige"', false);
    }
}

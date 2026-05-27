<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminProductCrudTest extends TestCase
{
    use RefreshDatabase;

    private Admin $admin;
    private Brand $brand;
    private Category $category;

    protected function setUp(): void
    {
        parent::setUp();

        config(['scout.driver' => 'null']);

        $this->admin = Admin::create([
            'name' => 'Admin',
            'email' => 'admin@example.test',
            'password' => 'password',
            'role' => Admin::ROLE['Manager'],
            'is_active' => true,
        ]);

        $this->brand = Brand::create([
            'name' => 'Test brand',
            'status' => 1,
            'created_by' => $this->admin->id,
        ]);

        $this->category = Category::create([
            'parent_id' => 0,
            'name' => 'Test category',
            'status' => 1,
            'created_by' => $this->admin->id,
        ]);
    }

    public function test_admin_can_create_product(): void
    {
        $this->actingAs($this->admin, 'admin')
            ->post(route('admin.product.store'), $this->productPayload([
                'code' => 'SKU-001',
                'name' => 'Cleanser',
            ]))
            ->assertRedirect(route('admin.product.index'));

        $this->assertDatabaseHas('products', [
            'code' => 'SKU-001',
            'name' => 'Cleanser',
            'brand_id' => $this->brand->id,
            'category_id' => $this->category->id,
            'status' => 1,
            'created_by' => $this->admin->id,
        ]);
    }

    public function test_admin_can_update_product(): void
    {
        $product = $this->createProduct(['name' => 'Old cleanser']);

        $this->actingAs($this->admin, 'admin')
            ->patch(route('admin.product.update', ['product' => $product->id]), $this->productPayload([
                'name' => 'Updated cleanser',
                'price' => 190000,
                'status' => 0,
            ]))
            ->assertRedirect(route('admin.product.index'));

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated cleanser',
            'price' => 190000,
            'status' => 0,
        ]);
    }

    public function test_admin_can_delete_product(): void
    {
        $product = $this->createProduct();

        $this->actingAs($this->admin, 'admin')
            ->delete(route('admin.product.destroy', ['product' => $product->id]))
            ->assertRedirect();

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }

    public function test_admin_can_change_product_status(): void
    {
        $product = $this->createProduct(['status' => 0]);

        $this->actingAs($this->admin, 'admin')
            ->postJson(route('admin.product.change_status', ['product' => $product->id]), [
                'status' => 1,
            ])
            ->assertOk()
            ->assertJson([
                'success' => true,
            ]);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'status' => 1,
        ]);
    }

    private function createProduct(array $overrides = []): Product
    {
        return Product::create(array_merge($this->productPayload(), [
            'created_by' => $this->admin->id,
        ], $overrides));
    }

    private function productPayload(array $overrides = []): array
    {
        return array_merge([
            'code' => 'SKU-TEST',
            'name' => 'Test product',
            'brand_id' => $this->brand->id,
            'category_id' => $this->category->id,
            'price' => 150000,
            'discount_percentage' => 10,
            'discount_from_date' => '2026-05-01',
            'discount_to_date' => '2026-05-31',
            'media_id' => 1,
            'inventory_qty' => 20,
            'description' => 'Gentle daily skincare product',
            'star' => 4.5,
            'featured' => 1,
            'status' => 1,
        ], $overrides);
    }
}

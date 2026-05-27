<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AdminProductSearchTest extends TestCase
{
    use DatabaseTransactions;

    private Admin $admin;
    private Brand $laneige;
    private Brand $innisfree;
    private Category $skincare;
    private Category $makeup;

    protected function setUp(): void
    {
        parent::setUp();

        config(['scout.driver' => 'database']);

        $this->admin = Admin::create([
            'name' => 'Admin',
            'email' => 'admin@example.test',
            'password' => 'password',
            'role' => Admin::ROLE['Manager'],
            'is_active' => true,
        ]);

        $this->laneige = $this->createBrand('Laneige');
        $this->innisfree = $this->createBrand('Innisfree');
        $this->skincare = $this->createCategory('Skincare');
        $this->makeup = $this->createCategory('Makeup');

        $this->createProduct('Water Sleeping Mask', $this->laneige, $this->skincare);
        $this->createProduct('Green Tea Serum', $this->innisfree, $this->skincare);
        $this->createProduct('Matte Cushion', $this->laneige, $this->makeup);
    }

    public function test_admin_can_search_products_by_name(): void
    {
        $this->actingAs($this->admin, 'admin')
            ->get(route('admin.product.index', ['name' => 'Sleeping']))
            ->assertOk()
            ->assertSee('Water Sleeping Mask')
            ->assertDontSee('Green Tea Serum')
            ->assertDontSee('Matte Cushion')
            ->assertSee('value="Sleeping"', false);
    }

    public function test_admin_can_filter_products_by_brand(): void
    {
        $this->actingAs($this->admin, 'admin')
            ->get(route('admin.product.index', ['brand_id' => $this->innisfree->id]))
            ->assertOk()
            ->assertSee('Green Tea Serum')
            ->assertDontSee('Water Sleeping Mask')
            ->assertDontSee('Matte Cushion');
    }

    public function test_admin_can_filter_products_by_category(): void
    {
        $this->actingAs($this->admin, 'admin')
            ->get(route('admin.product.index', ['category_id' => $this->makeup->id]))
            ->assertOk()
            ->assertSee('Matte Cushion')
            ->assertDontSee('Water Sleeping Mask')
            ->assertDontSee('Green Tea Serum');
    }

    public function test_admin_can_combine_product_search_filters(): void
    {
        $this->actingAs($this->admin, 'admin')
            ->get(route('admin.product.index', [
                'name' => 'Mask',
                'brand_id' => $this->laneige->id,
                'category_id' => $this->skincare->id,
            ]))
            ->assertOk()
            ->assertSee('Water Sleeping Mask')
            ->assertDontSee('Green Tea Serum')
            ->assertDontSee('Matte Cushion');
    }

    private function createBrand(string $name): Brand
    {
        return Brand::create([
            'name' => $name,
            'status' => 1,
            'created_by' => $this->admin->id,
        ]);
    }

    private function createCategory(string $name): Category
    {
        return Category::create([
            'name' => $name,
            'parent_id' => 0,
            'status' => 1,
            'created_by' => $this->admin->id,
        ]);
    }

    private function createProduct(string $name, Brand $brand, Category $category): Product
    {
        return Product::create([
            'code' => 'SKU-' . str_replace(' ', '-', strtoupper($name)),
            'name' => $name,
            'brand_id' => $brand->id,
            'category_id' => $category->id,
            'price' => 150000,
            'discount_percentage' => 0,
            'discount_from_date' => '2026-05-01',
            'discount_to_date' => '2026-05-31',
            'media_id' => 1,
            'inventory_qty' => 10,
            'description' => $name . ' description',
            'star' => 4.5,
            'featured' => 0,
            'created_by' => $this->admin->id,
            'status' => 1,
        ]);
    }
}

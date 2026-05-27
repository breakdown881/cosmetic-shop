<?php

namespace Tests\Unit;

use App\Models\Product;
use Laravel\Scout\Searchable;
use PHPUnit\Framework\TestCase;

class ProductSearchableTest extends TestCase
{
    public function test_product_is_searchable_for_elasticsearch(): void
    {
        $this->assertContains(Searchable::class, class_uses_recursive(Product::class));
        $this->assertSame('product_index', (new Product())->searchableAs());
    }

    public function test_product_search_document_contains_search_fields(): void
    {
        $product = new Product([
            'code' => 'SKU-001',
            'name' => 'Cleanser',
            'brand_id' => 2,
            'category_id' => 3,
            'price' => 150000,
            'discount_percentage' => 10,
            'inventory_qty' => 20,
            'description' => 'Gentle daily skincare product',
            'star' => 4.5,
            'featured' => 1,
            'status' => 1,
        ]);
        $product->id = 1;

        $this->assertSame([
            'id' => 1,
            'code' => 'SKU-001',
            'name' => 'Cleanser',
            'brand_id' => 2,
            'category_id' => 3,
            'price' => 150000,
            'discount_percentage' => 10,
            'inventory_qty' => 20,
            'description' => 'Gentle daily skincare product',
            'star' => 4.5,
            'featured' => 1,
            'status' => 1,
        ], $product->toSearchableArray());
    }
}

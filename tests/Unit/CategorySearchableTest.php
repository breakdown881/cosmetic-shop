<?php

namespace Tests\Unit;

use App\Models\Category;
use Laravel\Scout\Searchable;
use Tests\TestCase;

class CategorySearchableTest extends TestCase
{
    public function test_category_is_searchable_for_elasticsearch(): void
    {
        $this->assertContains(Searchable::class, class_uses_recursive(Category::class));
        $this->assertSame('category_index', (new Category())->searchableAs());
    }

    public function test_category_search_document_contains_category_fields(): void
    {
        $category = new Category([
            'name' => 'Skincare',
            'parent_id' => 0,
            'created_by' => 1,
            'status' => 1,
        ]);
        $category->id = 10;

        $this->assertSame([
            'id' => 10,
            'name' => 'Skincare',
            'parent_id' => 0,
            'created_by' => 1,
            'status' => 1,
        ], $category->toSearchableArray());
    }
}

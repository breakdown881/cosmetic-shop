<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository extends AbstractRepository implements ProductRepositoryInterface
{
    public function getModel()
    {
        return Product::class;
    }

    public function get($id)
    {
        return Product::find($id);
    }

    public function getAll()
    {
        $products = Product::latest()->get();
        if ($products->isNotEmpty()) {
            return $products;
        }
        return null;
    }

    public function search(array $filters)
    {
        $name = trim((string) ($filters['name'] ?? ''));
        $brandId = $filters['brand_id'] ?? null;
        $categoryId = $filters['category_id'] ?? null;

        $products = Product::search($name)
            ->when($brandId, function ($builder) use ($brandId) {
                $builder->where('brand_id', (int) $brandId);
            })
            ->when($categoryId, function ($builder) use ($categoryId) {
                $builder->where('category_id', (int) $categoryId);
            })
            ->query(function ($query) use ($name, $brandId, $categoryId) {
                if ($name !== '') {
                    $query->where('name', 'like', '%' . $name . '%');
                }

                if ($brandId) {
                    $query->where('brand_id', (int) $brandId);
                }

                if ($categoryId) {
                    $query->where('category_id', (int) $categoryId);
                }

                $query->latest();
            })
            ->get();

        if ($products->isNotEmpty()) {
            return $products;
        }
        return null;
    }

    public function getByCategory($id)
    {
        $products = Product::all()->where('category_id', $id);
        if ($products) {
            return $products;
        }
        return null;
    }

    public function getByBrand()
    {
        $products = Product::all()->where('brand_id', NULL);
        if ($products) {
            return $products;
        }
        return null;
    }

    public function create(array $data)
    {
        try {
            return Product::create($data);
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function update($product, array $data)
    {
        try {
            if ($product) {
                $product->fill($data);
                if ($product->save()) {
                    return $product;
                }
                return false;
            }
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function delete($product)
    {
        try {
            if ($product) {
                return $product->delete();
            }

            return false;
        } catch (\Exception $exception) {
            return false;
        }
    }
}

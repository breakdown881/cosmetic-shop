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

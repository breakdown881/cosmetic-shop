<?php

namespace App\Services\Admin;

use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Auth;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAll()
    {
        return $this->productRepository->getAll();
    }

    public function getByCategory($id)
    {
        return $this->productRepository->getByCategory($id);
    }

    public function getByBrand()
    {
        return $this->productRepository->getByBrand();
    }

    public function get($id)
    {
        return $this->productRepository->get($id);
    }

    public function store($data)
    {
        $data['created_by'] = Auth::guard('admin')->user()->id;
        $product = $this->productRepository->create($data);

        return $product;
    }

    public function update($product, $data)
    {
        $this->productRepository->update($product, $data);

        return $product;
    }

    public function destroy($product)
    {
        return $this->productRepository->delete($product);
    }

    public function changeStatus($product, $status)
    {
        $this->productRepository->update($product, ['status' => $status]);
        return $product;
    }
}

<?php

namespace App\Services\Admin;

use App\Repositories\BrandRepository;
use Illuminate\Support\Facades\Auth;

class BrandService
{
    protected $brandRepository;

    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function getAll()
    {
        return $this->brandRepository->getAll();
    }

    public function searchByName(?string $name)
    {
        $name = trim((string) $name);

        if ($name === '') {
            return $this->getAll();
        }

        return $this->brandRepository->searchByName($name);
    }

    public function get($id)
    {
        return $this->brandRepository->get($id);
    }

    public function store($data, $image = null)
    {
        $data['created_by'] = Auth::guard('admin')->user()->id;
        $brand = $this->brandRepository->create($data);

        if ($image) {
            $brand->addMedia($image)->toMediaCollection('brands');
        }

        return $brand;
    }

    public function update($brand, $data, $image = null)
    {
        $this->brandRepository->update($brand, $data);

        if ($image) {
            $brand->clearMediaCollection('brands');
            $brand->addMedia($image)->toMediaCollection('brands');
        }

        return $brand;
    }

    public function destroy($brand)
    {
        return $this->brandRepository->delete($brand);
    }

    public function changeStatus($brand, $status)
    {
        $this->brandRepository->update($brand, ['status' => $status]);
        return $brand;
    }
}

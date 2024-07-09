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

    public function get($id)
    {
        return $this->brandRepository->get($id);
    }

    public function store($data)
    {
        $data['created_by'] = Auth::guard('admin')->user()->id;
        return $this->brandRepository->create($data);
    }

    public function update($id, $data)
    {
        $data['created_by'] = Auth::guard('admin')->user()->id;
        return $this->brandRepository->update($id, $data);
    }
}

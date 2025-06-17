<?php

namespace App\Services\Admin;

use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Auth;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll()
    {
        return $this->categoryRepository->getAll();
    }

    public function getChild($id)
    {
        return $this->categoryRepository->getChild($id);
    }

    public function getParent()
    {
        return $this->categoryRepository->getParent();
    }

    public function get($id)
    {
        return $this->categoryRepository->get($id);
    }

    public function store($data)
    {
        $data['created_by'] = Auth::guard('admin')->user()->id;
        $category = $this->categoryRepository->create($data);

        return $category;
    }

    public function update($category, $data)
    {
        $this->categoryRepository->update($category, $data);

        return $category;
    }

    public function destroy($category)
    {
        return $this->categoryRepository->delete($category);
    }

    public function changeStatus($category, $status)
    {
        $this->categoryRepository->update($category, ['status' => $status]);
        return $category;
    }
}

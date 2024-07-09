<?php

namespace App\Repositories;

use App\Models\Brand;
use Illuminate\Support\Facades\DB;

class BrandRepository extends AbstractRepository implements BrandRepositoryInterface
{
    public function getModel()
    {
        return Brand::class;
    }

    public function get($id)
    {
        $brand = Brand::all()->firstWhere('id', $id);
        if ($brand) {
            return $brand;
        }
        return null;
    }

    public function getAll()
    {
        $brands = Brand::all();
        if ($brands->isNotEmpty()) {
            return $brands;
        }
        return null;
    }

    public function create(array $data)
    {
        try {
            $existBrand = Brand::where('name', '=', $data["name"])->get();
            $brandObject = new Brand();
            $brandObject->fill($data);

            if ($existBrand->count() == 0) {
                if ($brandObject->save()) {
                    return true;
                }
            }
            return false;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function update($id, $data)
    {
        try {
            $brand = Brand::all()->find($id);
            if ($brand) {
                $brand->fill($data);
                if ($brand->save()) {
                    return true;
                }
                return false;
            }
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function delete($ids)
    {
        try {
            // $resultPackage = Package::destroy($ids);
            // if ($resultPackage) {
            //     $packageModule = PackageModule::all()->firstWhere('packageId',$ids);
            //     $resultPackageModule = PackageModule::destroy($packageModule->id);
            //     if($resultPackageModule) {
            //         return $resultPackageModule;
            //     }
            // }
            // return null;
        } catch (\Exception $exception) {
            // return false;
        }
    }
}

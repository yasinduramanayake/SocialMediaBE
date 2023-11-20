<?php

namespace Modules\CategoryManagement\Repositaries;

use Modules\CategoryManagement\Entities\Category;
use Modules\CategoryManagement\Repositaries\CategoryServicesInterfaces;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Storage;

class CategoryServicesImplements implements CategoryServicesInterfaces
{
    public function create($data)
    {

        $image_path = Storage::disk('public')->put('caegoryicons', $data['icon']);

        $category = new Category();

        $category->name = $data['name'];
        $category->icon =  $image_path;
        $category->color_code = $data['color_code'];


        $category->save();

        return $category;
    }
    public function index()
    {
        $categories = QueryBuilder::for(Category::class)
            ->allowedFilters(['name'])
            ->with('subcategory', 'service')
            ->get();

        return $categories;
    }

    public function showMainCategoryServices()
    {
        $categories = Category::query()
            ->with(['subcategory' => function ($query) {
                $query->where('type', 'main');
            }])
            ->with(['subcategorynew' => function ($query) {
                $query->where('type', 'other');
            }])
            ->get();
        return  $categories;
    }
}

<?php

namespace Modules\SubCategoryManagement\Repositaries;

use Illuminate\Http\Client\Request;
use Illuminate\Http\Request as HttpRequest;
use Modules\SubCategoryManagement\Entities\SubCategory;
use Modules\SubCategoryManagement\Repositaries\SubCategoryServicesInterfaces;
use Spatie\QueryBuilder\QueryBuilder;

class SubCategoryServicesImplements implements SubCategoryServicesInterfaces
{
    public function create($data)
    {
        foreach ($data['items'] as $value) {
            SubCategory::create($value);
        }

        return $data;
    }

    public function index($data)
    {

        $sub_categories = SubCategory::where('category_id', $data['category_id'])->get();

        return  $sub_categories;
    }

    // Sub category update
    public function update($id, $data)
    {
        $id->update($data);

        return  $data;
    }

    // Sub category delete
    public function delete($id)
    {
        $status =  $id->delete();

        return  $status;
    }
}

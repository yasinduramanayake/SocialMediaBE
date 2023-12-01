<?php

namespace Modules\CategoryManagement\Repositaries;
use Modules\CategoryManagement\Entities\Category;


interface CategoryServicesInterfaces
{
    public function create($data);

    public function index();

    public function showMainCategoryServices();

    public function update($id, $data);

    public function delete($id);
}

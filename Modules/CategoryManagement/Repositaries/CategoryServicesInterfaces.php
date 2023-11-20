<?php

namespace Modules\CategoryManagement\Repositaries;


interface CategoryServicesInterfaces
{
    public function create($data);

    public function index();

    public function showMainCategoryServices();
}

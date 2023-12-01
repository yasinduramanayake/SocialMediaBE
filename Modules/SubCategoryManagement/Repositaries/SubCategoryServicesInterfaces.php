<?php

namespace Modules\SubCategoryManagement\Repositaries;


interface SubCategoryServicesInterfaces
{
    public function create($data);

    public function index($data);
    
    public function update($id, $data);

    public function delete($id);
}

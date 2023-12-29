<?php

namespace Modules\ReviewManagement\Repositaries;
use Modules\CategoryManagement\Entities\Category;


interface ReviewServicesInterfaces
{
    public function create($data);

    public function index();

    
    public function addcontact($data);

}

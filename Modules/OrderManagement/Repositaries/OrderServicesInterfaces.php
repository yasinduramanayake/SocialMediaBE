<?php

namespace Modules\OrderManagement\Repositaries;


interface OrderServicesInterfaces
{
    public function create($data);

    public function index();

    public function changeStatus($data);

    public function cartorders();

}

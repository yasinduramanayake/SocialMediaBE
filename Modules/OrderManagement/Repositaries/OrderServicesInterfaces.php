<?php

namespace Modules\OrderManagement\Repositaries;


interface OrderServicesInterfaces
{
    public function create($data);

    public function index();

    public function cartorders($data);

    public function deleteorder($id);
}

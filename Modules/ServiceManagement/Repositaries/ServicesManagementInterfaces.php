<?php

namespace Modules\ServiceManagement\Repositaries;

interface ServicesManagementInterfaces
{
    public function create($data);

    public function index($data);

    public function scraper($data);
}

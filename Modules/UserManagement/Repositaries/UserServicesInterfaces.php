<?php

namespace Modules\UserManagement\Repositaries;


interface UserServicesInterfaces
{
    public function login($data);

    public function register($data);

    public function forgetpassword($data);

    public function resetpassword($data);
    
}

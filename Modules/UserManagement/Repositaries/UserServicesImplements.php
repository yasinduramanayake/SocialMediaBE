<?php

namespace Modules\UserManagement\Repositaries;

use Modules\UserManagement\Entities\User;
use Modules\SubCategoryManagement\Entities\SubCategory;
use Modules\UserManagement\Repositaries\UserServicesInterfaces;
use Illuminate\Validation\ValidationException;
use Auth;


class UserServicesImplements implements UserServicesInterfaces
{
    public function register($data)
    {
        $data['password'] = bcrypt($data['password']);

        if ($data['view'] === 'Front') {
            $user = User::create($data);
            $user->assignRole("User");
            return ([
                'data' => $user,
                'token' => $user->createToken('api-system-user')->accessToken,
            ]);
        } else if ($data['view'] === "Back") {
            $user =    User::create($data);
            $user->assignRole("Admin");
            return ([
                'data' => $user,
                'token' => $user->createToken('api-system-user')->accessToken,
            ]);
        }
    }

    public function login($data)
    {
        if (!Auth::attempt($data)) {
            throw ValidationException::withMessages([
                'login' => 'Invalid Credentials',
            ]);
        }
        return ([
            'data' =>  auth()->user(),
            'token' =>  auth()->user()->createToken('api-system-user')->accessToken,
            'roles' => auth()->user()->rolesWithPermissions()->get(), 
        ]);
    }
}

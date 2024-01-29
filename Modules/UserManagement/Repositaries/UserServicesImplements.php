<?php

namespace Modules\UserManagement\Repositaries;

use Modules\UserManagement\Entities\User;
use Modules\SubCategoryManagement\Entities\SubCategory;
use Modules\UserManagement\Repositaries\UserServicesInterfaces;
use Illuminate\Validation\ValidationException;
use Auth;
use App\Notifications\mailNotifications;

class UserServicesImplements implements UserServicesInterfaces
{
    public function register($data)
    {
       
        $password = bcrypt($data['password']);

        if ($data['view'] === 'Front') {
            $user = new User();

            $user->firstname = $data['firstname'];
            $user->lastname = $data['lastname'];
            $user->email = $data['email'];
            $user->password = $password;
            $user->save();
            $user->assignRole('User');

            $logindata = [
                'email' => $data['email'],
                'password' => $data['password'],
            ];

           
            $this->login($logindata);
            return [
                'data' => auth()->user(),
                'token' => auth()
                    ->user()
                    ->createToken('api-system-user')->accessToken,
                'roles' => auth()
                    ->user()
                    ->rolesWithPermissions()
                    ->get(),
            ];
        } elseif ($data['view'] === 'Back') {
            $user = User::create($data);
            $user->assignRole('Admin');
            return [
                'data' => $user,
                'token' => $user->createToken('api-system-user')->accessToken,
            ];
        }
    }

    public function login($data)
    {
        if (!Auth::attempt($data)) {
            throw ValidationException::withMessages([
                'login' => 'Invalid Credentials',
            ]);
        }
        return [
            'data' => auth()->user(),
            'token' => auth()
                ->user()
                ->createToken('api-system-user')->accessToken,
            'roles' => auth()
                ->user()
                ->rolesWithPermissions()
                ->get(),
        ];
    }

    public function forgetpassword($data)
    {
        $tempPassword = random_int(3678479, 9837522);
        $userdata = User::where('email', $data['email'])->first();
        $userdata->tempory_password = $tempPassword;
        $userdata->save();
        $maildata = [
            'subject' => 'Sent Reset Password Link',
            'greeting' => 'Hello' . ' ' . $userdata->firstname . '!',
            'line1' => 'Your Tempory password is ' . $tempPassword,
            'line2' => 'You Should use Tempory Password To Reset Your Password',
            'line3' => 'Thank you for using our application!',
        ];
        $userdata->notify(new mailNotifications($maildata));
    }

    public function resetpassword($data)
    {
        $userdata = User::where(
            'tempory_password',
            $data['temporypassword']
        )->first();

        if ($userdata != null) {
            $userdata->password = bcrypt($data['password']);
            $userdata->save();
        } else {
            throw ValidationException::withMessages(
                [
                    'error' => 'No Data Matched With Temory password',
                ],
                422
            );
        }
    }
}

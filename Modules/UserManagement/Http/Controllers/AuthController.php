<?php

namespace Modules\UserManagement\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Auth;
use Illuminate\Routing\Controller;
use Modules\UserManagement\Entities\User;
use Exception;
use Modules\UserManagement\Http\Requests\LoginRequest;
use Modules\UserManagement\Repositaries\UserServicesInterfaces;
use Modules\UserManagement\Http\Requests\RegisterRequest;

class AuthController extends Controller
{

    protected $repositoryinterface;

    public function __construct(
        UserServicesInterfaces $repositoryinterface
    ) {
        $this->repositoryinterface = $repositoryinterface;
    }

    public function login(LoginRequest $request)
    {
        try {
            $responseData =   $this->repositoryinterface->login($request->validated());
            return response()->json(['data' => $responseData]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function register(RegisterRequest $request)
    {
        try {
            $responseData =   $this->repositoryinterface->register($request->validated());
            return response()->json(['data' => $responseData]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

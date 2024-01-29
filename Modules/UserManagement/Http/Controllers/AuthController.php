<?php

namespace Modules\UserManagement\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Auth;
use Illuminate\Routing\Controller;
use Modules\UserManagement\Entities\User;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Modules\UserManagement\Http\Requests\LoginRequest;
use Modules\UserManagement\Repositaries\UserServicesInterfaces;
use Modules\UserManagement\Http\Requests\RegisterRequest;
use Modules\UserManagement\Http\Requests\ResetRequest;
use Modules\UserManagement\Repositaries\UserServicesImplements;

class AuthController extends Controller
{
    protected $repositoryinterface;

    public function __construct(UserServicesInterfaces $repositoryinterface)
    {
        $this->repositoryinterface = $repositoryinterface;
    }

    public function login(LoginRequest $request)
    {
        try {
            $responseData = $this->repositoryinterface->login(
                $request->validated()
            );
            return response()->json(['data' => $responseData]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function register(RegisterRequest $request)
    {
        try {
            $responseData = $this->repositoryinterface->register(
                $request->validated()
            );
            return response()->json(['data' => $responseData]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function googleregister()
    {
        // $url = Socialite::driver('google')->stateless()
        //     ->redirect()
        //     ->getTargetUrl();

        // return response()->json(
        //     [
        //         'url' => $url,
        //     ],
        //     200
        // );
        return response()->json(
            [
                'url' =>
                'https://accounts.google.com/o/oauth2/v2/auth?response_type=code&access_type=online&client_id=60131709563-h13deqkfn4lmuinr83fcm2ctr4ipq9q1.apps.googleusercontent.com&redirect_uri=https%3A%2F%2Ffollowsta.com&state&scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile%20https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email%20openid%20https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fdrive.metadata.readonly&approval_prompt=auto&include_granted_scopes=true',
            ],
            200
        );
    }

    public function getClient()
    {
        // load our config.json that contains our credentials for accessing google's api as a json string
        $configJson = base_path() . '/config.json';

        // define an application name
        $applicationName = 'Folowsta';

        // create the client
        $client = new \Google_Client();
        $client->setApplicationName($applicationName);
        $client->setAuthConfig($configJson);
        // $client->setAccessType('offline'); // necessary for getting the refresh token
        // $client->setApprovalPrompt ('force'); // necessary for getting the refresh token
        // scopes determine what google endpoints we can access. keep it simple for now.
        $client->setScopes(
            [
                \Google\Service\Oauth2::USERINFO_PROFILE,
                \Google\Service\Oauth2::USERINFO_EMAIL,
                \Google\Service\Oauth2::OPENID,
                \Google\Service\Drive::DRIVE_METADATA_READONLY // allows reading of google drive metadata
            ]
        );
        $client->setIncludeGrantedScopes(true);
        return $client;
    } // getClient



    public function registeruserwithgoogle(Request $request)
    {

        // $user = Socialite::driver('google')->stateless()->userFromToken($request->input('code'));

        // return response()->json(
        //     [
        //         'user' =>  $user,
        //     ],
        //     200
        // );
        $authCode = urldecode($request->input('code'));

        /**
         * Google client
         */
        $client = $this->getClient();

        /**
         * Exchange auth code for access token
         * Note: if we set 'access type' to 'force' and our access is 'offline', we get a refresh token. we want that.
         */
        $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);

        /**
         * Set the access token with google. nb json
         */
        $client->setAccessToken(json_encode($accessToken));
        /**
         * Get user's data from google
         */
        $service = new \Google\Service\Oauth2($client);
        $userFromGoogle = $service->userinfo->get();

        /**
         * Select user if already exists
         */
        $user = User::where('provider_id', $userFromGoogle->id)->first();

        /**
         */
        if (!$user) {
            $user = User::create([
                'provider_id' => $userFromGoogle->id,
                'firstname' => $userFromGoogle->name,
                'email' => $userFromGoogle->email,
                'password' => bcrypt('Password1234AdminFolowsta12##$!0#8i9'),
            ]);
            $user->assignRole('User');

            $logindata = [
                'email' => $userFromGoogle->email,
                'password' => 'Password1234AdminFolowsta12##$!0#8i9'
            ];
            $login = new UserServicesImplements();
            $responsedata = $login->login($logindata);
            return response()->json(['data' => $responsedata]);
        }
        /**
         * Save new access token for existing user
         */
        else {
            $logindata = [
                'email' => $userFromGoogle->email,
                'password' => 'Password1234AdminFolowsta12##$!0#8i9'
            ];
            $login = new UserServicesImplements();
            $responsedata = $login->login($logindata);
            return response()->json(['data' => $responsedata]);
        }

        /**
         * Log in and return token
         * HTTP 201
         */
    }

    // public function getAuthUrl()
    // {
    //     /**
    //      * Create google client
    //      */
    //     $client = $this->getClient();

    //     /**
    //      * Generate the url at google we redirect to
    //      */
    //     $authUrl = $client->createAuthUrl();

    //     /**
    //      * HTTP 200
    //      */
    //     return response()->json($authUrl, 200);
    // } // getAuthUrl

    public function profile()
    {
        try {
            $data = [
                'email' => auth('api')->user()->email,
                'name' => auth('api')->user()->name,
                'roles' => auth('api')
                    ->user()
                    ->rolesWithPermissions()
                    ->get(),
            ];
            return response()->json(['data' => $data]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function logout()
    {
        try {
            $usertoken = auth('api')
                ->user()
                ->token();
            $usertoken->revoke();
            return response([
                'data' => 'logged out',
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function forgot(Request $request)
    {
        $validatedata = $request->validate([
            'email' => 'required',
        ]);
        try {
            $responseData = $this->repositoryinterface->forgetpassword(
                $validatedata
            );
            return response()->json(['data' => $responseData]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function reset(ResetRequest $request)
    {
        try {
            $responseData = $this->repositoryinterface->resetpassword(
                $request->validated()
            );
            return response()->json(['data' => $responseData]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

<?php

namespace App\Http\Controllers\api;

use App\Models\User;

use App\Http\Controllers\ApiController;
use DB;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthController extends ApiController
{


    public function register(Request $request)
    {
        try
        {

            $validate_request = Validator::make(

                $request->all(),

                array(
                    'email' => 'required|string|unique:users,email',
                    'password' => 'required',
                    'name'    => 'required|string',
                    'phone'    => 'required|numeric',

                ));

            if ($validate_request->fails())
            {
                    $error = $validate_request->errors()->first();
                    $res = [
                        'message' => $error,
                        'error' => 'true',
                    ];
                    return response()->json($res, 200);
            }

            $user = User::create([
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'email' => $request->email,
                'phone' => $request->phone,
                'is_admin' => 0,
                'active'   => 0,
            ]);
           // $token = $user->createToken('apiToken')->plainTextToken;

            $res = [
                'error' =>'false',
                'user' => $user,
                'token' => '',
            ];

            return response()->json($res, 200);
        }catch(Exception $e)
        {

            return $this->errorResponse(['message' => $e->getMessage(),  'error' => 'true']);

        }


    }

    public function login(Request $request)
    {
        try
        {
        $data = $request->validate([
            'email' => 'required',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {

            return response([
                'msg' => 'incorrect username or password',
                'error' => 'true'
            ], 401);
        }
        if($user->active != 1){
            return response([
                'msg' => 'You are not verified person',
                'error' => 'true'
            ], 401);
        }
        $token = $user->tokens()->first();

        if($token){
            return response([
                'msg' => 'You are ready logged in any other device',
                'error' => 'true'
            ], 401);
        }
        $token = $user->createToken('apiToken')->plainTextToken;

        $res = [
            'user' => $user,
            'token' => $token,
                'error' => 'false'
        ];

        return response()->json($res, 200);

        }catch(Exception $e){



            return $this->errorResponse(['message' => $e->getMessage(),  'error' => 'true']);

        }


    }

    public function logout()
    {
        try{

            $user = auth()->user();



            if ($user){


                $accessToken = auth()->user()->tokens()->delete();



                return response([

                    'message' => "Logout Successfully",

                    "error" => false

                ],200);

            }else{

                return response([

                    'message' => "User Not Found",

                    "error" => false

                ],200);

            }

        }catch(Exception $e){

            return response([

                'message' => "User Not Found",

                "error" => false

            ],200);

        }

    }
    public function forgotPassword(Request $request)
    {



        try
        {
            $credentials = request()->validate(['email' => 'required|email']);
            $data = $request->validate([
                'email' => 'required|email',

            ]);

            Password::sendResetLink($credentials);

            {

                return response([

                    'message' => "Reset password link sent on your email ",

                    'error' => "false"

                ], 200);

            }
        }
        catch(Exception $e){

            return response([

                'message' => "Email required",

                "error" => true

            ],200);

        }
    }
    public function delete_account(Request $request){

        try
        {
        $data = $request->validate([
            'token' => 'required',

        ]);

        $post_data = $request->all();
        if (isset($post_data['token'])) {
            [$id, $token] = explode('|', $post_data['token'], 2);
            $token_data = DB::table('personal_access_tokens')->where('token', hash('sha256', $token))->first();
            $user_id = $token_data->tokenable_id;
            dd($user);
            $res = [

                'message' => 'Successfully deleted',
                     'error' => 'false'
             ];

        }
        else{
            $res = [

                'message' => 'Invalid Token',
                     'error' => 'false'
             ];

        }






        }catch(Exception $e){

            $res = [

                'message' =>  $e->getMessage(),

             ];

             return response()->json($res, 401);
        }

    }
}

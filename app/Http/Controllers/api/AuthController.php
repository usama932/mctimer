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

                ));

            if ($validate_request->fails())
            {
                    $error = $validate_request->errors()->first();
                    $res = [
                        'error' => $error,
                    ];
                    return response()->json($res, 200);
            }
        
            $user = User::create([
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'email' => $request->email,
                'is_admin' => 0,
                'active'   => 0,
            ]);
            $token = $user->createToken('apiToken')->plainTextToken;

            $res = [
                'user' => $user,
                'token' => $token
            ];

            return response()->json($res, 200);
        }catch(Exception $e)
        {



            return $this->errorResponse($e->getMessage(), 200);

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
                'msg' => 'incorrect username or password'
            ], 401);
        }
        if($user->active != '1'){
            return response([
                'msg' => 'You are not verified person'
            ], 401);
        }else{
            $token = $user->createToken('apiToken')->plainTextToken;

            $res = [
                'user' => $user,
                'token' => $token
            ];
    
            return response()->json($res, 200);
        }
        }catch(Exception $e){



            return $this->errorResponse($e->getMessage(), 200);

        }

      
    }

    public function logout()
    {
        try{

            $user = auth()->user();

          

            if ($user){

                $accessToken = auth()->user()->token()->delete();

              

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
     
        $credentials = request()->validate(['email' => 'required|email']);



        Password::sendResetLink($credentials);

        {

            return response([

                'message' => "Reset password link sent on your email ",

                'error' => true

            ], 200);

        }
    }
}
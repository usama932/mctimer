<?php

namespace App\Http\Controllers\api;

use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use DB;
use Exception;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\Rules\Password as RulesPassword;

class AuthController extends Controller
{
  

    public function register(Request $request)
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
      
    }

    public function login(Request $request)
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
      
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        $res = [
            'message' => "Logout Succesfully",
        
        ];

        return response()->json($res, 200);
    }
    public function forgotPassword(Request $request)
    {
     
        $request->validate([
            'email' => 'required|email',
        ]);
       
        $status = Password::sendResetLink(
            $request->only('email')
        );
       
        if ($status == Password::RESET_LINK_SENT) {
            return [
                'status' => __($status)
            ];
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
        $res = [
            'message' => "email Sent Succesfully",
        
        ];

        return response()->json($res, 200);
    }
}
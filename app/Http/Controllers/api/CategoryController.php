<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\Rules\Password as RulesPassword;

class CategoryController extends Controller
{
    

    public function get_product(){
        
        $categories = Category::where('status','1')->with('product')
                                ->get();
                            
        if(!empty($categories)){
            $res = [
                'categories' => $categories,
                'error' => "false"
            ];
            return response()->json($res, 200);
        }
        else{
            $res = [
                'categories' => 'Not Found',
                'error' => "false"
            ];
            return response()->json($res, 200);
        }
    }
}

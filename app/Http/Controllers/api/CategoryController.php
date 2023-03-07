<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Traits\ApiResponser;
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

class CategoryController extends Controller
{
    use ApiResponser;

    public function get_product(){
        
        $categories = Category::where('status','1')->with('product')
                                ->get();
                            
        if(!empty($categories)){
            $res = [
                'categories' => $categories,
            ];
            return response()->json($res, 200);
        }
        else{
            $res = [
                'categories' => 'Not Found',
            ];
            return response()->json($res, 200);
        }
    }
}

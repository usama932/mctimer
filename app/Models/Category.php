<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'status','expiry_date_time',
    ];
    public function product(){
        return $this->hasMany('App\Models\Product' ,'category_id','id');
    }
   
    public function getStatusAttribute($value)
    { 
       if($value == 1){
        $value = 'Active';
        return $value;
       }
       else{
        $value = 'InActive';
        return $value;
       }  
    }
}

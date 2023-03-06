<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'status','category_id','expiry_date_time'
    ];
    public function category(){
        return $this->belongsTo('App\Models\Category','category_id','id');
    }
}

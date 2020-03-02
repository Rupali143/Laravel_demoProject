<?php

namespace App\Eloquent\Model;

use Illuminate\Database\Eloquent\Model;

class Cart_product extends Model
{
    public function product(){
        return $this->belongsTo(Product::class);
    }

//    public function orders(){
//        return $this->belongsTo(Order::class,'id');
//    }

    public function image(){
        return $this->hasMany(Product_image::class,'product_id','product_id');
    }
}

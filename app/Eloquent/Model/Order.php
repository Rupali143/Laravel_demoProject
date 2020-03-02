<?php

namespace App\Eloquent\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user(){
        return $this->belongsTo(\App\user::class);
    }

    public function orderDetails(){
        return $this->hasMany(Order::class,'id');
    }

    public function cartProducts()
    {
        return $this->hasMany(Cart_product::class);
    }

//    public function image(){
//        return $this->hasMany(Product_image::class,'product_id','product_id');
//    }

//    public function product(){
//        return $this->hasMany(Product::class,Cart_product::class);
//    }
}

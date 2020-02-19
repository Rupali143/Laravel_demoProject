<?php

namespace App\Eloquent\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favourite extends Model
{
    use SoftDeletes;

    protected $fillable = ['product_id','customer_id'];
    protected $dates = ['deleted_at'];


    public function productImages(){
        return $this->hasMany(Product_image::class,'product_id','product_id');
    }


    public function product(){
        return $this->belongsTo(Product::class);
//        return $this->hasOneThrough(Product_image::class,Product::class,'id');
    }

    public function oneProductImg(){
        return $this->hasOne(Product_image::class,'product_id');
    }
}

<?php

namespace App\Eloquent\Model;

use Illuminate\Database\Eloquent\Model;


class Product_image extends Model
{
    protected $fillable = ['images'];

//    public function products()
//    {
//        return $this->hasMany(Product::class);
//    }

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}

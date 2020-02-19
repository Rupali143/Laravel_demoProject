<?php

namespace App\Eloquent\Model;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['name','category_id','images'];

    protected $dates = ['deleted_at'];

    public function cat()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function image(){
        return $this->hasMany(Product_image::class,'product_id')->inRandomOrder();
//        return $this->hasOne(Product_image::class,'product_id')->select(Product_image::class,'images', \DB::raw('count(*) as total'))->distinct(Product_image::class,'images')->groupBy(Product_image::class,'images')->inRandomOrder();
    }

    public function favourite(){
        return $this->hasOne(Favourite::class,'product_id');
    }

   
}

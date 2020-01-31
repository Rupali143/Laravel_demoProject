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
}

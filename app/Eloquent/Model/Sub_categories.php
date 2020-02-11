<?php

namespace App\Eloquent\Model;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Sub_categories extends Model
{
    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];

    use SoftDeletes;

    public function cat()
    {
        return $this->belongsTo(Category::class,'id');
    }

    public function cat1()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

}

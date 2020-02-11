<?php
/**
 * Created by PhpStorm.
 * User: neosoft
 * Date: 27/1/20
 * Time: 8:54 AM
 */
namespace App\Eloquent\Model;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model{

    use SoftDeletes;
    protected $fillable = ['name','categoryOrderby'];

    protected $dates = ['deleted_at'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function subcategories()
    {
        return $this->hasMany(Sub_categories::class,'category_id');
    }
}

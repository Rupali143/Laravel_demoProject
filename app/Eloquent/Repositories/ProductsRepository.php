<?php
/**
 * Created by PhpStorm.
 * User: neosoft
 * Date: 23/1/20
 * Time: 9:11 AM
 */

namespace App\Eloquent\Repositories;

use App\Eloquent\Model\Product;
use App\Contracts\ProductsRepositoryInterface;

class ProductsRepository implements ProductsRepositoryInterface{

    protected $product;

    /* Create a new Repository for Product.*/
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /*  total count of products
     @return  int
    */

    public function productCount()
    {
        return $this->product->count();
    }
}
<?php

namespace App\Eloquent\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Cart extends Model
{
    use SoftDeletes;

    protected $fillable = ['product_id','product_name'];

    public $item =null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if($oldCart){   //dd($oldCart->item);
//            $this->id = $oldCart->id;
            $this->item = $oldCart->item;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item,$id){
        $storedItem = ['qty' => 0,'price' =>$item->price ,'item' => $item];

        if($this->item) {
            if (array_key_exists($id, $this->item)) {
                $storedItem = $this->item[$id];
            }
        }

                $storedItem['qty']++;
                $storedItem['price'] = $item->price * $storedItem['qty'];
                $this->item[$id] = $storedItem;
                $this->totalQty++;
                $this->totalPrice += $item->price;
    }
}

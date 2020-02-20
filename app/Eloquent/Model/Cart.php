<?php

namespace App\Eloquent\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Cart extends Model
{
    use SoftDeletes;

    protected $fillable = ['product_id','product_name'];

    public $items =null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if($oldCart){   //dd($oldCart->items);
            $this->id = $oldCart->id;
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item,$id){
        $storedItem = ['qty' => 0,'price' =>$item->price ,'item' => $item];

        if($this->items) { dd(12);
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
                $this->items[$id] = $storedItem;
                $storedItem['qty']++;
                $storedItem['price'] = $item->price * $storedItem['qty'];

                $this->totalQty++;
                $this->totalPrice += $item->price;

    }
}

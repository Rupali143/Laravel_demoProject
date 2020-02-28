<?php

namespace App\Eloquent\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user(){
        return $this->belongsTo(\App\user::class);
    }
}

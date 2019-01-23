<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    public function status(){
    	return $this->belongsTo('\App\Status');
    }

    //many to many hence plural!
    //item_orders pertain to the name of the pivot table
    public function items(){
    	return $this->belongsToMany('\App\Item', '_item_orders')->withPivot("quantity")->withTimestamps();
    }

    //
}

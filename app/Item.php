<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
	//named as such because this will be connected to Category.php
    public function category(){
    	return $this->belongsTo('\App\Category');
    }
}

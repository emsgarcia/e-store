<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{	
	//items --> plural!
    public function items(){
    	return $this->hasMany('\App\Item');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{	
	//orders!
     public function orders(){
    	return $this->hasMany('\App\Order');
    }
}

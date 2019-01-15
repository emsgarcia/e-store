<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Item;
use App\Category;

class ItemController extends Controller
{
    public function showItems(){
    	$items = Item::all();
    	$categories = Category::all();
    	return view('items.catalog', compact("items", "categories"));
    }

    // public function addItems(Request $request){
    // 	$item = new Item;
    // 	$item->name = $request->add_items;
    // 	$item->save();
    // 	return redirect("/catalog");

    // }


}

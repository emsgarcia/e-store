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

    public function itemDetails($id){
    	$itemdetails = Item::find($id);
    	// dd($itemdetails);
    	return view('items.item_details', compact("itemdetails"));
    }

    // public function addItems(Request $request){
    // 	$item = new Item;
    // 	$item->name = $request->add_items;
    // 	$item->save();
    // 	return redirect("/catalog");

    // }

    public function showItemAddForm(){
    	return view('items.add_items');
    }

    public function saveItems(Request $request){

    	$rules = array(
    		"name"=> "required",
    		"description" => "required",
    		"price"=>"required|numeric",
    		"image_path"=>"required|image|mimes:jpeg,png,jpg,gif,svg|max:2048"
    	);

    	$this->validate($request, $rules);

    	$item = new Item;
    	$item->name = $request->name;
    	$item->description = $request->description;
    	$item->price = $request->price;
    	$item->category_id = 1;

    	$image=$request->file('image_path');
    	$image_name = time().".".$image->getClientOriginalExtension();
    	$destination = "images/";

    	//image_path is a column name in the items_table
    	$image->move($destination, $image_name);
    	$item->image_path = "/".$destination.$image_name;

    	$item->save();
    	// return view('items.item_details', compact("item"));
    	return redirect("/catalog");
    }
 


    public function deleteItem($id){
    	$itemdelete = Item::find($id);
    	$itemdelete->delete();
    	return redirect("/catalog");
    }





}

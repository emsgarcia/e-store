<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Item;
use App\Category;
use Session;

class ItemController extends Controller
{
    public function showItems(){
    	$items = Item::all();
    	$categories = Category::all();
    	return view('items.catalog', compact("items", "categories"));
    }

    public function itemDetails($id){
    	$itemdetails = Item::find($id);
    	$categories = Category::all();
    	// dd($itemdetails);
    	return view('items.item_details', compact("itemdetails", "categories"));
    }

    // public function addItems(Request $request){
    // 	$item = new Item;
    // 	$item->name = $request->add_items;
    // 	$item->save();
    // 	return redirect("/catalog");

    // }

    public function showItemAddForm(){
    	$categories = Category::all();
    	return view('items.add_items', compact("categories"));
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
    	$item->category_id = $request->category;

    	$image=$request->file('image_path');
    	$image_name = time().".".$image->getClientOriginalExtension();
    	$destination = "images/";

    	//image_path is a column name in the items_table
    	$image->move($destination, $image_name);
    	$item->image_path = "/".$destination.$image_name;

    	$item->save();
    	// return view('items.item_details', compact("item"));
    	Session::flash("successmessage", "Item was successfully added!");
    	return redirect("/catalog");
    }
 

    public function deleteItem($id){
    	$itemdelete = Item::find($id);
    	$itemdelete->delete();
    	return redirect("/catalog");
    }


    public function updateItem($taskid, Request $request){

    	$itemdetails = Item::find($taskid);

    	$rules = array(
    		"name"=> "required",
    		"description" => "required",
    		"price"=>"required|numeric",
    		"category"=>"required",
    		"image_path"=>"image|mimes:jpeg,png,jpg,gif,svg|max:2048"
    	);

    	$this->validate($request, $rules);

    	$itemdetails->name = $request->name;
    	$itemdetails->description = $request->description;
    	$itemdetails->price = $request->price;
    	$itemdetails->category_id = $request->category;

    	// IF EMPTY
    	if($request->file('image_path')!= null){
	    	$image=$request->file('image_path');
	    	$image_name = time().".".$image->getClientOriginalExtension();
	    	$destination = "images/";

	    	// image_path is a column name in the items_table
	    	$image->move($destination, $image_name);
	    	$itemdetails->image_path = "/".$destination.$image_name;
    	}

    	$itemdetails->save();
    	// return redirect("/catalog");
    	$categories = Category::all();
    	return view('items.item_details', compact("itemdetails", "categories"));

    }





}

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Item;
use App\Category;
use Session;
use App\Order;
use DB;
use Auth;

class ItemController extends Controller
{

	//ITEMS
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
    	Session::flash("deletemessage", "Item was succesfully deleted!");
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
    	Session::flash("successmessage", "Item was successfully updated!");
    	return view('items.item_details', compact("itemdetails", "categories"));

    }

    // CART
    public function addToCart($id, Request $request){

    	//if we have items on cart
    	if(Session::has("cart")){
    		$cart = Session::get("cart"); // get data from session cart
    	} else {
			$cart = []; //else, initialize cart
    	}

    	//if item on cart is already set
    	if(isset($cart[$id])) {
    		//add on existing quantity through array push
    		$cart[$id] += $request->quantity;
    	} else {
    		//create item with quantity
    		$cart[$id] = $request->quantity;
    	}

        //save item and quantity in cart session
    	//cart contains item id and its quantity
    	Session::put("cart", $cart);
    	Session::flash("successmessage", "Item added to cart!");
    	return redirect("/catalog");
    	
    }

    public function showCart(){
    	// dd(Session::get("cart"));

    	//create an array where you will push data from session cart -- item id & quantity
    	$item_cart = [];
    	if(Session::has('cart')){
    		$cart = Session::get('cart');
    		$total = 0;
    		foreach($cart as $id => $quantity){
    			$item = Item::find($id); //id from session cart
    			$item->quantity = $quantity; //quantity is not in the table but in session cart
    			$item->subtotal = $item->price * $quantity;//create subtotal
    			$total += $item->subtotal;
    			$item_cart[] = $item; // item in cart now contains id,name, description, price, image_path, category, quantity and subtotal
    		}
    	}

    	return view('items.cart_content', compact("item_cart", "total"));
    }

    public function deleteCartItem($taskid){

		Session::forget("cart.$taskid"); //same as $cart[$id]
		Session::flash("successmessage", "Item deleted from cart!");

		return redirect("/showcart");
	
    }

    public function clearCart(){
    	Session::forget("cart"); //same as $cart[$id]
		Session::flash("successmessage", "Cart has been deleted!");
		return redirect("/catalog");
    }

    public function updateItemQuantity($taskid, Request $request){
    	$cart = Session::get("cart");
    	$cart[$taskid] = $request->newquantity; //push new quantity to cart array;
		Session::put("cart", $cart);
    	return redirect("/showcart");
    	
    }


    public function checkout(){
        $order = new Order; //create order to get order id
        $order->user_id = Auth::user()->id; // get the user id
        $order->status_id = 1; //pending
        $order->total = 0; // for now since we haven't called cart yet
        $order->save();

        $cartitems = Session::get('cart');
        $total = 0; //initialize total
        foreach($cartitems as $item_id => $quantity){
            
            //items() method is from order.php public function items()
            //$order has the values of our newly created variable $order which contains order_id, user/-id, status_id and total
            $order->items()->attach($item_id, ['quantity' => $quantity]);

            $item = Item::find($item_id);
            $total += $item->price * $quantity;
        }

        $ordertotal = Order::find($order->id);
        $ordertotal->total = $total;
        $ordertotal->save(); 

    }

    public function showTransactions(){
        $orders = Order::all();
        return view('items.transaction', compact('orders'));
    }




}

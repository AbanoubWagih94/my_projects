<?php

namespace App\Http\Controllers\FrontControllers;

use App\Product;
use App\ShoppingCart;
use Illuminate\Support\Facades\Validator;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class CartController extends Controller
{
    public function index(){
        return view('front/cart/index');
    }

    public function store(Request $request){

        $dubl = Cart::search(function($cartItem, $rowId) use ($request){
            return $cartItem->id === $request->id;
        });

        if($dubl->isNotEmpty()){
            return redirect()->back()->with('msg', 'Item is already in your cart');
        }
        Cart::add($request->id, $request->name, 1, $request->price)->associate('App\Product');
        ShoppingCart::create([
            'identifier' => auth()->user()->id,
            'instance' => 'default',
            'content' => Cart::instance('default')->content()
        ]);
        return redirect()->back()->with('msg', 'Item has been add to cart');
    }

    public function destroy($id){
        Cart::remove($id);

        return redirect()->back()->with('msg', 'Item has been removed from cart');
    }

    public function update(Request $request ,$id){

        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|between: 1,5'
        ]);

        if($validator->fails()){
            session()->flash('err',' Quantity must be between 1 and 5');
            return response()->json(['success' => false]);
        }

        Cart::update($id, $request->quantity);
        Cart::instance('default')->restore(auth()->user()->id);
        session()->flash('msg','Quantity has been updated');
        return response()->json(['success' => true]);
    }

    public function saveLater($id){
        $item = Cart::get($id);
        Cart::remove($id);
        $dubl = Cart::instance('saveForLater')->search(function($cartItem, $rowId)use ($id){
            return $cartItem->id === $id;
        });
        if($dubl->isNotEmpty()){
            return redirect()->back()->with('msg', 'Item is already save for later');
        }

        Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price)->associate('App\Product');
        return redirect()->back()->with('msg', 'Item has been saved for later');
    }
}

<?php

namespace App\Http\Controllers\FrontControllers;

use App\Order;
use App\OrderItems;
use Carbon\Carbon;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;


class CheckoutController extends Controller
{
    public function index(){
        return view('front.checkout.index');
    }

    public function store(Request $request){

        $contents = Cart::instance('default')->content()->map(function ($item){
            return $item->model->name. ' ' . $item->qty;
        })->values()->toJson();
        try{
            $data = [
                'amount' => Cart::total(),
                'currency' => 'USD',
                'source' => $request->stripeToken,
                'description' => 'Some Text',
                'metadata' => [
                    'contents' => $contents,
                    'quantity' => Cart::instance('default')->count()
                ],
            ];

            Stripe::charges()->create($data);

            // Insert into order table
            $order = Order::create([
                'user_id' => auth()->user()->id,
                'date' => Carbon::now(),
                'address' => $request->address,
                'status' => 0
            ]);
            // Insert into order items table
            foreach (Cart::instance('default')->content() as $item){
                OrderItems::create([
                    'order_id' => $order->id,
                    'product_id' => $item->model->id,
                    'quantity' => $item->qty,
                    'price' => $item->price
                ]);
            }

            // Destroy items from card
            Cart::instance('default')->destroy();

            // Success
            return redirect()->back()->with('msg', 'Success Thank you');

        } catch (Exception $exception){
            //Code
        }
    }
}

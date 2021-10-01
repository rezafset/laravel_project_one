<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function cart($id){
        $product = Product::find($id);

        $cart = session()->has('cart') ? session()->get('cart') : [];

        if(key_exists($product->id, $cart)){
            $cart[$product->id]['quantity'] = $cart[$product->id]['quantity'] + 1;
        }else{
            $cart[$product->id] =[
                'product_id' => $product->id,
                'name' =>$product->name,
                'price' =>$product->price,
                'description' =>$product->description,
                'quantity' => 1,
            ];
        }
        session(['cart' => $cart]);
        Session::flash('message', 'Product Added Successfully!!');
        Session::flash('alert', 'success');
        return redirect()->back();
        // dd($cart);
    }
    public function show_cart(){
        $carts = session()->has('cart') ? session()->get('cart') : [];
        return view('frontend.cart', compact('carts'));
    }

    public function checkout(){
        $carts = session()->has('cart') ? session()->get('cart') : [];
        return view('frontend.checkout', compact('carts'));
    }

    public function order(Request $request){
        // dd($request->all());
        $order_data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'status' => 'pending',
            'truck_no' => auth()->user()->id.time(),
            'user_id' => auth()->user()->id,
        ];
        $carts = session()->has('cart') ? session()->get('cart') : [];
        // dd($order_data, $carts);
        $order = Order::create($order_data);
        // foreach ($carts as $cart) {
        //     dump($cart);
        // }
        // die();
        foreach ($carts as $cart) {
            OrderDetails::create([
                'order_id' => $order->id,
                'product_id' => $cart['product_id'],
                'product_name' =>$cart['name'],
                'product_price' =>$cart['price'],
                'quantity' => $cart['quantity']
            ]);
        }
        session()->forget('cart');
        return redirect()->route('customer.profile');
    }
}

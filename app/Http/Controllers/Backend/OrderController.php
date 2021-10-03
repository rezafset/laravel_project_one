<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::all();
        return view('backend_pages.order.index', compact('orders'));
    }

    public function show($id){
        $order = Order::where('id', $id)->with('details')->first();
        return view('backend_pages.order.show' , compact('order'));
    }
    public function update(Request $request, $id){
        $order = Order::find($id);
        $order->update([
            'status' => $request->input('status')
        ]);
        return redirect()->back();
    }
}

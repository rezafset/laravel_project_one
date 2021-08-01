<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('backend_pages.products.index', compact('products'));
    }

    public function create(){
        return view('backend_pages.products.create');
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ],[
            'name.required' => 'Please Enter Product Name!!!',
            'price.required' => 'Please Enter Product Price!!!',
            'description.required' => 'Please Enter Product Description!!!',
        ]);
        $data = [
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
        ];
        Product::create($data);

        return redirect()->route('admin.product')->with('success', 'Product Created Successfully!!');
    }
}

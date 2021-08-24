<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    // Show all data
    public function index(){
        $products = Product::all();
        return view('backend_pages.products.index', compact('products'));
    }
    // Create Data
    public function create(){
        return view('backend_pages.products.create');
    }
    // Store Data
    public function store(Request $request){
        // dd($request->all());

        try {

            $request->validate([
                'name' => 'required|min:4|max:100|regex:/^[a-zA-Z ]+$/',
                'price' => 'required|regex:/^[-0-9\+]+$/',
                'description' => 'required',
                'photo' => 'required|image|max:1024|mimes:png,jpg,jpeg',
            ],[
                'name.required' => 'Please Enter Product Name!!!',
                'price.required' => 'Please Enter Product Price!!!',
                'description.required' => 'Please Enter Product Description!!!',
                'photo.required' => 'Please Enter Product Image',
            ]);

            if($request->hasFile('photo')){

                $image = $request->file('photo');
                $newPhoto = 'product_'.time().'.'.$image->getClientOriginalExtension() ;
                $request->photo->move('Upload/Products/', $newPhoto);
                // dd($newPhoto);
                $data = [
                    'name' => $request->input('name'),
                    'price' => $request->input('price'),
                    'description' => $request->input('description'),
                    'photo' => $newPhoto,
                ];

                Product::create($data);
            }

            return redirect()->route('admin.product')->with('success', 'Product Created Successfully!!');

        } catch (Exception $exception) {

            $error = $exception->validator->getMessageBag();
            return redirect()->back()->withErrors($error)->withInput();
        }


    }
    // Show Specific Data
    public function show($id){
        $product = Product::find($id);
        return view('backend_pages.products.show', compact('product'));
    }
    // Edit data
    public function edit($id){
        $product = Product::find($id);
        return view('backend_pages.products.edit', compact('product'));
    }
    // Update data
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ],[
            'name.required' => 'Please Enter Product Name!!!',
            'price.required' => 'Please Enter Product Price!!!',
            'description.required' => 'Please Enter Product Description!!!',
        ]);

        $product = Product::find($id);

        if($request->hasFile('photo')){

            $destination = 'Upload/Products/'.$product->photo;

            if(File::exists($destination)){

                File::delete($destination);
            }

            $image = $request->file('photo');
            $newImage = 'product_'.time().'.'.$image->getClientOriginalExtension();
            $image->move('Upload/Products', $newImage);
            $data = [
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'description' => $request->input('description'),
                'photo' => $newImage,
            ];
            $product->update($data);
        }

        return redirect()->route('admin.product')->with('update', 'Product Updated Successfully');
    }
    // Delete Data
    public function delete($id){
        $product = Product::find($id);
        $destination = 'Upload/Products/'.$product->photo;

        if(File::exists($destination)){
            File::delete($destination);
        }
        $product->delete();
        return redirect()->back()->with('delete', 'Product Deleted Successfully');
    }
}

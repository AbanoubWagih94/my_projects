<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create(){
        return view('admin.products.create');
    }

    public function store(Request $request){
        // validate the form
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'image|required'
        ]);

        // upload the image
        if($request->hasFile('image'))
        {
            $image = $request->image;
            $image->move('uploads', $image->getClientOriginalName());
        }

        // Save data into database
        Product::create([
            'name'=> $request->name,
            'price'=> $request->price,
            'description'=> $request->description,
            'image_url'=> $request->image->getClientOriginalName()
        ]);

        // Sessions Message
        $request->session()->flash('msg', 'Your product has been added');

        // Redirect
        return redirect('admin/products/create');
    }

    public function show($id){
        $product = Product::find($id);
        return view('admin.products.details', compact('product'));
    }

    public function edit($id){
        $product = Product::find($id);

        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id){
        $product = Product::find($id);
        // Validate form
         $request->validate([
             'name' => 'required',
             'price' => 'required',
             'description' => 'required'
         ]);

        // Check if there is any image

        if($request->hasFile('image')){
            if(file_exists(public_path('uploads/') . $product->image_url)){
                unlink('uploads/' . $product->image_url);
            }

            // Add new image
            $image = $request->image;
            $image->move('uploads/', $image->getClientOriginalName());
            $product->image_url = $image->getClientOriginalName();
        }


        // Updating the product
        $product->update([
            'name'=> $request->name,
            'price'=> $request->price,
            'description'=> $request->description,
            'image_url'=> $product->image_url
        ]);

        // session msg
        session()->flash('msg', 'Product has been updated');

        //redirect

        return redirect('admin/products');
    }


    public function destroy($id){
        // Destroy product
        Product::destroy($id);

        // Destroy message
        session()->flash('msg', 'Product has been deleted');

        // Redirect
        return redirect('admin/products');
    }
}

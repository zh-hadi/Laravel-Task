<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        return view('products.index', [
            'products' => Product::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name' => ['required'],
            'description' => ['required'],
            'price' => ['required'],
            'image' => ['required'],
        ]);

        $image = request()->file('image');
        $imagePath = $image->store('products');

        $attributes['image'] = $imagePath;

        Product::create($attributes);

        return redirect(route('products.index'));
    }

  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', [
            'product' => $product
        ]);
    }   

    /**
     * Update the specified resource in storage.
     */
    public function update(Product $product)
    {
        $attributes = request()->validate([
            'name' => ['required'],
            'description' => ['required'],
            'price' => ['required'],
        ]);

        if(request()->file('image')){
            $imagePath = public_path('storage/'.$product->image);
            if(file_exists($imagePath)){
                unlink($imagePath);
            }
            $image = request()->file('image');
            $imagePath = $image->store('private');

            $product->image = $imagePath;
        }

        $product->name = request()->name;
        $product->description = request()->description;
        $product->price = request()->price;

        $product->save();

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $imagePath = public_path('storage/'.$product->image);

        
        $product->delete();
        
        if(file_exists($imagePath)){
            unlink($imagePath);
        }

        return redirect()->back();
    }
}

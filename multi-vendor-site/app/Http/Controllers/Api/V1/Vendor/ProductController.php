<?php

namespace App\Http\Controllers\Api\V1\Vendor;


use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\ProductRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json([
            'products' => Product::all()
        ]);
    }


    public function store(ProductRequest $request):JsonResponse
    {
        $image = request()->file('image');
        if($image){
            $path = $image->store('products');
        }



        $attributes = [
            ...$request->toArray(),
            'image' => $path,
            'vendor_id' => Auth::user()->vendor->id
        ];


        Product::create($attributes);

        return response()->json([
            'message' => 'product add successfully',
        ]);
    }

    public function show(Product $product)
    {
        return response()->json([
            'products' => $product
        ]);
    }


    public function update(ProductRequest $request, Product $product): JsonResponse
    {
        unset($request['_method']);

        if(request()->image){
            $image = request()->file('image');
            $imagePath = $image->store('products');

            $old_image_path = $product->image;
            $path = public_path("storage/". $product->image);

            if(file_exists($path)){
                unlink($path);
            }
        }
        
        $attributes = [
            ...$request->toArray(),
            'image' => $imagePath
        ];

        $product->update($attributes);

        return response()->json([
            'message' => 'Product update successfully'
        ]);
        
    }

    public function destroy(Product $product): JsonResponse
    {
        $imagePath = public_path("storage/".$product->image);
        if(file_exists($imagePath)){
            unlink($imagePath);
        }

        $product->delete();

        return response()->json([
            'message' => 'product delete successfully'
        ]);
    }
}

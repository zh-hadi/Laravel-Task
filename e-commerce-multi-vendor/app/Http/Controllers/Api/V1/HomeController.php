<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return  ProductResource::collection(Product::with('category')->paginate(20));
    }

    public function show(Product $product)
    {
        return new ProductResource($product->load('category'));
    }


    public function categroy_index()
    {
        //$category = Category::withCount('product')
        $category = Category::withCount('products')->get();
        return CategoryResource::collection($category);
    }

    public function category_show(Category $catagory)
    {
        $category = $catagory->load('products');
        $catagory = $catagory->loadCount('products');
        return new CategoryResource($catagory);
    }
}

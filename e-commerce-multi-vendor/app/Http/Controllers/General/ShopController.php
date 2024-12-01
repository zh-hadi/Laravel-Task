<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shop_view(){
        $categories = Category::all();
        $products = Product::paginate(15);
        $category_id_arr =[];
        return view('general.shop',compact('categories','products','category_id_arr'));
    }

    public function shop_q(Request $request){
        $categories = Category::all();
        $category_ids = $request->category_ids;

        if($category_ids){
            $category_id_arr = explode(",",$category_ids);
            if(count($category_id_arr)>1){
                $products = Product::whereIn('category_id',$category_id_arr)->paginate(15);
            }
            else{
                $category_id_arr =[$category_ids];
                $products = Product::where('category_id',$category_ids)->paginate(15);
            }
        }
        else{
            $category_id_arr =[];
            $products = Product::paginate(15);
        }

        return view('general.shop',compact('categories','products','category_id_arr'));
    }
}

<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function shop_view(){
        $categories = Category::all();
        $category_id_arr =[];
        $products = DB::table('products')
                        ->join('categories','products.category_id','=','categories.id')
                        ->select('categories.name as c_name','products.name as p_name','products.*')
                        ->paginate(15);
        return view('general.shop',compact('categories','products','category_id_arr'));
    }

    public function shop_q(Request $request){
        $categories = Category::all();
        $category_ids = $request->category_ids;

        if($category_ids){
            $category_id_arr = explode(",",$category_ids);
            if(count($category_id_arr)>1){
                $products = DB::table('products')
                        ->join('categories','products.category_id','=','categories.id')
                        ->select('categories.name as c_name','products.name as p_name','products.*')
                        ->whereIn('products.category_id',$category_id_arr)
                        ->paginate(15);
            }
            else{
                $category_id_arr =[$category_ids];
                $products = DB::table('products')
                        ->join('categories','products.category_id','=','categories.id')
                        ->select('categories.name as c_name','products.name as p_name','products.*')
                        ->where('products.category_id',$category_ids)
                        ->paginate(15);
                //$products = Product::where('category_id',$category_ids)->paginate(15);
            }
        }
        else{
            $category_id_arr =[];
            $products = DB::table('products')
                        ->join('categories','products.category_id','=','categories.id')
                        ->select('categories.name as c_name','products.name as p_name','products.*')
                        ->paginate(15);

        }

        return view('general.shop',compact('categories','products','category_id_arr'));
    }

    
}

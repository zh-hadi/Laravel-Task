<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function shop_view(){
        $categories = Category::all();
        $category_id_arr =[];
        $products = DB::table('products')
                        ->join('categories','products.category_id','=','categories.id')
                        ->select('categories.name as c_name','products.name as p_name','products.*')
                        ->paginate(6);
        $user_id = Auth::user()->id;
        return view('general.shop',compact('categories','products','category_id_arr','user_id'));
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
                        ->paginate(6);
            }
            else{
                $category_id_arr =[$category_ids];
                $products = DB::table('products')
                        ->join('categories','products.category_id','=','categories.id')
                        ->select('categories.name as c_name','products.name as p_name','products.*')
                        ->where('products.category_id',$category_ids)
                        ->paginate(6);
                //$products = Product::where('category_id',$category_ids)->paginate(15);
            }
        }
        else{
            $category_id_arr =[];
            $products = DB::table('products')
                        ->join('categories','products.category_id','=','categories.id')
                        ->select('categories.name as c_name','products.name as p_name','products.*')
                        ->paginate(6);

        }
        $user_id = Auth::user()->id;
        return view('general.shop',compact('categories','products','category_id_arr','user_id'));
    }

    public function shop_checkout(){
        $user_id = Auth::user()->id;
        $cart = Cart::where('user_id',$user_id)->get();
        $cart_item = CartItem::where('cart_id',$cart[0]->id)->get();
        $cart_arr = array();
        foreach($cart_item as $item){
            $product = Product::where('id',$item->product_id)->get();
            $cart_temp_arr = array();
            array_push($cart_temp_arr,$cart[0]->id);
            array_push($cart_temp_arr,$user_id);
            array_push($cart_temp_arr,$item->product_id);
            array_push($cart_temp_arr,$item->quantity);
            array_push($cart_temp_arr,$product[0]->name);
            array_push($cart_temp_arr,$product[0]->price);
            array_push($cart_temp_arr,$product[0]->image);
            
            array_push($cart_arr,$cart_temp_arr);
            //$cart_arr["cart_".$item->id] = $cart_temp_arr;
        }
        //$msg = ['msg'=>'Cart Item Added'];
        //return json_encode($cart_arr);
        return view('general.shop_checkout',compact('cart_arr','user_id'));
    }

    
}

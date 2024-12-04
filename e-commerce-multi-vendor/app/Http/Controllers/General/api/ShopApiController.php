<?php

namespace App\Http\Controllers\General\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\CartDeleteRequest;
use App\Http\Requests\Shop\CartInfoRequest;
use App\Http\Requests\Shop\CartSaveRequest;
use App\Http\Requests\Shop\CartUpdateRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopApiController extends Controller
{
    public function cart_save(CartSaveRequest $request){

        $cart_attributes = [
            'user_id'=> $request->user_id
        ];
        
        $cart_check = Cart::where('user_id', $request->user_id)->get();
        //return $cart_check;
        if(count($cart_check)>0){
            
            $cart_id = $cart_check[0]->id;
        }
        else{
            $cart = Cart::create($cart_attributes);
            $cart_id = $cart->id;
        }
        
        $cart_item_attributes = [
            'cart_id'=> $cart_id,
            'product_id'=> $request->product_id,
            'quantity'=> $request->quantity
        ];

        CartItem::create($cart_item_attributes);

        $msg = ['msg'=>'Cart Item Added'];
        return response()->json($msg);
        
    }

    public function cart_update(CartUpdateRequest $request){
        $cart = Cart::where('user_id',$request->user_id)->get();

        CartItem::where('cart_id',$cart[0]->id)
                ->where('product_id',$request->product_id)
                ->update([ 
                    'quantity' => $request->quantity
        ]);
        $msg = ['msg'=>'Cart Item Updated'];
        return response()->json($msg);
    }

    public function cart_delete(CartDeleteRequest $request){
        $cart = Cart::where('user_id',$request->user_id)->get();
        $cart_item = CartItem::where('cart_id',$cart[0]->id)
                            ->where('product_id',$request->product_id);
        $cart_item->delete();
        $msg = ['msg'=>'Cart Item Deleted'];
        return response()->json($msg);
    }

    public function cart_info(CartInfoRequest $request){
        $cart = Cart::where('user_id',$request->user_id)->get();
        $cart_item = CartItem::where('cart_id',$cart[0]->id)->get();
        $cart_arr = array();
        foreach($cart_item as $item){
            $product = Product::where('id',$item->product_id)->get();
            $cart_temp_arr = array();
            // $cart_temp_arr["cart_id"] = $cart[0]->id;
            // $cart_temp_arr["user_id"] = $request->user_id;
            // $cart_temp_arr["product_id"] = $item->product_id;
            // $cart_temp_arr["quantity"] = $item->quantity;
            // $cart_temp_arr["price"] = $product[0]->price;
            // $cart_temp_arr["image"] = $product[0]->image;
            array_push($cart_temp_arr,$cart[0]->id);
            array_push($cart_temp_arr,$request->user_id);
            array_push($cart_temp_arr,$item->product_id);
            array_push($cart_temp_arr,$item->quantity);
            array_push($cart_temp_arr,$product[0]->price);
            array_push($cart_temp_arr,$product[0]->image);
            array_push($cart_arr,$cart_temp_arr);
            //$cart_arr["cart_".$item->id] = $cart_temp_arr;
        }
        //$msg = ['msg'=>'Cart Item Added'];
        //return json_encode($cart_arr);
        return $cart_arr;
    }
}

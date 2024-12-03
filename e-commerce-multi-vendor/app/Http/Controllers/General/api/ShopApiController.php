<?php

namespace App\Http\Controllers\General\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\CartDeleteRequest;
use App\Http\Requests\Shop\CartSaveRequest;
use App\Http\Requests\Shop\CartUpdateRequest;
use App\Models\Cart;
use App\Models\CartItem;
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
        $cart_item = CartItem::where('cart_id',$cart[0]->id)->get();
        $cart_item->quantity = $request->input('quantity'); 
        $cart_item->save();
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
}

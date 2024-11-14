<?php

namespace App\Http\Controllers\Admin\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminProductApiController extends Controller
{
    public function products(){
        //return Hash::make('showmen123');
        $products = DB::table('products')
                        ->join('orders','products.id','=','orders.product_id')
                        ->select('products.*',DB::raw('count(orders.id) as sale_count'))
                        ->groupBy('products.id')
                        ->get();

        if($products){
            return response()->json($products);
        }
        else{
            $msg = ['error'=>'No Vendor Found'];
            return response()->json($msg);
        }
    }
}

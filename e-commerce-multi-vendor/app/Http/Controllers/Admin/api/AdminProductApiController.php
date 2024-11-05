<?php

namespace App\Http\Controllers\Admin\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminProductApiController extends Controller
{
    public function products(){
        $products = DB::table('orders')
                        ->join('products','products.id','=','orders.product_id')
                        ->select('products.*',DB::raw('count(orders.id) as sale_count'))
                        ->groupBy('orders.id')
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

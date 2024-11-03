<?php

namespace App\Http\Controllers\Admin\api;

use App\Http\Controllers\Controller;
use App\Models\Vendors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminVendorApiController extends Controller
{
    public function vendor_list(){

        $vendors = DB::table('vendors')
                        ->join('products','products.user_id','=','vendors.id')
                        ->select('vendors.*',DB::raw('count(products.user_id) as total_product'))
                        ->groupBy('products.user_id')
                        ->get();
        if($vendors){
            return response()->json($vendors);
        }
        else{
            $msg = ['error'=>'No Vendor Found'];
            return response()->json($msg);
        }
    }

    public function active_vendor_list(){
        
        $vendors = Vendors::where('status','active')->get();
        if($vendors){
            return response()->json($vendors);
        }
        else{
            $msg = ['error'=>'No Vendor Found'];
            return response()->json($msg);
        }
        
    }
}

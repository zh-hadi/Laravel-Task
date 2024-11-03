<?php

namespace App\Http\Controllers\Admin\api;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminVendorApiController extends Controller
{
    public function vendor_list(){

        $vendors = DB::table('vendors')
                        ->join('products','products.vendor_id','=','vendors.id')
                        ->select('vendors.*',DB::raw('count(products.vendor_id) as total_product'))
                        ->groupBy('products.vendor_id')
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
        
        $vendors = Vendor::where('status','active')->get();
        if($vendors){
            return response()->json($vendors);
        }
        else{
            $msg = ['error'=>'No Vendor Found'];
            return response()->json($msg);
        }
        
    }
}

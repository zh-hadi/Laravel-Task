<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VendorListRequest;
use App\Models\Vendor;
use Illuminate\Http\Request;

class AdminVendorController extends Controller
{
    public function vendor_list(){
        $vendors = Vendor::all();
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
        //$vendors = Vendor::all();
        if($vendors){
            return response()->json($vendors);
        }
        else{
            $msg = ['error'=>'No Vendor Found'];
            return response()->json($msg);
        }
        
    }
}

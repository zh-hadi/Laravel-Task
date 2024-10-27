<?php

namespace App\Http\Controllers\Api\V1\Vendor;

use App\Models\Vendor;
use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    
    public function store(VendorRequest $request)
    {
        $attributes = [
            ...$request->toArray(),
            'user_id' => Auth::user()->id,
        ];

        $vendor = Vendor::create($attributes);


        return response()->json([
            'message' => "vendor account create successfully"
        ]);
    }


    public function show(Vendor $vendor)
    {
        return response()->json([
            'vendor' => $vendor
        ]);
    }
    
}

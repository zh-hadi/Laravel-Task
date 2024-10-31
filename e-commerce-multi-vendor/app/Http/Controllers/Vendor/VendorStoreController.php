<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorStoreController extends Controller
{
    public function manage()
    {
        return view('vendor.store.manage');
    }
}

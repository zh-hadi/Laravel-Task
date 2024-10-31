<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductAttributesController extends Controller
{
    public function create()
    {
        return view('admin.productattributes.create');
    }

    public function manage()
    {
        return view('admin.productattributes.manage');
    }
}

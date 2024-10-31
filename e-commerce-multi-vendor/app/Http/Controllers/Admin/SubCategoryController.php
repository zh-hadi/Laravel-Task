<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function create()
    {
        return view('admin.subCategory.create');
    }

    public function manage()
    {
        return view('admin.subCategory.manage');
    }
}

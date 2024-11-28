<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shop_view(){
        $categories = Category::all();

        return view('general.shop',compact('categories'));
    }

    public function shop_q(Request $request){
        $categories = Category::all();

        return view('general.shop',compact('categories'));
    }
}

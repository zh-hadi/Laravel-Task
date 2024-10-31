<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminMainController extends Controller
{
    public function index()
    {
        return view('admin.admin');
    }

    public function setting()
    {
        return view('admin.setting');
    }

    
    public function manage_user()
    {
        return view('admin.user.manage');
    }

    public function manage_vendor()
    {
        return view('admin.vendor.manage');
    }
    public function manage_stores()
    {
        return view('admin.store.manage');
    }
    
    public function cart_history()
    {
        return view('admin.cart.history');
    }
    public function order_history()
    {
        return view('admin.order.history');
    }
}

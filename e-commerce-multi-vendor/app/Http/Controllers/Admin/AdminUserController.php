<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function manage_user()
    {
        $users = User::all();
        return view('admin.user.manage',compact('users'));
    }
}

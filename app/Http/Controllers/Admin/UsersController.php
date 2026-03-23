<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class UsersController extends Controller
{
    public function users(){
        $users = User::where('is_admin', '0')->paginate(15);
        return view('admin.user.user_list', compact('users'));
    }
}

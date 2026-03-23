<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class MyaccountController extends Controller
{
    public function index(){
        $user_details = Auth::user();
        return view('admin.myaccount', compact('user_details'));
    }
    public function update_profile(Request $request){
        $request->validate([
            'admin_img' => 'image|mimes:jpeg,png,jpg,webp|max:500',
            'name' => 'required',
            'email' => 'required',
        ]);

        if($request->hasFile('admin_img')){
            $filenameWithExt = $request->file('admin_img')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('admin_img')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $admin_img_path = $request->file('admin_img')->storeAs('public/images',$fileNameToStore);
            $input['admin_img']=$fileNameToStore;
        }
        $input['name'] = $request->name;
        $input['email']=$request->email;

        $user = User::where('id', Auth::user()->id)->update($input);
        if($user){
            return redirect('admin/my-account')->with('success', 'Profile updated successfully');  
        }else{
            return redirect()->back()->with('error', 'Something went wrong please try again after sometime');  
        }

    }

    public function changepassword(Request $request){
        $request->validate([
            'password' => 'required',
            'confirm_password' => 'required',
        ]);

        $input['password'] = bcrypt($request->confirm_password);

        $user = User::where('id', Auth::user()->id)->update($input);

        if($user){
            return redirect('admin/my-account')->with('success', 'Password changed successfully');  
        }else{
            return redirect()->back()->with('error', 'Something went wrong please try again after sometime');  
        }

    }
}

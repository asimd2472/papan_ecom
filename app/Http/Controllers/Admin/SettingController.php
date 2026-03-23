<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\State;
use App\Models\Coupon;
use App\Models\ProductCategory;

class SettingController extends Controller
{
    public function setting(){
        $setting = Setting::first();
        $state = State::where('country_id', '233')->get();
        return view('admin.setting', compact('setting', 'state'));
    }

    public function save_setting(Request $request){

        $request->validate([
            // 'site_logo' => 'image|mimes:jpeg,png,jpg,webp|max:500',
        ]);

        // if($request->hasFile('site_logo')){
        //     $filenameWithExt = $request->file('site_logo')->getClientOriginalName();
        //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //     $extension = $request->file('site_logo')->getClientOriginalExtension();
        //     $fileNameToStore = $filename.'_'.time().'.'.$extension;
        //     $site_logo_path = $request->file('site_logo')->storeAs('public/images',$fileNameToStore);
        //     $input['site_logo']=$fileNameToStore;
        // }
        // $input['contact_email'] = $request->contact_email;
        // $input['contact_phone'] = $request->contact_phone;
        // $input['contact_address'] = $request->contact_address;
        // $input['facebook_url'] = $request->facebook_url;
        // $input['youtube_url'] = $request->youtube_url;
        // $input['googlemaplink'] = $request->googlemaplink;


        $input['from_address'] = $request->from_address;
        $input['from_city'] = $request->from_city;
        $input['from_state'] = $request->from_state;
        $input['from_zip'] = $request->from_zip;

        $setting = Setting::first();

        if(empty($setting)){
            $setting = Setting::create($input);
            if($setting){
                return redirect()->back()->with('success', 'Setting saved successfully');
            }else{
                return redirect()->back()->with('error', 'Something went wrong please try again after sometime');
            }
        }else{
            $setting = Setting::where('id', $request->id)->update($input);
            if($setting){
                return redirect()->back()->with('success', 'Setting updated successfully');
            }else{
                return redirect()->back()->with('error', 'Something went wrong please try again after sometime');
            }
        }

    }

    public function save_tax(Request $request){

        $request->validate([
            'services_tax' => 'required',
        ]);

        $input['services_tax'] = $request->services_tax;

        $setting = Setting::where('id', '1')->update($input);
        if($setting){
            return redirect()->back()->with('success', 'Tax updated successfully');
        }else{
            return redirect()->back()->with('error', 'Something went wrong please try again after sometime');
        }


    }

    public function coupon(){

        $coupon = Coupon::orderby('id', 'desc')->get();
        return view('admin.coupon.index', compact('coupon'));
    }

    public function create_coupon(){
        $productcategory = ProductCategory::orderBy('id', 'DESC')->get();
        return view('admin.coupon.create', compact('productcategory'));
    }

    public function save_coupon(Request $request){

        $request->validate([
            'coupon_category' => 'required',
            'coupon_discount' => 'required',
            'coupon_code' => 'required',
        ]);

        $input['coupon_discount'] = $request->coupon_discount;
        $input['coupon_code'] = $request->coupon_code;

        $input['coupon_category'] = implode(',', $request->input('coupon_category'));

        if($request->id==''){
            $brand = Coupon::create($input);
            if($brand){
                return redirect()->back()->with('success', 'Coupon saved successfully');
            }else{
                return redirect()->back()->with('error', 'Something went wrong please try again after sometime');
            }
        }else{
            $brand = Coupon::where('id', $request->id)->update($input);
            if($brand){
                return redirect()->back()->with('success', 'Coupon updated successfully');
            }else{
                return redirect()->back()->with('error', 'Something went wrong please try again after sometime');
            }
        }

    }

    public function edit_coupon($id){
        $coupon = Coupon::where('id', $id)->first();
        $productcategory = ProductCategory::orderBy('id', 'DESC')->get();
        return view('admin.coupon.edit', compact('coupon', 'productcategory'));
    }

    public function delete_coupon($id){
        Coupon::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Coupon Delete successfully.');
    }

}

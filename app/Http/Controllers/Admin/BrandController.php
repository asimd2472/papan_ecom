<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\EmailsubscriptionTrait;
use Carbon\Carbon;

class BrandController extends Controller
{
    public function index(){
        $brand = Brand::orderBy('id', 'DESC')->paginate(15);
        return view('admin.brand.index', compact('brand'));
    }

    public function save_brand(Request $request){

        $request->validate([
            'brandimage' => 'image|mimes:jpeg,png,jpg,webp|max:500',
            'brandname' => 'required',
        ]);

        if($request->hasFile('brandimage')){
            $filenameWithExt = $request->file('brandimage')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('brandimage')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $brandimage_path = $request->file('brandimage')->storeAs('public/images',$fileNameToStore);
            $input['brandimage']=$fileNameToStore;
        }
        $input['brandname'] = $request->brandname;
        if($request->id==''){
            $brand = Brand::create($input);
            if($brand){
                return redirect()->back()->with('success', 'Brand saved successfully');
            }else{
                return redirect()->back()->with('error', 'Something went wrong please try again after sometime');
            }
        }else{
            $brand = Brand::where('id', $request->id)->update($input);
            if($brand){
                return redirect()->back()->with('success', 'Brand updated successfully');
            }else{
                return redirect()->back()->with('error', 'Something went wrong please try again after sometime');
            }
        }

    }

    public function delete_brand($id){
        Brand::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Brand Delete successfully.');
    }
}

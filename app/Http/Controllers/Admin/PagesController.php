<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryLocations;
use Illuminate\Http\Request;

use App\Models\Pages;

class PagesController extends Controller
{
    public function home_page(){
        $pages = Pages::where('id', 1)->first();
        return view('admin.pages.home', compact('pages'));
    }

    public function save_home_page(Request $request){

        // dd($request->all());
        if($request->hasFile('banner_image')){
            $filenameWithExt = $request->file('banner_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('banner_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $banner_image_path = $request->file('banner_image')->storeAs('public/images',$fileNameToStore);
            $input['banner_image']=$fileNameToStore;
        }


        
        
        if($request->hasFile('about_image')){
            $filenameWithExt = $request->file('about_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('about_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $about_image_path = $request->file('about_image')->storeAs('public/images',$fileNameToStore);
            $input['about_image']=$fileNameToStore;
        }

        $input['about']=$request->about;
        $input['about_title']=$request->about_title;

        // dd($request->id);
        if($request->id==null){
            $page = Pages::where('id', 1)->create($input);
        }else{
            $page = Pages::where('id', 1)->update($input);
        }
        
        // dd($page);

        return redirect()->back()->with('success', 'Page updated successfully');

    }

    public function delivery_locations(){
        $delivery_locations = DeliveryLocations::get();
        return view('admin.delivery_locations.index', compact('delivery_locations'));
    }

    public function create_delivery_locations(){
        return view('admin.delivery_locations.create');
    }

    public function save_location(Request $request){
        $input['location']=$request->location;
        $input['charges']=$request->charges;

        if($request->id==null){
            DeliveryLocations::create($input);
            return redirect()->back()->with('success', 'Location Added successfully');
        }else{
            DeliveryLocations::where('id', $request->id)->update($input);
            return redirect()->back()->with('success', 'Location Updated successfully');
        }
        
    }

    public function edit_location($id){
        $deliveryLocations = DeliveryLocations::where('id', $id)->first();
        return view('admin.delivery_locations.edit', compact('deliveryLocations'));
    }

    public function delete_location($id){
        DeliveryLocations::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Location Deleted successfully');    
    }
    

    
}
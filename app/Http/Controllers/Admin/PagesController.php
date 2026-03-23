<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
}
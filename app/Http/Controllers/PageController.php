<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customroduser;
use Mail;


class PageController extends Controller
{
    public function privacy_policy(){
        $title = '';
        return view('pages.privacy_policy', compact('title'));
    }

    public function shipping_and_return(){
        $title = '';
        return view('pages.shipping_and_return', compact('title'));
    }

    public function terms_and_condition(){
        $title = '';
        return view('pages.terms_and_condition', compact('title'));
    }

    public function customrodsave(Request $request){

        $input['name']=$request->name;
        $input['email']=$request->email;
        $input['requirement']=$request->requirement;

        $customroduser = Customroduser::create($input);

        $adminemail = 'asimd2472@gmail.com';

        $mailsend = \Mail::send('emails.customrodemail', ['input' => $input], function($message) use($adminemail){
            $message->to($adminemail);
            $message->subject('Custom Rods Requirement details');
        });

        if($mailsend){
            return response()->json([
                'status' => 1,
                'msg' => 'Thank you for connecting us we will get back to you shortly',
            ]);
        }else{
            return response()->json([
                'status' => 0,
                'msg' => 'Something want wrong please try again',
            ]);
        }

    }

}

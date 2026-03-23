<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

use App\Models\Payment;
use App\Models\OrderDetails;
use App\Models\Order;
use App\Models\UpsShipment;
use App\Helpers\Helper;
use App\Models\User;
use Illuminate\Support\Str;


class MyaccountController extends Controller
{
    public function login(){
        $title = '';

        return view('login', compact('title'));
    }
    public function signup(){
        $title = '';

        return view('signup', compact('title'));
    }

    public function logincheck(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $authenticated = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'status' => function ($query) {
                $query->where('status', '1');
            }
        ]);

        if ($authenticated) {
            $request->session()->regenerate();
            Session::put('user_session', Auth::user());

            return response()->json([
                'status' => 1,
                'msg' => 'login success',
            ]);
        }

        return response()->json([
            'status' => 0,
            'msg' => 'The provided credentials do not match our records.',
        ]);

    }
    public function user_dashboard(){
        $title = '';

        return view('user.user_dashboard', compact('title'));
    }
    public function edit_account(){
        $title = '';

        return view('user.edit_account', compact('title'));
    }

    public function order_history(){
        $title = '';

        $user_id = Session::get('user_session')->id;

        $order_details = Order::where('user_id', $user_id)->orderBy('id', 'DESC')->get();

        return view('user.order_history', compact('title', 'order_details'));
    }

    public function order_details($order_id){
        $title = '';

        $user_id = Session::get('user_session')->id;

        $order_details = Order::where('id', $order_id)->where('user_id', $user_id)->first();

        $upsShipment = UpsShipment::where('order_id', $order_id)->get();

        return view('user.order_details', compact('title', 'order_details', 'upsShipment'));
    }


    public function user_logout(){
        Auth::logout();
        Session::forget('user_session');
        return redirect('/');
    }

    public function cancel_order(Request $request){

        $order_id = $request->order_id;
        $accessToken = Helper::getUpstoken();


        if($accessToken==0){
            return response()->json([
                'status' => 0,
                'msg' => "Something went wrong please try after sometime",
            ]);die;
        }

        $upsShipment = UpsShipment::where('order_id', $order_id)->get();

        foreach ($upsShipment as $key => $value) {


            $version = "v1";
            $shipmentidentificationnumber = $value->shipmentIdentificationNumber;
            $query = array(
            "trackingnumber" => $value->trackingNumber,
            );

            $curl = curl_init();

            curl_setopt_array($curl, [
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer " . $accessToken,
                "transId: string",
                "transactionSrc: testing"
            ],
            CURLOPT_URL => env('Ups_Url')."/api/shipments/" . $version . "/void/cancel/" . $shipmentidentificationnumber . "?" . http_build_query($query),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "DELETE",
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);

            curl_close($curl);

            // echo "<pre>";
            // print_r(json_decode($response));exit;

            if ($error) {
                echo "cURL Error #:" . $error;
            } else {

                $voidShipmentResponse = json_decode($response);
                if (isset($voidShipmentResponse->VoidShipmentResponse->Response->ResponseStatus->Description)) {
                    $statusDescription = $voidShipmentResponse->VoidShipmentResponse->Response->ResponseStatus->Description;

                    if ($statusDescription === 'Success') {
                        Order::where('id', $order_id)->update(['current_status' => 'Cancel']);
                        OrderDetails::where('order_id', $order_id)->update(['current_status' => 'Cancel']);
                        UpsShipment::where('order_id', $order_id)->update(['current_status' => 'Cancel']);

                    }
                }
            }

        }


        return response()->json([
            'status' => 1,
            'msg' => "",
        ]);
    }

    public function track_order(){

        $accessToken = Helper::getUpstoken();
        if($accessToken==0){
            return response()->json([
                'status' => 0,
                'msg' => "Something went wrong please try after sometime",
            ]);die;
        }

        $upsShipmentsNotCancelled = UpsShipment::where('current_status', '<>', 'Cancel')->get();

        // dd($upsShipmentsNotCancelled);

        foreach ($upsShipmentsNotCancelled as $key => $value) {

            $inquiryNumber = $value->trackingNumber;
            $query = array(
            "locale" => "en_US",
            "returnSignature" => "false",
            "returnMilestones" => "false"
            );

            $curl = curl_init();

            curl_setopt_array($curl, [
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer " . $accessToken,
                "transId: string",
                "transactionSrc: testing"
            ],
            CURLOPT_URL => env('Ups_Url')."/api/track/v1/details/" . $inquiryNumber . "?" . http_build_query($query),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "GET",
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);
            curl_close($curl);

            // echo "<pre>";
            // print_r(json_decode($response));exit;

            if ($error) {
            echo "cURL Error #:" . $error;
            } else {
            // echo $response;

                $trackingData = json_decode($response);
                $currentStatus = $trackingData->trackResponse->shipment[0]->package[0]->currentStatus;
                $description = $currentStatus->description;
                $code = $currentStatus->code;

                if($description=='Shipment Canceled'){
                    $description = 'Cancel';
                }

                UpsShipment::where('trackingNumber', $inquiryNumber)->update([
                    'current_status'=>$description,
                ]);

                OrderDetails::where('trackingNumber', $inquiryNumber)->update([
                    'current_status'=>$description,
                ]);

                Order::where('id', $value->order_id)->update([
                    'current_status'=>$description,
                ]);


            }

        }
    }

    public function change_password(){
        $title = '';

        return view('user.change_password', compact('title'));
    }

    public function user_changepassword(Request $request){

        User::where('id', Session::get('user_session')->id)->update([
            'password'=>bcrypt($request->confirm_user_password),
        ]);

        return response()->json([
            'status' => 1,
            'msg' => "Password change successfully",
        ]);

    }

    public function user_resetpassword(Request $request){

        $user_check = User::where('email', $request->user_email)->first();
        if(empty($user_check)){
            return response()->json([
                'status' => 0,
                'msg' => "Email not register with us",
            ]);
        }else{
            $new_password = Str::random(6);

            $mailsend = \Mail::send('emails.reset_password', ['new_password'=>$new_password, 'user_name'=> $user_check->name], function($message) use($user_check){
                $message->to($user_check->email);
                $message->subject('Reset Password');
            });

            if($mailsend){
                User::where('id', $user_check->id)->update([
                    'password'=>bcrypt($new_password),
                ]);
                return response()->json([
                    'status' => 1,
                    'msg' => "Password reset successfully please check your Email.",
                ]);
            }else{
                return response()->json([
                    'status' => 0,
                    'msg' => "Something went wrong please try again after sometime",
                ]);
            }



        }
    }


}

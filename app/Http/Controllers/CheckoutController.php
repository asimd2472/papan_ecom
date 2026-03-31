<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use Session;

use App\Models\UserShippingAddress;
use App\Models\UserBillingAddress;
use App\Models\User;

use App\Models\Payment;
use App\Models\OrderDetails;
use App\Models\Order;
use Str;
use App\Models\Countries;
use Mail;
use App\Helpers\Helper;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\State;
use App\Models\Setting;
use App\Models\Coupon;
use App\Models\DeliveryLocations;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class CheckoutController extends Controller
{
    public function index(){

        $cart_item = \Cart::getContent();
        // echo count($cart_item);exit;

        $locations = DeliveryLocations::all();

        if(count($cart_item)==0){
            return redirect('/');
        }else{
            $title = '';
            $cart_item = \Cart::getContent();
            $countries = Countries::all();
            $state_list = State::where('country_id', '233')->get();
            return view('checkout', compact('title', 'cart_item', 'countries', 'state_list', 'locations'));
        }

    }

    public function handleonlinepay(Request $request) {

        // echo Helper::getShipment("172");exit;

        $costomer_data = $request->session()->get('user_data');
        $shipping_charge_data = $request->session()->get('shipping_charge_data');
        $cart_amount_data = $request->session()->get('cart_amount_data');
        $tax_amount = $cart_amount_data['tax_amount'];

        $input = $request->input();

        $discount = $cart_amount_data['coupon_discount'];
        // echo $discount;exit;
        $total_pay = filter_var($cart_amount_data['final_amount'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

        // echo $total_pay;exit;
        // $total_pay = "63.32";

        /* Create a merchantAuthenticationType object with authentication details
          retrieved from the constants file */
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(env('MERCHANT_LOGIN_ID'));
        $merchantAuthentication->setTransactionKey(env('MERCHANT_TRANSACTION_KEY'));

        // Set the transaction's refId
        $refId = 'ref' . time();
        $cardNumber = preg_replace('/\s+/', '', $input['cardNumber']);

        // Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($cardNumber);
        $creditCard->setExpirationDate($input['expiration-year'] . "-" .$input['expiration-month']);
        $creditCard->setCardCode($input['cvv']);

        // Add the payment data to a paymentType object
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);

        // Create a TransactionRequestType object and add the previous objects to it
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($total_pay);
        $transactionRequestType->setPayment($paymentOne);

        // Assemble the complete transaction request
        $requests = new AnetAPI\CreateTransactionRequest();
        $requests->setMerchantAuthentication($merchantAuthentication);
        $requests->setRefId($refId);
        $requests->setTransactionRequest($transactionRequestType);

        // Create the controller and get the response
        $controller = new AnetController\CreateTransactionController($requests);

        // $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
        // dd($response);
        if ($response != null) {
            // dd($response->getMessages()->getResultCode());
            // Check to see if the API request was successfully received and acted upon
            if ($response->getMessages()->getResultCode() == "Ok") {
                // Since the API request was successful, look for a transaction response
                // and parse it to display the results of authorizing the card
                $tresponse = $response->getTransactionResponse();

                // dd($tresponse);


                if ($tresponse != null && $tresponse->getResponseCode() == "1"){

                    // dd($tresponse);

                   $transaction_id = $tresponse->getTransId();

                   $order_no = 'drago' . str_pad(Order::count() + 1, 5, '0', STR_PAD_LEFT);

                    $user_id = 0;
                    if(!empty(Session::get('user_session'))){
                        $user_id = Session::get('user_session')->id;
                    }else{

                        if($costomer_data['createAccount']==1){

                            $user_check = User::where('email', $costomer_data['email'])->first();

                            if(!empty($user_check)){
                                $user_id = $user_check->id;
                            }else{
                                $data_user = [
                                    'name'=>$costomer_data['name'],
                                    'email'=>$costomer_data['email'],
                                    'password'=>bcrypt($costomer_data['password']),
                                    'is_admin'=>'0',
                                    'status'=>'1',
                                ];
                                $user = User::create($data_user);
                                $user_id = $user->id;
                            }

                        }else{
                            $user_id = 0;
                        }

                    }


                    if($costomer_data['sameAddress'] == '1'){
                        $data_billing = [
                           'user_id'=>$user_id,
                           'name'=>$costomer_data['name'],
                           'address'=>$costomer_data['address'],
                           'city'=>$costomer_data['city'],
                           'state'=>$costomer_data['state'],
                           'zipcode'=>$costomer_data['zipcode'],
                           'country'=>'233',
                       ];
                       $userBillingAddress = UserBillingAddress::create($data_billing);
                       $billing_id = $userBillingAddress->id;

                       $userShippingAddress = UserShippingAddress::create($data_billing);
                       $shipping_id = $userShippingAddress->id;
                    }else{
                        $data_billing = [
                            'user_id'=>$user_id,
                            'name'=>$costomer_data['name'],
                            'address'=>$costomer_data['address'],
                            'city'=>$costomer_data['city'],
                            'state'=>$costomer_data['state'],
                            'zipcode'=>$costomer_data['zipcode'],
                            'country'=>'233',
                        ];

                       $userBillingAddress = UserBillingAddress::create($data_billing);
                       $billing_id = $userBillingAddress->id;

                        $data_shipping = [
                            'user_id'=>$user_id,
                            'name'=>$costomer_data['s_name'],
                            'address'=>$costomer_data['s_address'],
                            'city'=>$costomer_data['s_city'],
                            'state'=>$costomer_data['s_state'],
                            'zipcode'=>$costomer_data['s_zipcode'],
                            'country'=>'233',
                        ];
                       $userShippingAddress = UserShippingAddress::create($data_shipping);
                       $shipping_id = $userShippingAddress->id;
                    }

                    $order_data = [
                        'user_id'=>$user_id,
                        'order_no'=>$order_no,
                        'billing_id'=>$billing_id,
                        'shipping_id'=>$shipping_id,
                        'name'=>$costomer_data['name'],
                        'email'=>$costomer_data['email'],
                        'phone'=>$costomer_data['phone'],
                        'total_amount'=>$total_pay,
                        'discount'=>$discount,
                        'shipping_charges'=>$shipping_charge_data['totalCharges'],
                        'total_pay'=>$total_pay,
                        'transaction_id'=>$transaction_id,
                        'tax_amount'=>$tax_amount,
                    ];
                    $order = Order::create($order_data);
                    $order_id = $order->id;

                    $cart_item = \Cart::getContent();

                    foreach ($cart_item as $key => $cart_itemvalue) {

                        if($cart_itemvalue->attributes->is_variation=='1'){
                            $product_id = Str::before($cart_itemvalue->id, '_');
                            $attribute_items_id = Str::after($cart_itemvalue->attributes->attribute_items_id, '_');
                        }else{
                            $product_id = Str::before($cart_itemvalue->id, '_');
                            $attribute_items_id = '';
                        }

                        $dataOrderdetails = [
                            'user_id'=>$user_id,
                            'order_id'=>$order_id,
                            'product_id'=>$product_id,
                            'is_variation'=>$cart_itemvalue->attributes->is_variation,
                            'attribute_items_id'=>$attribute_items_id,
                            'name'=>$cart_itemvalue->name,
                            'price'=>$cart_itemvalue->price,
                            'quantity'=>$cart_itemvalue->quantity,
                            'product_image'=>$cart_itemvalue->attributes->product_image,
                        ];

                        OrderDetails::create($dataOrderdetails);
                    }

                    $dataPayment = [
                        'user_id'=>$user_id,
                        'order_id'=>$order_id,
                        'name'=>$costomer_data['name'],
                        'email'=>$costomer_data['email'],
                        'phone'=>$costomer_data['phone'],
                        'total_pay'=>$total_pay,
                        'transaction_id'=>$transaction_id,
                    ];
                    $payment = Payment::create($dataPayment);


                    $user_email = $costomer_data['email'];

                    $mailsend = \Mail::send('emails.order_invoice', ['cart_item' => $cart_item, 'order_no' => $order_no, 'discount'=>$discount, 'shipping_charges'=>$shipping_charge_data['totalCharges'], 'total_pay'=>$total_pay, 'tax_amount'=>$tax_amount], function($message) use($user_email){
                        $message->to($user_email);
                        $message->subject('Order Invoice');
                    });

                    $mailsend = \Mail::send('emails.order_invoice', ['cart_item' => $cart_item, 'order_no' => $order_no, 'discount'=>$discount, 'shipping_charges'=>$shipping_charge_data['totalCharges'], 'total_pay'=>$total_pay, 'tax_amount'=>$tax_amount], function($message) use($user_email, $order_no){
                        $message->to(env('AdminEmail'));
                        $message->subject('New order- '. $order_no);
                    });

                    Helper::getShipment($order_id);

                    \Cart::clear();


                    return response()->json([
                        'status' => 1,
                        'transaction_id' => $transaction_id,
                        'msg' => 'Order succesfully done',
                    ]);


                }else{
                    return response()->json([
                        'status' => 0,
                        'msg' => 'There were some issue with the payment. Please try again later.',
                    ]);
                    if ($tresponse->getErrors() != null) {
                        return response()->json([
                            'status' => 0,
                            'msg' => $tresponse->getErrors()[0]->getErrorText(),
                        ]);

                    }
                }
                // Or, print errors if the API request wasn't successful
            } else {

                return response()->json([
                    'status' => 0,
                    'msg' => 'There were some issue with the payment. Please try again laters.',
                ]);

                $tresponse = $response->getTransactionResponse();

                if ($tresponse != null && $tresponse->getErrors() != null) {
                    return response()->json([
                        'status' => 0,
                        'msg' => $tresponse->getErrors()[0]->getErrorText(),
                    ]);
                } else {

                    return response()->json([
                        'status' => 0,
                        'msg' => $response->getMessages()->getMessage()[0]->getText(),
                    ]);

                }
            }
        } else {

            return response()->json([
                'status' => 0,
                'msg' => 'No response returned',
            ]);
        }
    }

    public function paypalpaymentint(Request $request){
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));

        $paypalToken = $provider->getAccessToken();

        $cart_amount_data = $request->session()->get('cart_amount_data');
        $total_pay = filter_var($cart_amount_data['final_amount'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.payment.success'),
                "cancel_url" => route('paypal.payment/cancel'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $total_pay
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return response()->json([
                        'status' => 1,
                        'redirect_url' => $links['href']
                    ]);
                }
            }

            return response()->json([
                'status' => 0,
                'msg' => 'There were some issue with the payment. Please try again later.',
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'msg' => 'There were some issue with the payment. Please try again later.',
            ]);
        }
    }


    public function paymentCancel(){

        // return redirect()->route('paypal')->with('error', $response['message'] ?? 'You have canceled the transaction.');
        return view('cancel');

    }

    public function paymentSuccess(Request $request){

        $provider = new PayPalClient;

        $provider->setApiCredentials(config('paypal'));

        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request['token']);



        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            // dd($response);

            $costomer_data = $request->session()->get('user_data');
            $shipping_charge_data = $request->session()->get('shipping_charge_data');
            $cart_amount_data = $request->session()->get('cart_amount_data');
            $tax_amount = $cart_amount_data['tax_amount'];
            $discount = $cart_amount_data['coupon_discount'];
            $total_pay = filter_var($cart_amount_data['final_amount'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

                    $transaction_id = $response['id'];

                   $order_no = 'drago' . str_pad(Order::count() + 1, 5, '0', STR_PAD_LEFT);

                    $user_id = 0;
                    if(!empty(Session::get('user_session'))){
                        $user_id = Session::get('user_session')->id;
                    }else{

                        if($costomer_data['createAccount']==1){

                            $user_check = User::where('email', $costomer_data['email'])->first();

                            if(!empty($user_check)){
                                $user_id = $user_check->id;
                            }else{
                                $data_user = [
                                    'name'=>$costomer_data['name'],
                                    'email'=>$costomer_data['email'],
                                    'password'=>bcrypt($costomer_data['password']),
                                    'is_admin'=>'0',
                                    'status'=>'1',
                                ];
                                $user = User::create($data_user);
                                $user_id = $user->id;
                            }

                        }else{
                            $user_id = 0;
                        }

                    }


                    if($costomer_data['sameAddress'] == '1'){
                        $data_billing = [
                           'user_id'=>$user_id,
                           'name'=>$costomer_data['name'],
                           'address'=>$costomer_data['address'],
                           'city'=>$costomer_data['city'],
                           'state'=>$costomer_data['state'],
                           'zipcode'=>$costomer_data['zipcode'],
                           'country'=>'233',
                       ];
                       $userBillingAddress = UserBillingAddress::create($data_billing);
                       $billing_id = $userBillingAddress->id;

                       $userShippingAddress = UserShippingAddress::create($data_billing);
                       $shipping_id = $userShippingAddress->id;
                    }else{
                        $data_billing = [
                            'user_id'=>$user_id,
                            'name'=>$costomer_data['name'],
                            'address'=>$costomer_data['address'],
                            'city'=>$costomer_data['city'],
                            'state'=>$costomer_data['state'],
                            'zipcode'=>$costomer_data['zipcode'],
                            'country'=>'233',
                        ];

                       $userBillingAddress = UserBillingAddress::create($data_billing);
                       $billing_id = $userBillingAddress->id;

                        $data_shipping = [
                            'user_id'=>$user_id,
                            'name'=>$costomer_data['s_name'],
                            'address'=>$costomer_data['s_address'],
                            'city'=>$costomer_data['s_city'],
                            'state'=>$costomer_data['s_state'],
                            'zipcode'=>$costomer_data['s_zipcode'],
                            'country'=>'233',
                        ];
                       $userShippingAddress = UserShippingAddress::create($data_shipping);
                       $shipping_id = $userShippingAddress->id;
                    }

                    $order_data = [
                        'user_id'=>$user_id,
                        'order_no'=>$order_no,
                        'billing_id'=>$billing_id,
                        'shipping_id'=>$shipping_id,
                        'name'=>$costomer_data['name'],
                        'email'=>$costomer_data['email'],
                        'phone'=>$costomer_data['phone'],
                        'total_amount'=>$total_pay,
                        'discount'=>$discount,
                        'shipping_charges'=>$shipping_charge_data['totalCharges'],
                        'total_pay'=>$total_pay,
                        'transaction_id'=>$transaction_id,
                        'tax_amount'=>$tax_amount,
                    ];
                    $order = Order::create($order_data);
                    $order_id = $order->id;

                    $cart_item = \Cart::getContent();

                    foreach ($cart_item as $key => $cart_itemvalue) {

                        if($cart_itemvalue->attributes->is_variation=='1'){
                            $product_id = Str::before($cart_itemvalue->id, '_');
                            $attribute_items_id = Str::after($cart_itemvalue->attributes->attribute_items_id, '_');
                        }else{
                            $product_id = Str::before($cart_itemvalue->id, '_');
                            $attribute_items_id = '';
                        }

                        $dataOrderdetails = [
                            'user_id'=>$user_id,
                            'order_id'=>$order_id,
                            'product_id'=>$product_id,
                            'is_variation'=>$cart_itemvalue->attributes->is_variation,
                            'attribute_items_id'=>$attribute_items_id,
                            'name'=>$cart_itemvalue->name,
                            'price'=>$cart_itemvalue->price,
                            'quantity'=>$cart_itemvalue->quantity,
                            'product_image'=>$cart_itemvalue->attributes->product_image,
                        ];

                        OrderDetails::create($dataOrderdetails);
                    }

                    $dataPayment = [
                        'user_id'=>$user_id,
                        'order_id'=>$order_id,
                        'name'=>$costomer_data['name'],
                        'email'=>$costomer_data['email'],
                        'phone'=>$costomer_data['phone'],
                        'total_pay'=>$total_pay,
                        'transaction_id'=>$transaction_id,
                    ];
                    $payment = Payment::create($dataPayment);


                    $user_email = $costomer_data['email'];

                    $mailsend = \Mail::send('emails.order_invoice', ['cart_item' => $cart_item, 'order_no' => $order_no, 'discount'=>$discount, 'shipping_charges'=>$shipping_charge_data['totalCharges'], 'total_pay'=>$total_pay, 'tax_amount'=>$tax_amount], function($message) use($user_email){
                        $message->to($user_email);
                        $message->subject('Order Invoice');
                    });

                    $mailsend = \Mail::send('emails.order_invoice', ['cart_item' => $cart_item, 'order_no' => $order_no, 'discount'=>$discount, 'shipping_charges'=>$shipping_charge_data['totalCharges'], 'total_pay'=>$total_pay, 'tax_amount'=>$tax_amount], function($message) use($user_email, $order_no){
                        $message->to(env('AdminEmail'));
                        $message->subject('New order- '. $order_no);
                    });

                    Helper::getShipment($order_id);

                    \Cart::clear();

                    // echo "order success";
                    return view('success', compact('transaction_id'));


                    // return response()->json([
                    //     'status' => 1,
                    //     'transaction_id' => $transaction_id,
                    //     'msg' => 'Order succesfully done',
                    // ]);

        } else {



        }

    }



    public function order_success(){
        $title = '';
        return view('order_success', compact('title'));
    }

    public function remove_cart(Request $request){
        \Cart::remove($request->id);
        return redirect()->back()->with('cart_success', 'Product has been removed from cart');
    }

    public function save_customerdata(Request $request){

        $createAccount = $request->createAccount;
        if(isset($createAccount)){
            $createAccount = 1;
        }else{
            $createAccount = 0;
        }

        $sameAddress = $request->sameAddress;
        if(isset($sameAddress)){
            $sameAddress = 1;
        }else{
            $sameAddress = 0;
        }

        $formData = $request->only(['name', 'address', 'city', 'state', 'zipcode', 's_name', 's_address', 's_city', 's_state', 's_zipcode', 'email', 'phone', 'createAccount', 'password']);
        $formData['createAccount'] = $createAccount;
        $formData['sameAddress'] = $sameAddress;
        session(['user_data' => $formData]);
        return response()->json([
            'status' => 1,
            'msg' => "Success",
        ]);

    }

    public function get_fedex_rate(Request $request){
        // dd($request->all());
        $formData = $request->session()->get('user_data');
        $from_address = Setting::first();

        $accessToken = Helper::getUpstoken();
        if($accessToken==0){
            return response()->json([
                'status' => 0,
                'msg' => "Something went wrong please try after sometime",
            ]);die;
        }


        $cart_item = \Cart::getContent();
        $product_array = array();

        foreach ($cart_item as $key => $cart_itemvalue) {
            $product_id = Str::before($cart_itemvalue->id, '_');
            $quantity = $cart_itemvalue->quantity;
            if (array_key_exists($product_id, $product_array)) {
                $product_array[$product_id] += $quantity;
            } else {
                $product_array[$product_id] = $quantity;
            }

        }





        // PACKAGE
        $package_info = array(
            'service' => $request->type,
            'package_type' => '02', //PACKAGE TYPE 02==Box
        );

        // SHIPPER
        $shipper_info = array(
            'account_number' => env("UpsAccountnumber"),
            'name' => 'Kevin Huynh',
            'address1' => $from_address->from_address,
            'address2' => '',
            'address3' => '',
            'city' => $from_address->from_city,
            'state' => $from_address->from_state,
            'zip' => $from_address->from_zip,
            'country' => 'us',
        );

        // FROM ADDRESS
        $from_address_info = array(
            'name' => 'Kevin Huynh',
            'address1' => $from_address->from_address,
            'address2' => '',
            'address3' => '',
            'city' => $from_address->from_city,
            'state' => $from_address->from_state,
            'zip' => $from_address->from_zip,
            'country' => 'us',
        );

        // TO ADDRESS
        $to_address_info = array(
            'name' => $formData['s_name'],
            'address1' => $formData['s_address'],
            'address2' => '',
            'address3' => '',
            'city' => $formData['s_city'],
            'state' => $formData['s_state'],
            'zip' => $formData['s_zipcode'],
            'country' => 'US',
        );


        $packageArray = array();

        // dd($product_array);
        $totalWeight = 0;
        $maxLength = 0;
        $maxWidth = 0;
        $maxHeight = 0;
        foreach ($product_array as $product_id => $quantity) {
            $product = Product::where('id', $product_id)->first();



            $weight = ($product->weight * $quantity);
            $totalWeight += $weight;

            $length = $product->length;
            $width = $product->width;
            $height = $product->height;




            if ($length > $maxLength) {
                $maxLength = $length;
            }

            if ($width > $maxWidth) {
                $maxWidth = $width;
            }

            if ($height > $maxHeight) {
                $maxHeight = $height;
            }

        }

        // echo $totalWeight;exit;



    $version = "v2205";
    $requestoption = "Rate";
    $query = array();
    $curl = curl_init();

    $payload = array(
        "RateRequest" => array(
            "Request" => array(
                "TransactionReference" => array(
                    "CustomerContext" => "CustomerContext",
                    "TransactionIdentifier" => "TransactionIdentifier"
                )
            ),
            "Shipment" => array(
                "Shipper" => array(
                    "Name" => $shipper_info['name'],
                    "ShipperNumber" => $shipper_info['account_number'],
                    "Address" => array(
                        "AddressLine" => array(
                            $shipper_info['address1'],
                            $shipper_info['address2'],
                            $shipper_info['address3']
                        ),
                        "City" => $shipper_info['city'],
                        "StateProvinceCode" => $shipper_info['state'],
                        "PostalCode" => $shipper_info['zip'],
                        "CountryCode" => $shipper_info['country']
                    )
                ),
                "ShipTo" => array(
                    "Name" => $to_address_info['name'],
                    "Address" => array(
                        "AddressLine" => array(
                            $to_address_info['address1'],
                            $to_address_info['address2'],
                            $to_address_info['address3']
                        ),
                        "City" => $to_address_info['city'],
                        "StateProvinceCode" => $to_address_info['state'],
                        "PostalCode" => $to_address_info['zip'],
                        "CountryCode" => $to_address_info['country']
                    )
                ),
                "ShipFrom" => array(
                    "Name" => $from_address_info['name'],
                    "Address" => array(
                        "AddressLine" => array(
                            $from_address_info['address1'],
                            $from_address_info['address2'],
                            $from_address_info['address3']
                        ),
                        "City" => $from_address_info['city'],
                        "StateProvinceCode" => $from_address_info['state'],
                        "PostalCode" => $from_address_info['zip'],
                        "CountryCode" => $from_address_info['country']
                    )
                ),
                // "PaymentDetails" => array(
                //     "ShipmentCharge" => array(
                //         "Type" => "01",
                //         "BillShipper" => array(
                //             "AccountNumber" => $shipper_info['account_number']
                //         )
                //     )
                // ),
                "PaymentInformation" => array(
                    "ShipmentCharge" => array(
                        "Type" => "01",
                        "BillShipper" => array(
                            "AccountNumber" => $shipper_info['account_number']
                        )
                    )
                ),
                "ShipmentRatingOptions" => array(
                    "TPFCNegotiatedRatesIndicator" => "Y",
                    "NegotiatedRatesIndicator" => "Y"
                ),
                "Service" => array(
                    "Code" => $package_info['service'],
                    "Description" => "ground"
                ),
                "NumOfPieces" => "1",
                "Package" => array(
                    array(
                        "PackagingType" => array(
                            "Code" => "02",
                            "Description" => "Packaging"
                        ),
                        "Dimensions" => array(
                            "UnitOfMeasurement" => array(
                                "Code" => "IN",
                                "Description" => "Inches"
                            ),
                            "Length" => "$maxLength",
                            "Width" => "$maxWidth",
                            "Height" => "$maxHeight"
                        ),
                        "PackageWeight" => array(
                            "UnitOfMeasurement" => array(
                                "Code" => "LBS",
                                "Description" => "Pounds"
                            ),
                            "Weight" => "$totalWeight"
                        )
                    )
                )
            )
        )
    );




        // dd($payload);



        curl_setopt_array($curl, [
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer " . $accessToken,
                "Content-Type: application/json",
                "transId: string",
                "transactionSrc: testing"
            ],
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_URL => env('Ups_Url')."/api/rating/" . $version . "/" . $requestoption . "?" . http_build_query($query),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
        ]);
        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);
        if ($error) {
            return response()->json([
                'status' => 0,
                'msg' => "Something went wrong please try after sometime",
            ]);
        } else {

            // echo "<pre>";
            // print_r(json_decode($response));exit;

            $responseArray = json_decode($response, true);

            // if (isset($responseArray['RateResponse']['Response']['ResponseStatus']['Code']) && $responseArray['RateResponse']['Response']['ResponseStatus']['Code'] === "1") {
                
                // $totalCharges = $responseArray['RateResponse']['RatedShipment']['TotalCharges']['MonetaryValue'];  // for v1

                //$totalCharges = $responseArray['RateResponse']['RatedShipment']['RatedPackage']['BaseServiceCharge']['MonetaryValue']; // for v2205


                // $totalCharges = $responseArray['RateResponse']['RatedShipment']['RatedPackage']['NegotiatedCharges']['TotalCharge']['MonetaryValue'];

            if (isset($responseArray['RateResponse']['Response']['ResponseStatus']['Code']) && $responseArray['RateResponse']['Response']['ResponseStatus']['Code'] == "1") {

                    if (isset($responseArray['RateResponse']['RatedShipment']['NegotiatedRateCharges']['TotalCharge']['MonetaryValue'])) {
                        $totalCharges = $responseArray['RateResponse']['RatedShipment']['NegotiatedRateCharges']['TotalCharge']['MonetaryValue'];
                    } else {
                        $totalCharges = $responseArray['RateResponse']['RatedShipment']['TotalCharges']['MonetaryValue'];
                    }

                session(['shipping_charge_data' => ['totalCharges'=>$totalCharges, 'service_type'=>$request->type]]);

                $service_name = '';
                if($request->type=='14'){
                    $service_name = 'UPS Next Day Air Early';
                }else if($request->type=='01'){
                    $service_name = 'UPS Next Day Air';
                }else if($request->type=='13'){
                    $service_name = 'UPS Next Day Air Saver';
                }else if($request->type=='59'){
                    $service_name = 'UPS 2nd Day Air A.M.';
                }else if($request->type=='02'){
                    $service_name = 'UPS 2nd Day Air';
                }else if($request->type=='12'){
                    $service_name = 'UPS 3 Day Select';
                }else if($request->type=='03'){
                    $service_name = 'UPS Ground';
                }

                session(['shipping_charge_data' => ['totalCharges'=>$totalCharges, 'service_type'=>$request->type, 'service_name'=>$service_name]]);

                return response()->json([
                    'status' => 1,
                    'msg' => "ok",
                    'totalCharges'=> $totalCharges,
                    'service_type'=> $request->type,
                ]);
            } else if (isset($responseArray['response']['errors']) && count($responseArray['response']['errors']) > 0) {
                // echo "Error: " . $responseArray['response']['errors'][0]['message'] . "<br>";
                return response()->json([
                    'status' => 0,
                    'msg' => $responseArray['response']['errors'][0]['message'],
                ]);

            }
        }


    }


    public function get_customerdata(Request $request){

        $costomer_data = $request->session()->get('user_data');
        $shipping_charge_data = $request->session()->get('shipping_charge_data');

        $shipping_charge = $shipping_charge_data['totalCharges'];
        $coupon_discount = 0;

        $user_email = $costomer_data['email'];


        $cart_item = \Cart::getContent();
        $total =0;
        foreach ($cart_item as $key => $cart_itemvalue) {
            $total +=($cart_itemvalue->price*$cart_itemvalue->quantity);
        }


        $tax_amount = 0;
        $final_amount = (($total-$coupon_discount)+$shipping_charge);

        // tax
        $tax_amount = Helper::taxcalCulate($final_amount);
        $amount_after_tax = ($final_amount+$tax_amount);
        $final_amount = $amount_after_tax;
        // tax end


        session(['cart_amount_data' => ['sub_total'=>$total, 'final_amount'=>$final_amount, 'coupon_discount'=>$coupon_discount, 'tax_amount'=>$tax_amount]]);

        $checkout_calculation_html = view('checkout_calculation', compact('cart_item', 'shipping_charge', 'coupon_discount', 'final_amount', 'tax_amount'))->render();

        // echo $checkout_calculation_html;


        return response()->json([
            'status' => 1,
            'msg' => 'ok',
            'costomer_data' => $costomer_data,
            'shipping_charge_data' => $shipping_charge_data,
            'checkout_calculation_html' => $checkout_calculation_html,
        ]);

    }


    public function checkCoupon(Request $request){

        $check_coupon = Coupon::where('coupon_code', $request->promocode)->first();

        if(empty($check_coupon) && env('PromoCode')!=$request->promocode){
            return response()->json([
                'status' => 0,
                'msg' => 'Invalid coupon code',
            ]);
        }else{

            $costomer_data = $request->session()->get('user_data');
            $shipping_charge_data = $request->session()->get('shipping_charge_data');
            $shipping_charge = $shipping_charge_data['totalCharges'];




            $cart_item = \Cart::getContent();
            $total =0;
            foreach ($cart_item as $key => $cart_itemvalue) {
                $total +=($cart_itemvalue->price*$cart_itemvalue->quantity);
            }

            if(env('PromoCode')==$request->promocode){
                $user_email = $costomer_data['email'];
                $user_check = Order::where('email', $user_email)->where(function($query) {
                    $query->where('current_status', '')
                        ->orWhereNot('current_status', 'Cancel');
                })->first();

                if(empty($user_check)){
                    $coupon_discount = ($total * env('firstDiscount')) / 100;
                    $coupon_discount = number_format($coupon_discount, 2, '.', ',');
                    $final_amount = (($total-$coupon_discount)+$shipping_charge);
                }else{
                    $coupon_discount = 0.00;
                    return response()->json([
                        'status' => 0,
                        'msg' => 'Coupon code not applicable',
                    ]);
                }

            }else{
                // dd($cart_item);
                $coupon_category = $check_coupon->coupon_category;
                $coupon_category_array = explode(',', $coupon_category);
                $matching_category_ids = [];
                $coupon_exits_total = 0;
                foreach ($cart_item as $key => $cart_itemvalue) {
                    $product_id = Str::before($cart_itemvalue->id, '_');
                    $prodtct_details = Product::select('category_id')->where('id', $product_id)->first();
                    $category_id = $prodtct_details->category_id;

                    if(in_array($category_id, $coupon_category_array)) {
                        $matching_category_ids[] = $category_id;
                        $coupon_exits_total +=($cart_itemvalue->price*$cart_itemvalue->quantity);
                    }

                }

                if(!empty($matching_category_ids)){
                    $coupon_discount = ($coupon_exits_total * $check_coupon->coupon_discount) / 100;
                    $coupon_discount = number_format($coupon_discount, 2, '.', ',');
                    $final_amount = (($total-$coupon_discount)+$shipping_charge);
                }else{
                    $coupon_discount = 0.00;
                    return response()->json([
                        'status' => 0,
                        'msg' => 'Coupon code not applicable',
                    ]);die();
                }





            }



            $tax_amount = 0;
            //tax start
            $tax_amount = Helper::taxcalCulate($final_amount);
            $amount_after_tax = ($final_amount+$tax_amount);
            $final_amount = $amount_after_tax;
            //tax end





            session(['cart_amount_data' => ['sub_total'=>$total, 'final_amount'=>$final_amount, 'coupon_discount'=>$coupon_discount, 'tax_amount'=>$tax_amount]]);

            $checkout_calculation_html = view('checkout_calculation', compact('cart_item', 'shipping_charge', 'coupon_discount', 'final_amount', 'tax_amount'))->render();

            // echo $checkout_calculation_html;


            return response()->json([
                'status' => 1,
                'msg' => 'ok',
                'checkout_calculation_html' => $checkout_calculation_html,
            ]);

        }

    }

    public function removeCoupon(Request $request){

            $costomer_data = $request->session()->get('user_data');
            $shipping_charge_data = $request->session()->get('shipping_charge_data');

            $shipping_charge = $shipping_charge_data['totalCharges'];




            $cart_item = \Cart::getContent();
            $total =0;
            foreach ($cart_item as $key => $cart_itemvalue) {
                $total +=($cart_itemvalue->price*$cart_itemvalue->quantity);
            }

            $coupon_discount = '0.00';

            $tax_amount = 0;
            $final_amount = (($total-$coupon_discount)+$shipping_charge);


            //tax start
            $tax_amount = Helper::taxcalCulate($final_amount);
            $amount_after_tax = ($final_amount+$tax_amount);
            $final_amount = $amount_after_tax;
            //tax end

            session(['cart_amount_data' => ['sub_total'=>$total, 'final_amount'=>$final_amount, 'coupon_discount'=>$coupon_discount, 'tax_amount'=>$tax_amount]]);

            $checkout_calculation_html = view('checkout_calculation', compact('cart_item', 'shipping_charge', 'coupon_discount', 'final_amount', 'tax_amount'))->render();

            // echo $checkout_calculation_html;


            return response()->json([
                'status' => 1,
                'msg' => 'ok',
                'checkout_calculation_html' => $checkout_calculation_html,
            ]);



    }


    public function place_order_cod(Request $request){

        // dd($request->all());

        $transaction_id = 'COD-'.Str::upper(Str::random(10));

        $order = Order::create([
            'order_no'=>$transaction_id,
            'shipping_id'=>$request->location_id,
            'address'=>$request->address,
            'name'=>$request->name,
            'phone'=>$request->phone,
            'shipping_charges'=>$request->shipping_charge,
            'total_amount'=>$request->order_total,
            'total_pay'=>$request->order_total+($request->shipping_charge!=''?$request->shipping_charge:0),
        ]);

        $order_id = $order->id;

    
        $cart_item = \Cart::getContent();

        // dd($cart_item);

        foreach ($cart_item as $key => $cart_itemvalue) {

            if($cart_itemvalue->attributes->is_variation=='1'){
                $product_id = Str::before($cart_itemvalue->id, '_');
                $attribute_items_id = Str::after($cart_itemvalue->attributes->attribute_items_id, '_');
            }else{
                $product_id = Str::before($cart_itemvalue->id, '_');
                $attribute_items_id = '';
            }

            $dataOrderdetails = [
                'order_id'=>$order_id,
                'product_id'=>$product_id,
                'is_variation'=>$cart_itemvalue->attributes->is_variation,
                'attribute_items_id'=>$attribute_items_id,
                'name'=>$cart_itemvalue->name,
                'price'=>$cart_itemvalue->price,
                'quantity'=>$cart_itemvalue->quantity,
                'product_image'=>$cart_itemvalue->attributes->product_image,
            ];

            OrderDetails::create($dataOrderdetails);
        }

        \Cart::clear();


        return response()->json([
            'status' => 1,
            'msg' => 'ok',
            'transaction_id' => $transaction_id,
        ]);

                   
    }



}

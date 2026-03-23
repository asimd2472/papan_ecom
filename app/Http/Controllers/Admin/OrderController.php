<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\OrderDetails;
use App\Models\Order;
use App\Models\UpsShipment;

class OrderController extends Controller
{
    public function order_list(){
        $order_details = Order::orderBy('id', 'DESC')->paginate(15);
        return view('admin.order.index', compact('order_details'));
    }

    public function order_details($order_id){
        $order_details = Order::where('id', $order_id)->first();
        $upsShipment = UpsShipment::where('order_id', $order_id)->get();
        return view('admin.order.order_details', compact('order_details', 'upsShipment'));
    }
}

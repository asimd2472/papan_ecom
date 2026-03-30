<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AllImage;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\Producttype;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Models\Brand;
use App\Models\Catrgory_brand;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeItem;
use App\Models\ProductAttributeItemImage;
use App\Models\ProductAttributeItemSpecification;
use App\Models\ProductVariation;

class CartController extends Controller
{
    public function addtoCart(Request $request){
        // dd($request->all());
        $product_id = $request->product_id;
        $is_variation = $request->is_variation;
        $attribute_items_id = $request->attribute_items_id;
        $totalqty = $request->totalqty;
        $product_title = $request->product_title;
        $size_attribute_name = $request->size_attribute_name;

        $product = Product::where('id', $product_id)->first();

        $product_title = $product_title;
        $product_image = $product->main_image_name;

        $color = '';
        $size = '';
        $price = 0;
        if($is_variation==0){
            
            $price = $product->product_price;
            $id = $product_id.'_'.'0';

            

        }else if($is_variation==1){
            $productAttributeItem = ProductVariation::where('id', $attribute_items_id)->first();
            $price = $productAttributeItem->price;
            $id = $product_id.'_'.$attribute_items_id;
            $color = $productAttributeItem->color;
            $size = $productAttributeItem->size;
        }




        

            \Cart::add([
                'id' => $id,
                'name' => $product_title,
                'price' => $price,
                'quantity' => $totalqty,
                'attributes' => array(
                    'attribute_items_id' => $attribute_items_id,
                    'product_image'=>$product_image,
                    'is_variation'=>$is_variation,
                    'color'=>$color,
                    'size'=>$size,
                ),
            ]);

            $totalcart_item = \Cart::getTotalQuantity();

            return response()->json([
                'status' => 1,
                'msg'=>'Product added in your cart',
                'totalcart_item'=>$totalcart_item,
            ]);


    }

    public function cartlist(){
        $title = '';
        $cart_item = \Cart::getContent();
        return view('cartlist', compact('title', 'cart_item'));
    }

    public function cartupdate(Request $request){
        $cartitem = $request->cartitem;
        $cartid = $request->cartid;
        $cartprice = $request->cartprice;
        $updatetype = $request->updatetype;


        // echo $cartid;exit;
        if($updatetype==1){
            \Cart::update($cartid, array(
                'quantity' => 1,
            ));
        }else if($updatetype==0){
            \Cart::update($cartid, array(
                'quantity' => -1,
            ));
        }
        $newproductcartprice = ($cartprice*$cartitem);

        $cart_item = \Cart::getContent();
        $total =0;
        foreach ($cart_item as $key=> $item){
            $total +=($item->price*$item->quantity);
        }

        $totalcart_item = \Cart::getTotalQuantity();



        echo json_encode(['status'=>1, 'newproductcartprice'=>$newproductcartprice, 'total'=>$total, 'totalcart_item'=>$totalcart_item]);
    }
}

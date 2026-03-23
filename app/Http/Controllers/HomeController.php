<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AllImage;
use Illuminate\Http\Request;
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
use App\Models\Customrods;
use App\Models\Newsletter;
use App\Models\Pages;
use Mail;

class HomeController extends Controller
{
    public function index()
    {
        $title = '';
        $brand = Brand::limit(10)->get();
        $homepageData = Pages::where('id', 1)->first();
        $categoryes = ProductCategory::where('status', 1)->get();
        return view('home', compact('title', 'brand', 'categoryes', 'homepageData'));
    }

    public function holiday_sale()
    {
        $title = '';
        $slug = 'holiday';

        $products = Product::with(['productCategory' => fn ($query) => $query->where('status', 1)->where('slug', $slug)])
            ->whereHas(
                'productCategory',
                fn ($query) =>
                $query->where('slug', $slug)
            )->get();

        $singleProducttype = Producttype::where('id', '')->first();
        $categoryandType = ProductCategory::with('producttype')->where('status', 1)->get();
        $brand = Brand::limit(10)->get();
        $singleCategory = ProductCategory::where('slug', $slug)->first();

        // dd($products->toArray());

        // return view('product_list', compact('title', 'products', 'categoryandType', 'brand', 'singleProducttype', 'singleCategory'));


        return view('holiday_sale', compact('title', 'products', 'categoryandType', 'brand', 'singleProducttype', 'singleCategory'));
    }

    public function storeNewslaterEmail(Request $request)
    {

        if ($request->newslater_email != '') {
            $check_email_unique = Newsletter::where('email', $request->newslater_email)->first();
            if ($check_email_unique) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'This email id already exists',
                ]);
            } else {
                Newsletter::create([
                    'email' => $request->newslater_email
                ]);

                $mailsend = \Mail::send('emails.newsLetter', ['email'=>$request->newslater_email], function($message) use($request){
                    $message->to($request->newslater_email);
                    $message->subject('Dragocustomrods newsletter signup');
                });

                $mailsend_admin = \Mail::send('emails.newsLetter_admin', ['email'=>$request->newslater_email], function($message) use($request){
                    $message->to(env('AdminEmail'));
                    $message->subject('New user signup newsletter');
                });


                return response()->json([
                    'status' => 1,
                    'msg' => 'Please use above promo code',
                    'seccess_msgg' => 'Promo code: <b>drago10</b>'
                ]);

                // return response()->json([
                //     'status' => 1,
                //     'msg' => 'Thank you for subscribing to our newsletter!',
                //     'seccess_msgg' => ''
                // ]);
            }
        } else {
            return response()->json([
                'status' => 0,
                'msg' => 'Email Field is required',
            ]);
        }
    }
}

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


class ProductsController extends Controller
{
    public function product_categoty($slug){
        $title = '';

        // echo $slug;exit;
        $pcategory = ProductCategory::where('slug', $slug)->first();
        $checkProducttype = Producttype::where('category_id', $pcategory->id)->first();

        if(!empty($checkProducttype)){

            $productType = Producttype::with(['productCategory' => fn($query) => $query->where('status', 1)->where('slug', $slug)])
            ->whereHas('productCategory', fn ($query) =>
                $query->where('slug', $slug)
            )->get();

            $categoryandType = ProductCategory::with('producttype')->where('status', 1)->get();
            $singleCategory = ProductCategory::where('slug', $slug)->first();
            $brand = Brand::limit(10)->get();
            // dd($singleCategory);

            return view('product_type', compact('title', 'productType', 'categoryandType', 'singleCategory', 'brand'));

        }else{



            $products_brand = Product::with(['productCategory' => fn($query) => $query->where('status', 1)->where('slug', $slug)])
            ->whereHas('productCategory', fn ($query) =>
                $query->where('slug', $slug)
            )->get()->groupBy('brand_id');

            // if (isset($products_brand[""])) {
            //     echo 1;exit;
            // }else{
            //     echo "11";exit;
            // }

            // if (array_key_exists('', $products_brand->toArray())) {
            //     echo "The 'first' element is in the array";
            // }

            // dd($products_brand->toArray());

            // if(is_null($products_brand[""])){
            if (array_key_exists('', $products_brand->toArray())) {

                $products = Product::with(['productCategory' => fn($query) => $query->where('status', 1)->where('slug', $slug)])
                ->whereHas('productCategory', fn ($query) =>
                    $query->where('slug', $slug)
                )->get();

                $singleProducttype = Producttype::where('id', '')->first();
                $categoryandType = ProductCategory::with('producttype')->where('status', 1)->get();
                $brand = Brand::limit(10)->get();
                $singleCategory = ProductCategory::where('slug', $slug)->first();

                // dd($products->toArray());

                return view('product_list', compact('title', 'products', 'categoryandType', 'brand', 'singleProducttype', 'singleCategory'));

            }else{

                $brand_list=[];
                foreach ($products_brand as $key => $value) {

                        $list = Brand::where('id', $key)->first();

                        $brand_list[]=array(
                            'id'=>$list->id,
                            'brandname'=>$list->brandname,
                            'brandimage'=>$list->brandimage,
                        );

                }

                $singleProducttype = array();
                $categoryandType = ProductCategory::with('producttype')->where('status', 1)->get();
                $brand = Brand::limit(10)->get();
                $singleCategory = ProductCategory::where('slug', $slug)->first();

                // dd($singleProducttype);

                return view('brand_list', compact('title', 'brand_list', 'categoryandType', 'brand', 'singleProducttype', 'singleCategory'));
                // return view('product_list', compact('title', 'products', 'categoryandType', 'brand', 'singleProducttype', 'singleCategory'));



            }









        }


    }

    public function product_listing_bytype($category_slug, $type_id){
        $title = '';

        $type_id = base64_decode($type_id);

        if($type_id==13){
            // $categoryandType = ProductCategory::with('producttype')->where('status', 1)->get();
            // $brand = Brand::limit(10)->get();
            // $singleCategory = ProductCategory::where('slug', $category_slug)->first();
            // return view('drago_rods', compact('title', 'categoryandType', 'brand', 'singleCategory'));
        }else if($type_id==14){
            $categoryandType = ProductCategory::with('producttype')->where('status', 1)->get();
            $brand = Brand::limit(10)->get();
            $singleCategory = ProductCategory::where('slug', $category_slug)->first();
            $customrods = Customrods::orderBy('id', 'DESC')->paginate(50);
            return view('custom_rods', compact('title', 'categoryandType', 'brand', 'singleCategory', 'customrods'));
        }

        // dd($type_id);


        $products = Product::with(['productCategory' => fn($query) => $query->where('status', 1)->where('slug', $category_slug)])
            ->whereHas('productCategory', fn ($query) =>
                $query->where('slug', $category_slug)
        )->where('type_id', $type_id)->get()->groupBy('brand_id');

        // dd($products->toArray());

        if (array_key_exists('', $products->toArray())) {

            $products = Product::with(['productCategory' => fn($query) => $query->where('status', 1)->where('slug', $category_slug)])
                ->whereHas('productCategory', fn ($query) =>
                    $query->where('slug', $category_slug)
            )->where('type_id', $type_id)->get();

            $singleProducttype = Producttype::where('id', $type_id)->first();
            $categoryandType = ProductCategory::with('producttype')->where('status', 1)->get();
            $brand = Brand::limit(10)->get();
            $singleCategory = ProductCategory::where('slug', $category_slug)->first();

            return view('product_list', compact('title', 'products', 'categoryandType', 'brand', 'singleProducttype', 'singleCategory'));

        }else{


            $brand_list=[];
            foreach ($products as $key => $value) {

                    $list = Brand::where('id', $key)->first();

                    $brand_list[]=array(
                        'id'=>$list->id,
                        'brandname'=>$list->brandname,
                        'brandimage'=>$list->brandimage,
                    );

            }

            $singleProducttype = Producttype::where('id', $type_id)->first();
            $categoryandType = ProductCategory::with('producttype')->where('status', 1)->get();
            $brand = Brand::limit(10)->get();
            $singleCategory = ProductCategory::where('slug', $category_slug)->first();

            // dd($products->toArray());

            return view('brand_list', compact('title', 'brand_list', 'categoryandType', 'brand', 'singleProducttype', 'singleCategory'));

        }

    }


    public function product_listing_bybrand($category_slug, $type_id, $brand_id){

        $title = '';

        if($type_id!=' '){
            $type_id = base64_decode($type_id);

            $products = Product::with(['productCategory' => fn($query) => $query->where('status', 1)->where('slug', $category_slug)])
                ->whereHas('productCategory', fn ($query) =>
                    $query->where('slug', $category_slug)
            )->where('type_id', $type_id)->where('brand_id', $brand_id)->get();

            $singleProducttype = Producttype::where('id', $type_id)->first();
            // dd($products);
        }else{


            $products = Product::with(['productCategory' => fn($query) => $query->where('status', 1)->where('slug', $category_slug)])
                ->whereHas('productCategory', fn ($query) =>
                    $query->where('slug', $category_slug)
            )->where('brand_id', $brand_id)->get();

            // dd($products);

            $singleProducttype = array();
        }


        $categoryandType = ProductCategory::with('producttype')->where('status', 1)->get();
        $brand = Brand::limit(10)->get();
        $singleCategory = ProductCategory::where('slug', $category_slug)->first();

        // dd($products->toArray());

        return view('product_list', compact('title', 'products', 'categoryandType', 'brand', 'singleProducttype', 'singleCategory'));

    }

    public function product_details($product_slug){
        $title = '';
        $productDetails = Product::where('product_slug', $product_slug)->first();
        $brand = Brand::limit(10)->get();
        return view('product_details', compact('title', 'brand', 'productDetails'));
    }

    public function getattribute_items(Request $request){
        $attribute_items_id = $request->attribute_items_id;
        $productAttributeItem = ProductAttributeItem::where('id', $attribute_items_id)->first();

        if($productAttributeItem->product_id=='354'){
            $productAttributeItemImage = ProductAttributeItemImage::where('attribute_item_id', $attribute_items_id)->get();
        }else{
            // $productAttributeItemImage = ProductAttributeItemImage::where('attribute_item_id', $attribute_items_id)->orderBy('id', 'DESC')->limit(1)->get();
            $productAttributeItemImage = ProductAttributeItemImage::where('attribute_item_id', $attribute_items_id)->get();
        }



        $images = '';

        if(!empty($productAttributeItemImage)){

            $images = '<div id="big" class="owl-carousel owl-theme">';
            foreach ($productAttributeItemImage as $key => $value) {
                $images .= '<div class="item">
                                <div class="singleProductImage"><img src="'.asset("upload/product/images/".rawurlencode($value->image_name)).'" alt=""></div>
                            </div>';
            }
            $images .= '</div>';

            $images .= '<div id="thumbs" class="owl-carousel owl-theme">';
            foreach ($productAttributeItemImage as $key => $value) {
                $images .= '<div class="item">
                            <img src="'.asset("upload/product/images/".rawurlencode($value->image_name)).'" alt="">
                        </div>';
            }
            $images .= '</div>';



        }

        $htmls = '';
        $size_attribute = 0;
        if($productAttributeItem->name_attribute!=''){

            $htmls .= '<h6>Size</h6>';
            $sizesArray = explode(',', $productAttributeItem->name_attribute);
            $htmls .= '<ul class="row g-2">';
            foreach ($sizesArray as $size) {
                $htmls .= '<li class="col-auto"><button class="btn btn-outline-dark" onclick="attributeBtn_name(\''.$size.'\')" type="button">'.$size.'</button></li>';
            }
            $htmls .= '</ul>';
            $size_attribute = 1;
        }





        return response()->json([
            'status' => 1,
            'price' => $productAttributeItem->price,
            'name' => $productAttributeItem->name,
            'stock' => $productAttributeItem->stock,
            'images' => $images,
            'product_overview' => $productAttributeItem->product_overview,
            'sname_attribute_html' => $htmls,
            'size_attribute' => $size_attribute,
        ]);

    }

    public function viewSpecification(Request $request){
        $attribute_items_id = $request->attribute_items_id;
        $productAttributeItemSpecification = ProductAttributeItemSpecification::where('attribute_item_id', $attribute_items_id)->first();

        $productAttributeItem = ProductAttributeItem::where('id', $attribute_items_id)->first();

        $html = '<tr>
                    <td scope="row">Retrieve</td>
                    <td>'.$productAttributeItemSpecification->retrieve.'</td>
                </tr>
                <tr>
                    <td scope="row">Weight</td>
                    <td>'.$productAttributeItemSpecification->weight.'</td>
                </tr>
                <tr>
                    <td scope="row">Gear Ratio</td>
                    <td>'.$productAttributeItemSpecification->gear_ratio.'</td>
                </tr>
                <tr>
                    <td scope="row">Line Cap.</td>
                    <td>'.$productAttributeItemSpecification->line_cap.'</td>
                </tr>
                <tr>
                    <td scope="row">Bearings</td>
                    <td>'.$productAttributeItemSpecification->bearings.'</td>
                </tr>';

        return response()->json([
            'status' => 1,
            'html' => $html,
            'attribute_items_name' => $productAttributeItem->name,
        ]);

    }

    // public function custom_rods(){



    // }

}

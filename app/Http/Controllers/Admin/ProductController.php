<?php

namespace App\Http\Controllers\Admin;

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

use App\Imports\ProductImport;
use App\Models\ProductVariation;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function productcategory(){
        $productcategory = ProductCategory::orderBy('id', 'DESC')->paginate(15);
        return view('admin.product.productcategory', compact('productcategory'));
    }

    public function save_category(Request $request){

        $request->validate([
            'categoryimage' => 'image|mimes:jpeg,png,jpg,webp|max:500',
            'title' => 'required',
        ]);



        if($request->hasFile('categoryimage')){
            $filenameWithExt = $request->file('categoryimage')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('categoryimage')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $categoryimage_path = $request->file('categoryimage')->storeAs('public/images',$fileNameToStore);
            $input['categoryimage']=$fileNameToStore;
        }
        $input['title'] = $request->title;
        $input['slug']=Str::slug($request->title);
        $input['categorydesc']=$request->categorydesc;

        // dd($input);
        if($request->id==''){
            $productcategory = ProductCategory::create($input);
            $productCategoryId = $productcategory->id;

            if(!empty($request->brand)){
                for ($i=0; $i <count($request->brand) ; $i++) {
                    $brand['category_id']=$productCategoryId;
                    $brand['brand_id']=$request->brand[$i];
                    Catrgory_brand::create($brand);
                }
            }

            if($productcategory){
                return redirect()->back()->with('success', 'Category saved successfully');
            }else{
                return redirect()->back()->with('error', 'Something went wrong please try again after sometime');
            }
        }else{

            $productcategory = ProductCategory::where('id', $request->id)->update($input);

            Catrgory_brand::where('category_id', $request->id)->delete();

            if(!empty($request->brand)){
                for ($i=0; $i <count($request->brand) ; $i++) {
                    $brand['category_id']=$request->id;
                    $brand['brand_id']=$request->brand[$i];
                    Catrgory_brand::create($brand);
                }
            }

            if($productcategory){
                return redirect()->back()->with('success', 'Category updated successfully');
            }else{
                return redirect()->back()->with('error', 'Something went wrong please try again after sometime');
            }
        }
    }

    public function delete_productcategory($id){
        $productCategory = ProductCategory::where('id', $id)->delete();
        if($productCategory){
            return redirect()->back()->with('success', 'Category deleted successfully');
        }else{
            return redirect()->back()->with('error', 'Something went wrong please try again after sometime');
        }
    }

    public function productcategory_status(Request $request){
        $part = ProductCategory::where('id', $request->part_id)->first();

        if($part->status=='1'){
            $input['status']='0';
        }else{
            $input['status']='1';
        }
        // print_r($input);exit;
        ProductCategory::where('id', $request->part_id)->update($input);
        echo json_encode(['status'=>1, 'msg'=>'Status updated successfully']);
    }

    public function createproduct(){
        $productcategory = ProductCategory::orderBy('id', 'DESC')->get();
        $brand = Brand::orderBy('id', 'DESC')->get();
        return view('admin.product.createproduct', compact('productcategory', 'brand'));
    }

    public function save_product(Request $request){
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            //'product_img.*' => 'image|mimes:jpeg,png,jpg|max:500',
            'category_id' => 'required',
            // 'type_id' => 'required',
            'product_title' => 'required',
            // 'product_desc' => 'required',
            'is_variation' => 'required',
            //'product_price' => 'required',

        ]);

            if ($validator->fails()) {
                echo json_encode(['error'=>$validator->errors()->all()]);
                exit;
            }

            $input['category_id']=$request->category_id;
            // $input['type_id']=$request->type_id;
            // $input['brand_id']=$request->brand_id;
            $input['product_title']=$request->product_title;
            $input['product_slug']=Str::slug($request->product_title);
            $input['product_desc']=$request->product_desc;

            $input['is_variation']=$request->is_variation;
            $input['main_image_id']=$request->main_image_id;
            $input['main_image_name']=$request->main_image_name;
            $input['product_price']=$request->product_price;

            // $input['length']=$request->length;
            // $input['width']=$request->width;
            // $input['height']=$request->height;
            // $input['weight']=$request->weight;

            /* $input['product_price']=$request->product_price;
            $input['product_offerprice']=$request->product_offerprice; */

            $product = Product::create($input);
            $product_id=$product->id;

            $productimageArray = explode(',', $request->product_image_id);
            $productimageNameArray = explode(',', $request->product_image_name);
            foreach($productimageArray as $productimageKey=>$productimageValue){
                //Insert Product item image
                ProductImage::create([
                    'product_id' => $product_id,
                    'product_image_id' => $productimageValue,
                    'product_img' => $productimageNameArray[$productimageKey],
                ]);
            }

            if($request->is_variation=='0'){

                Product::where('id', $product_id)->update([
                    'product_offerprice' => $request->product_offerprice,
                ]);

            }else if($request->is_variation=='1'){

                if ($request->is_variation == 1 && $request->variation) {

                    $colors = $request->variation['color'] ?? [];
                    $sizes  = $request->variation['size'] ?? [];
                    $prices = $request->variation['price'] ?? [];

                    for ($i = 0; $i < count($colors); $i++) {

                        // skip empty rows
                        if (!$colors[$i] || !$sizes[$i] || !$prices[$i]) {
                            continue;
                        }

                        ProductVariation::create([
                            'product_id' => $product_id,
                            'color' => $colors[$i],
                            'size' => $sizes[$i],
                            'price' => $prices[$i],
                        ]);
                    }
                }
                
            }

        //return redirect()->back()->with('success', 'Product added successfully');
            die(json_encode(['status'=>1, 'msg'=>'Product added successfully']));
    }

    public function product_list(Request $request){
        // $products = Product::with(['productImage', 'productCategory'])->orderBy('id', 'DESC')->paginate(30);
        $products_query = Product::with(['productImage', 'productCategory']);

        if($request->category_id!=''){
            $products_query->where('category_id', $request->category_id);
        }

        if($request->product_name!=''){
            $products_query->where('product_title','LIKE','%'.$request->product_name.'%');

        }

        $products = $products_query->orderBy('id', 'desc')->paginate(30);



        $productCategory = ProductCategory::all();
        // dd($products);
        return view('admin.product.product_list', compact('products', 'productCategory'));
    }

    public function product_edit($id){
        $products = Product::with(['productImage', 'productCategory'])->where('id', $id)->first();
        $productcategory = ProductCategory::orderBy('id', 'DESC')->get();
        // dd($products);
        $brand = Brand::orderBy('id', 'DESC')->get();

        $variations = $products->variations; 
        return view('admin.product.product_edit', compact('products', 'productcategory', 'brand', 'variations'));
    }

    public function update_product(Request $request){

        // dd($request->all());

        $validator = Validator::make($request->all(), [
            //'product_img.*' => 'image|mimes:jpeg,png,jpg|max:500',
            'category_id' => 'required',
            'product_title' => 'required',
            'is_variation' => 'required',
            //'product_price' => 'required',

        ]);

            if ($validator->fails()) {
                echo json_encode(['error'=>$validator->errors()->all()]);
                exit;
            }

            $product_id = $request->product_id;

            $input['category_id']=$request->category_id;
            $input['type_id']=$request->type_id;
            $input['brand_id']=$request->brand_id;
            $input['product_title']=$request->product_title;
            $input['product_slug']=Str::slug($request->product_title);
            $input['product_desc']=$request->product_desc;

            $input['is_variation']=$request->is_variation;
            $input['main_image_id']=$request->main_image_id;
            $input['main_image_name']=$request->main_image_name;

            $input['length']=$request->length;
            $input['width']=$request->width;
            $input['height']=$request->height;
            $input['weight']=$request->weight;

            $input['product_price']=$request->product_price;

            $product = Product::where('id', $product_id)->update($input);
            $product_id=$product_id;

            $productimageArray = explode(',', $request->product_image_id);
            $productimageNameArray = explode(',', $request->product_image_name);
            // dd($productimageArray);
            if($request->product_image_name!=''){
                ProductImage::where('product_id', $product_id)->delete();
                foreach($productimageNameArray as $productimageKey=>$productimageValue){
                    //Insert Product item image
                    ProductImage::create([
                        'product_id' => $product_id,
                        'product_image_id' => '',
                        'product_img' => $productimageNameArray[$productimageKey],
                    ]);
                }
            }



            if($request->is_variation=='0'){

                Product::where('id', $product_id)->update([
                    'product_offerprice' => $request->product_offerprice,
                ]);

            }else if($request->is_variation=='1'){

                $variationIds = $request->variation['id'];

                foreach ($request->variation['price'] as $key => $price) {

                    $data = [
                        'color' => $request->variation['color'][$key],
                        'size'  => $request->variation['size'][$key],
                        'price' => $price,
                        'product_id' => $request->product_id,
                    ];

                    if (!empty($variationIds[$key])) {
                        // UPDATE
                        ProductVariation::where('id', $variationIds[$key])
                            ->update($data);
                    } else {
                        // INSERT NEW
                        ProductVariation::create($data);
                    }
                }

            }

            die(json_encode(['status'=>1, 'msg'=>'Product added successfully']));

    }

    public function create_catrgory(){
        $brand = Brand::orderBy('id', 'DESC')->get();
        return view('admin.product.addcategory', compact('brand'));
    }

    public function edit_productcategory($id){
        $brand = Brand::orderBy('id', 'DESC')->get();
        $productcategory = ProductCategory::with('catrgory_brand')->where('id', $id)->first();
        $catrgory_brand = Catrgory_brand::where('category_id', $id)->get();
        $select_brand=[];
        if(!empty($productcategory->catrgory_brand)){
            foreach ($productcategory->catrgory_brand as $key => $value) {
                $select_brand[]=$value->id;
            }
        }
        $producttype = Producttype::where('category_id', $id)->count();
        // dd($select_brand);
        return view('admin.product.edit_productcategory', compact('brand', 'productcategory', 'catrgory_brand', 'select_brand', 'producttype'));
    }

    public function producttype(){

        $producttype = Producttype::orderBy('id', 'DESC')->paginate(15);
        return view('admin.product.producttype', compact('producttype'));

    }

    public function create_type(){

        $productcategory = ProductCategory::orderBy('id', 'DESC')->get();
        return view('admin.product.create_type', compact('productcategory'));

    }

    public function save_type(Request $request){

        $request->validate([
            'categoryimage' => 'image|mimes:jpeg,png,jpg,webp|max:500',
            'category_id' => 'required',
            'typename' => 'required',

        ]);

        if($request->hasFile('typeimage')){
            $filenameWithExt = $request->file('typeimage')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('typeimage')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $typeimage_path = $request->file('typeimage')->storeAs('public/images',$fileNameToStore);
            $input['typeimage']=$fileNameToStore;
        }

        $input['category_id'] = $request->category_id;
        $input['typename'] = $request->typename;
        $input['typedesc'] = $request->typedesc;


        if($request->id==''){
            $producttype = Producttype::create($input);
            if($producttype){
                return redirect()->back()->with('success', 'Type saved successfully');
            }else{
                return redirect()->back()->with('error', 'Something went wrong please try again after sometime');
            }
        }else{
            $producttype = Producttype::where('id', $request->id)->update($input);
            if($producttype){
                return redirect()->back()->with('success', 'Type updated successfully');
            }else{
                return redirect()->back()->with('error', 'Something went wrong please try again after sometime');
            }
        }

    }

    public function edit_type($id){
        $productcategory = ProductCategory::orderBy('id', 'DESC')->get();
        $producttype = Producttype::where('id', $id)->first();
        return view('admin.product.edit_type', compact('producttype', 'productcategory'));
    }

    public function getType(Request $request){
        $category_id = $request->categort_id;
        $producttype = Producttype::where('category_id', $category_id)->get();
        $option = '<option value="">Select Type</option>';
        foreach ($producttype as $key => $value) {
            $option .='<option value="'.$value->id.'">'.$value->typename.'</option>';
        }
        echo $option;
    }

    public function listProductImages(Request $request){
        $images = AllImage::orderBy('id', 'DESC')->paginate(100);
        return view('admin.product.all_image', compact('images'));
    }

    public function imageUpload(Request $request){
        //dd($request->all());
        if($request->hasfile('image_names')) {
            foreach($request->file('image_names') as  $key => $file)
            {
                $name = $file->getClientOriginalName();
                $filename = pathinfo($name, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                $file->move(public_path('/upload/product/images'), $fileNameToStore);
                $input_image[$key]['image_name']= $fileNameToStore;
                $input_image[$key]['created_by']= Auth::user()->id;
                //ProductImage::create($input_image);
            }
            AllImage::insert($input_image);
        }
        return redirect()->back()->with('success', 'Imgae Upload successfully');
    }

    public function deleteImage(Request $request){
        //dd($request->all());
        if(count($request->image_names) > 0){
            AllImage::whereIn('id', $request->image_names)->delete();
        }
        return response()->json(['success'=>true,'msg'=>'Image Delete successfully.']);
        //$org->products()->whereIn('id', $ids)->delete();
    }
    public function ajaxAllProductImage_old(Request $request){
        // dd($request->all());
        $all_product_image = AllImage::orderBy('id', 'DESC')->limit(150)->get();
        //dd($all_product_image);

        $old_image = $request->old_image;
        $type = $request->type;

        $imageHtml = '';
        if(count($all_product_image)> 0){
            foreach($all_product_image as $image){
                if($request->select_image_type=='main_image'){
                    $imageHtml .= '<div class="col-xxl-1 col-xl-2 col-lg-2 col-md-2 col-sm-3 col-12"><div class="image-chk"><input type="radio" value="'.$image->id.'" name="mainimage" id="selectImg_'.$image->id.'" class="image_val"><label for="selectImg_'.$image->id.'"><img src='.asset("upload/product/images").'/'.rawurlencode($image->image_name).' alt=""><p>'.$image->image_name.'</p></label></div><input type="hidden" value="'.$image->image_name.'" name="mainimage_name" id="selectImgName_'.$image->id.'"></div>';
                }else{
                    $imageHtml .= '<div class="col-xxl-1 col-xl-2 col-lg-2 col-md-2 col-sm-3 col-12"><div class="image-chk"><input type="checkbox" value="'.$image->id.'" id="selectImg_'.$image->id.'" class="image_val"><label for="selectImg_'.$image->id.'"><img src='.asset("upload/product/images").'/'.rawurlencode($image->image_name).' alt=""><p>'.$image->image_name.'</p></label></div><input type="hidden" value="'.$image->image_name.'" id="selectImgName_'.$image->id.'"></div>';
                }
            }
        }
        return response()->json(['success'=>true,'html'=>$imageHtml, 'msg'=>'Image list successfully.']);
    }

    // public function ajaxAllProductImage(Request $request){
    //     $all_product_image = AllImage::orderBy('id', 'DESC')->limit(150)->get();
    //     $old_image = $request->old_image;
    //     $select_image_type = $request->select_image_type;

    //     $imageHtml = '';

    //     if (count($all_product_image) > 0) {
    //         foreach ($all_product_image as $image) {
    //             // Check if the image is in the list of old images
    //             $isChecked = in_array($image->image_name, explode(',', $old_image));

    //             $inputType = ($select_image_type == 'main_image') ? 'radio' : 'checkbox';

    //             $imageHtml .= '<div class="col-xxl-1 col-xl-2 col-lg-2 col-md-2 col-sm-3 col-12">';
    //             $imageHtml .= '<div class="image-chk">';
    //             $imageHtml .= '<input type="' . $inputType . '" value="' . $image->id . '" name="mainimage" id="selectImg_' . $image->id . '" class="image_val" ' . ($isChecked ? 'checked' : '') . '>';
    //             $imageHtml .= '<label for="selectImg_' . $image->id . '">';
    //             $imageHtml .= '<img src="' . asset("upload/product/images") . '/' . rawurlencode($image->image_name) . '" alt="">';
    //             $imageHtml .= '<p>' . $image->image_name . '</p>';
    //             $imageHtml .= '</label></div>';
    //             $imageHtml .= '<input type="hidden" value="' . $image->image_name . '" name="mainimage_name" id="selectImgName_' . $image->id . '"></div>';
    //         }
    //     }

    //     return response()->json(['success' => true, 'html' => $imageHtml, 'msg' => 'Image list successfully.']);
    // }

    public function ajaxAllProductImage(Request $request){
        $all_product_image = AllImage::orderBy('id', 'DESC')->get();
        $old_image = $request->old_image;
        $select_image_type = $request->select_image_type;

        $imageHtmlChecked = '';
        $imageHtmlUnchecked = '';

        if (count($all_product_image) > 0) {
            foreach ($all_product_image as $image) {
                // Check if the image is in the list of old images
                $isChecked = in_array($image->image_name, explode(',', $old_image));

                $inputType = ($select_image_type == 'main_image') ? 'radio' : 'checkbox';

                $imageHtml = '<div class="col-xxl-1 col-xl-2 col-lg-2 col-md-2 col-sm-3 col-12">';
                $imageHtml .= '<div class="image-chk">';
                $imageHtml .= '<input type="' . $inputType . '" value="' . $image->id . '" name="mainimage" id="selectImg_' . $image->id . '" class="image_val" ' . ($isChecked ? 'checked' : '') . '>';
                $imageHtml .= '<label for="selectImg_' . $image->id . '">';
                $imageHtml .= '<img src="' . asset("upload/product/images") . '/' . rawurlencode($image->image_name) . '" alt="">';
                $imageHtml .= '<p>' . $image->image_name . '</p>';
                $imageHtml .= '</label></div>';
                $imageHtml .= '<input type="hidden" value="' . $image->image_name . '" name="mainimage_name" id="selectImgName_' . $image->id . '"></div>';

                // Separate checked and unchecked images
                if ($isChecked) {
                    $imageHtmlChecked .= $imageHtml;
                } else {
                    $imageHtmlUnchecked .= $imageHtml;
                }
            }
        }

        // Combine checked and unchecked images
        $finalImageHtml = $imageHtmlChecked . $imageHtmlUnchecked;

        return response()->json(['success' => true, 'html' => $finalImageHtml, 'msg' => 'Image list successfully.']);
    }





    public function search_all_product_image(Request $request){
        $searchval = $request->searchval;
        $all_product_image = AllImage::where('image_name', 'LIKE', '%'.$searchval.'%')->get();
        //dd($all_product_image);
        $imageHtml = '';
        if(count($all_product_image)> 0){
            foreach($all_product_image as $image){
                if($request->select_image_type=='main_image'){
                    $imageHtml .= '<div class="col-xxl-1 col-xl-2 col-lg-2 col-md-2 col-sm-3 col-12"><div class="image-chk"><input type="radio" value="'.$image->id.'" name="mainimage" id="selectImg_'.$image->id.'" class="image_val"><label for="selectImg_'.$image->id.'"><img src='.asset("upload/product/images").'/'.rawurlencode($image->image_name).' alt=""><p>'.$image->image_name.'</p></label></div><input type="hidden" value="'.$image->image_name.'" name="mainimage_name" id="selectImgName_'.$image->id.'"></div>';
                }else{
                    $imageHtml .= '<div class="col-xxl-1 col-xl-2 col-lg-2 col-md-2 col-sm-3 col-12"><div class="image-chk"><input type="checkbox" value="'.$image->id.'" id="selectImg_'.$image->id.'" class="image_val"><label for="selectImg_'.$image->id.'"><img src='.asset("upload/product/images").'/'.rawurlencode($image->image_name).' alt=""><p>'.$image->image_name.'</p></label></div><input type="hidden" value="'.$image->image_name.'" id="selectImgName_'.$image->id.'"></div>';
                }
            }
        }
        return response()->json(['success'=>true,'html'=>$imageHtml, 'msg'=>'Image list successfully.']);
    }


    public function upload_file(){
        return view('admin.product.upload_file');
    }


    public function import_excel(Request $request)
    {
        $file = $request->file('excel_file');

        Excel::import(new ProductImport, $file);

        return redirect()->back()->with('success', 'Product imported successfully!');
    }

    public function delete_type($id){

        Producttype::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Type Delete successfully.');

    }

    public function custom_rod(){
        $customrods = Customrods::orderBy('id', 'DESC')->paginate(50);
        return view('admin.product.custom_rod', compact('customrods'));
    }

    public function save_customrod_images(Request $request){
        $productimageArray = explode(',', $request->product_image_id);
        $productimageNameArray = explode(',', $request->product_image_name);
        foreach($productimageArray as $productimageKey=>$productimageValue){
            //Insert Product item image
            Customrods::create([
                'image_name' => $productimageNameArray[$productimageKey],
            ]);
        }

        return redirect()->back()->with('success', 'Image uploaed successfully.');
    }

    public function delete_product($id){
        Product::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Product deleted successfully');
    }

    public function delete_product_attribute_items(Request $request){

        $productAttributeItem = ProductAttributeItem::where('product_id', $request->product_id)->get();

        if(count($productAttributeItem)==1){
            return response()->json([
                'status' => 0,
                'msg' => 'Unable to delete minimum one item required',
            ]);
        }else{
            ProductAttributeItem::where('id', $request->product_attribute_items_id)->delete();
            return response()->json([
                'status' => 1,
                'msg' => 'Success',
            ]);
        }

    }

    public function delete_product_variation(Request $request)
    {
        $variation = ProductVariation::find($request->id);

        if($variation){
            $variation->delete();
            return response()->json(['status' => 1]);
        }

        return response()->json(['status' => 0]);
    }



}

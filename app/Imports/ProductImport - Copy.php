<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;


use App\Models\ProductCategory;
use App\Models\Producttype;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeItem;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows){
        // dd($rows);
        foreach ($rows as $key => $row) {

            if($key!=0){


                if($row[0]!='' && $row[2]!='' && $row[3]!=''){

                    $category_check = ProductCategory::where('title', $row[0])->first();

                    $category['title'] = $row[0];
                    $category['slug']=Str::slug($row[0]);

                    if(empty($category_check)){
                        $productcategory = ProductCategory::create($category);
                        $productCategoryId = $productcategory->id;
                    }else{
                        $productCategoryId = $category_check->id;
                    }

                    if($row[1]!=''){

                        $type_check = Producttype::where('category_id', $productCategoryId)->where('typename', $row[1])->first();

                        $inputType['category_id'] = $productCategoryId;
                        $inputType['typename'] = $row[1];

                        if(empty($type_check)){
                            $producttype = Producttype::create($inputType);
                            $inputTypeId = $producttype->id;
                        }else{
                            $inputTypeId = $type_check->id;
                        }

                    }else{
                        $inputTypeId = NULL;
                    }

                    $brand_check = Brand::where('brandname', $row[2])->first();
                    $input_brand['brandname'] = $row[2];
                    if(empty($brand_check)){
                        $brand = Brand::create($input_brand);
                        $brandId = $brand->id;
                    }else{
                        $brandId = $brand_check->id;
                    }

                    $check_product = Product::where('product_title', $row[3])->first();

                    $input_product['category_id']=$productCategoryId;
                    $input_product['type_id']=$inputTypeId;
                    $input_product['brand_id']=$brandId;
                    $input_product['product_title']=$row[3];
                    $input_product['product_slug']=Str::slug($row[3]);


                    if($row[6]!=''){
                        $input_product['is_variation']='1';
                    }else{
                        $input_product['is_variation']='0';
                        $input_product['product_price']=$row[4];
                        $input_product['product_offerprice']=$row[5];
                    }


                    if(empty($check_product)){
                        // dd($input_product);
                        $products = Product::create($input_product);
                        $product_id = $products->id;

                        if($row[6]!=''){
                            $checkSingleAttribute = ProductAttribute::where('product_id', $product_id)->where('name', $row[6])->first();
                            if(empty($checkSingleAttribute)){
                                $product_attribute = ProductAttribute::create([
                                    'product_id' => $product_id,
                                    'name' => $row[6]
                                ]);
                                $product_attribute_id = $product_attribute->id;
                            }else{
                                $product_attribute_id = $checkSingleAttribute->id;
                            }

                            $product_attribute_item = ProductAttributeItem::create([
                                'product_id' => $product_id,
                                'attribute_id' => $product_attribute_id,
                                'name' => $row[7],
                                'stock' => $row[9],
                                'price' => $row[8],
                            ]);
                        }

                        // exit;
                    }else{
                        if($row[6]==''){
                            Product::where('id', $check_product->id)->update($input_product);
                        }else{
                            $checkSingleAttribute = ProductAttribute::where('product_id', $check_product->id)->where('name', $row[6])->first();
                            if(empty($checkSingleAttribute)){
                                $product_attribute = ProductAttribute::create([
                                    'product_id' => $check_product->id,
                                    'name' => $row[6]
                                ]);
                                $product_attribute_id = $product_attribute->id;
                            }else{
                                $product_attribute_id = $checkSingleAttribute->id;
                            }

                            $product_attribute_item = ProductAttributeItem::create([
                                'product_id' => $check_product->id,
                                'attribute_id' => $product_attribute_id,
                                'name' => $row[7],
                                'stock' => $row[9],
                                'price' => $row[8],
                            ]);

                        }
                    }

                }


            }

        }



    }
}

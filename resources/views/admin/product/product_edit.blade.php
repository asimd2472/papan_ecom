@extends('layouts.admin')
@section('content')
<div class="bedcrumb-wrap row justify-content-between align-items-center">
    <div class="col-auto">
        <div class="page-name">Update Product</div>
    </div>
    <div class="col-auto">
        <div class="bedcrumb-list">
            <ul class="d-flex">
                <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                <li>Update Product</li>
            </ul>
        </div>
    </div>
  </div>
<div class="content-wraper">
    <form id="updateProductform" method="post" enctype="multipart/form-data">
        <div class="row g-3">
            <div class="col-12">
                <div class="input-wrap">
                    <label class="lable-head">Title <sup class="star-mark">*</sup></label>
                    <input type="text" class="form-control input-style" onkeyup="getblogTitle(this.value)" name="product_title" id="product_title" placeholder="Title" value="{{$products->product_title}}" required>
                    @error('product_title')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="select-wrap">
                    <label class="lable-head">Category <sup class="star-mark">*</sup></label>
                    <select name="category_id" id="category_id" class="form-control input-style" onchange="getType(this.value)" required>
                            <option value="">Select Category</option>
                        @foreach ($productcategory as $item)
                            <option value="{{$item->id}}" @if($item->id==$products->category_id) selected @endif>{{$item->title}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <input type="hidden" name="product_id" value="{{$products->id}}">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="select-wrap">
                    <label class="lable-head">Type</label>
                    <select name="type_id" id="type_id" class="form-control input-style">
                        <option value="{{@$products->Producttype->id}}">{{@$products->Producttype->typename}}</option>
                    </select>
                    @error('type_id')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-xxl-12 col-lg-10 col-md-12 col-sm-12 col-12">
                <div class="input-wrap">
                    <label class="lable-head">Select Brand</label>
                    <ul class="image-checkbox">
                        @foreach ($brand as $key=>$item)
                            <li>
                                <input type="radio" id="myCheckbox{{$key}}" name="brand_id" value="{{$item->id}}" @if($products->brand_id==$item->id) checked @endif/>
                                <label for="myCheckbox{{$key}}"><img src="{{asset('storage/images/'.$item->brandimage)}}" /></label>
                                <span>{{$item->brandname}}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="input-wrap">
                    <label class="lable-head">Select Main Image<sup class="star-mark">*</sup></label>
                    <button type="button" class="img-select-btn select_image"  data-row_id="main_image" data-old_image="{{$products->main_image_name}}" data-type="update">select main image</button>
                    <input type="hidden" name="main_image_id" id="main_image_id" value="">
                    <input type="hidden" name="main_image_name" id="main_image_name" value="{{$products->main_image_name}}">
                </div>
            </div>
            @php

                // dd($products->productImage);
                if(!empty($products->productImage)){
                    $imageArrays[]='';
                    $imageArraysimage_id[]='';
                    foreach ($products->productImage as $key => $valueproductImage) {
                        $imageArrays[]= $valueproductImage->product_img;
                        $imageArraysimage_id[]= $valueproductImage->product_image_id;
                    }
                    $imageStrings = implode(',', $imageArrays);
                    $imageStrings = ltrim($imageStrings, ',');

                    $imageStringsimage_id = implode(',', $imageArraysimage_id);
                    $imageStringsimage_id = ltrim($imageStringsimage_id, ',');
                    // dd($imageString);
                }else{
                    $imageStrings = '';
                    $imageStringsimage_id = '';
                }

            @endphp
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="input-wrap">
                    <label class="lable-head">Select Product Image<sup class="star-mark">*</sup></label>
                    <button type="button" class="img-select-btn select_image"  data-row_id="product_images" data-old_image="{{$imageStrings}}" data-type="update">select product image</button>
                    <input type="hidden" name="product_image_id" id="product_image_id" value="">
                    <input type="hidden" name="product_image_name" id="product_image_name" value="{{$imageStrings}}">
                </div>
            </div>

            {{-- <div class="col-xxl-12 col-lg-10 col-md-12 col-sm-12 col-12">
                <div class="admin-input-wrap">
                    <label class="lable-head">Image Upload <sup class="star-mark">*</sup> [Image should be less than 500kb | Dimensions 367x309 | accept only jpg, jpeg, png]</label>
                    <div class="d-flex upload_box">
                        <div class="product-up">
                            <input type="file" name="product_img[]" id="product-img" data-max_length="" class="upload_inputfile" multiple required>
                            <label for="product-img" class="file-lbl">
                                <span>
                                    <i class="fa-solid fa-upload"></i>
                                </span>
                            </label>
                        </div>
                        <div class="product-up-show file-scroll upload_img_wrap">
                            <span id="show_image"></span>

                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="input-wrap">
                    <label class="lable-head">Is Variation <sup class="star-mark">*</sup></label>
                    <div class="form-check">
                        <input class="form-check-input" value="0" type="radio" name="is_variation" id="flexRadioDefault1" @if($products->is_variation=='0') checked @endif required>
                        <label class="form-check-label" for="flexRadioDefault1">
                          No
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="1" name="is_variation" id="flexRadioDefault2" @if($products->is_variation=='1') checked @endif required>
                        <label class="form-check-label" for="flexRadioDefault2">
                          Yes
                        </label>
                    </div>
                    @error('is_variation')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row g-3" id="with_out_variation" @if($products->is_variation=='1') style="display: none" @endif>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="input-wrap">
                        <label class="lable-head">Original Price <sup class="star-mark">*</sup></label>
                        <input type="text" class="form-control input-style isnumber required_no" name="product_price" id="product_price" value="{{$products->product_price}}" placeholder="Price">
                        @error('product_price')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="input-wrap">
                        <label class="lable-head">Selling Price <sup class="star-mark">*</sup></label>
                        <input type="text" class="form-control input-style isnumber required_no" name="product_offerprice" id="product_offerprice" value="{{$products->product_offerprice}}" placeholder="Discount Price">
                        @error('product_offerprice')
                            <span class="error">{{ $message }}</span>
                        @enderror
                        <span class="error" id="error_message"></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="input-wrap">
                        <label class="lable-head">Stock <sup class="star-mark">*</sup></label>
                        <input type="text" class="form-control input-style isnumber required_no" name="product_stock" id="product_stock" placeholder="Stock" value="{{$products->product_stock}}">
                        @error('product_stock')
                            <span class="error">{{ $message }}</span>
                        @enderror
                        <span class="error" id="error_message"></span>
                    </div>
                </div>
            </div>
            <div class="col-12" id="with_variation" @if($products->is_variation=='0') style="display: none" @endif>
                <div class="dashboard-white-box">
                    <div class="white-box-head">
                        <h3>variation</h3>
                    </div>
                    @if(!empty($products->ProductAttribute))
                    @foreach ($products->ProductAttribute as $item)
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="input-wrap">
                                <label class="lable-head">Type <sup class="star-mark">*</sup></label>
                                <input type="text" class="form-control input-style required_field" name="attribute[{{$item->id}}][attribute_name]" id="" value="{{$item->name}}" placeholder="e.g : Profishiency Casting Reels">
                                <input type="hidden" name="" id="attribute_name_id" value="{{$item->id}}">
                            </div>
                        </div>
                    </div>


                    <div class="variation-wrap">
                    @if(!empty($products->ProductAttributeItem))
                    @foreach ($products->ProductAttributeItem as $keys=>$itemProductAttributeItem)


                            <div class="variation-box" id="variation-box{{$itemProductAttributeItem->id}}">
                                <div class="delete-variation-btn">
                                    <button type="button" class="delete-more-varitaion delete_variation_update" onclick="delete_Item({{$products->id}},{{$itemProductAttributeItem->id}})"><i class="fa-regular fa-trash-can"></i></button>
                                </div>
                                <div class="row g-3">
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                        <div class="input-wrap">
                                            <label class="lable-head">Name <sup class="star-mark">*</sup></label>
                                            <input type="text" class="form-control input-style required_field" name="attribute[{{$item->id}}][item][{{$itemProductAttributeItem->id}}][name]" id="" value="{{$itemProductAttributeItem->name}}" placeholder="e.g : P413641LR" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                        <div class="input-wrap">
                                            <label class="lable-head">Attribute (use ",")</label>
                                            <input type="text" class="form-control input-style required_field" name="attribute[{{$item->id}}][item][{{$itemProductAttributeItem->id}}][name_attribute]" id="" value="{{$itemProductAttributeItem->name_attribute}}" placeholder="e.g : XS,XXL">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-6 col-sm-12 col-12">
                                        <div class="input-wrap">
                                            <label class="lable-head">Stock <sup class="star-mark">*</sup></label>
                                            <input type="number" class="form-control input-style required_field" name="attribute[{{$item->id}}][item][{{$itemProductAttributeItem->id}}][stock]" id="" value="{{$itemProductAttributeItem->stock}}" placeholder="Stock" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-6 col-sm-12 col-12">
                                        <div class="input-wrap">
                                            <label class="lable-head">Price <sup class="star-mark">*</sup></label>
                                            <input type="number" class="form-control input-style required_field" name="attribute[{{$item->id}}][item][{{$itemProductAttributeItem->id}}][price]" id="" value="{{$itemProductAttributeItem->price}}" placeholder="Price" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-6 col-sm-12 col-12">

                                        @php
                                            $imageArray = ['']; // Initialize the array for each iteration
                                            $imageIdArray = [''];
                                            foreach ($itemProductAttributeItem->ProductAttributeItemImage as $key => $value) {
                                                $imageArray[] = $value->image_name;
                                                $imageIdArray[] = $value->image_id;
                                            }
                                            $imageString = implode(',', $imageArray);
                                            $imageString = ltrim($imageString, ',');

                                            $imageStringId = implode(',', $imageIdArray);
                                            $imageStringId = ltrim($imageStringId, ',');

                                        @endphp
                                        <div class="select-btn-img">
                                            <label class="lable-head">select image <sup class="star-mark">*</sup></label>
                                            <button type="button" class="img-select-btn select_image"  data-row_id="{{$keys}}" data-old_image="{{$imageString}}" data-type="update">select image</button>
                                        </div>
                                        {{-- <input type="hidden" name="attribute[{{$item->id}}][item][{{$itemProductAttributeItem->id}}][images]" id="selected_imgArr_{{$keys}}">
                                        <input type="hidden" name="attribute[{{$item->id}}][item][{{$itemProductAttributeItem->id}}][images_name]" id="selected_imgNameArr_{{$keys}}" value=""> --}}

                                        <input type="hidden" name="attribute[{{$item->id}}][item][{{$itemProductAttributeItem->id}}][images]" id="selected_imgArr_{{$keys}}" value="{{$imageStringId}}">
                                        <input type="hidden" name="attribute[{{$item->id}}][item][{{$itemProductAttributeItem->id}}][images_name]" id="selected_imgNameArr_{{$keys}}" value="{{$imageString}}">

                                    </div>
                                    <div class="col-12">
                                        <div class="white-box-head-small">
                                            <h3>Overview</h3>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="input-wrap">
                                                    <textarea class="form-control input-style product_overview" name="attribute[{{$item->id}}][item][{{$itemProductAttributeItem->id}}][product_overview]" id="">{!!$itemProductAttributeItem->product_overview!!}</textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        @php
                            $last_item_row = $itemProductAttributeItem->id;
                        @endphp
                    @endforeach
                    <input type="hidden" id="last_item_row" value="{{$last_item_row}}">
                    @endif
                    </div>
                    @endforeach
                    @endif

                    <div class="add-variation-btn">

                        <button type="button" class="add-more-varitaion add_variation"><i class="fa-solid fa-plus"></i>add more</button>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="input-wrap">
                    <label class="lable-head">Description <sup class="star-mark">*</sup></label>
                    <textarea name="product_desc" id="product_desc" class="">{!! $products->product_desc !!}</textarea>
                    @error('product_desc')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <input type="hidden" name="id" value="">

            @csrf

            <div class="col-md-3 mt-3">
                <div class="input-wrap">
                    <label class="lable-head">Length (in Inches)</label>
                    <input type="text" class="form-control input-style isnumber" name="length" id="length" placeholder="Length" value="{{$products->length}}" required>
                    @error('length')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-3 mt-3">
                <div class="input-wrap">
                    <label class="lable-head">Width (in Inches)</label>
                    <input type="text" class="form-control input-style isnumber" name="width" id="width" placeholder="Width" value="{{$products->width}}" required>
                    @error('width')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-3 mt-3">
                <div class="input-wrap">
                    <label class="lable-head">Height (in Inches)</label>
                    <input type="text" class="form-control input-style isnumber" name="height" id="height" placeholder="Height" value="{{$products->height}}" required>
                    @error('height')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-3 mt-3">
                <div class="input-wrap">
                    <label class="lable-head">Weight (in Pounds)</label>
                    <input type="text" class="form-control input-style isnumber" name="weight" id="weight" placeholder="Weight" value="{{$products->weight}}" required>
                    @error('weight')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="input-wrap">
                    <button class="dark-btn-B" type="submit" id="categoryBtn">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Modal image gallery -->
<div class="modal fade image-gallery-modal" id="imageGallery" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Image Gallery</h5>
          <div class="d-flex">
            <div class="input-wrap">
                <input type="text" class="form-control input-style" onkeyup="searchImage(this.value)" name="" id="searchImagename" placeholder="Search">
            </div>
            <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
        </div>
        <div class="modal-body">
          <div class="gallery-list">
            <input type="hidden" id="attr_row_id" value="">
            <div class="row g-3" id="image_list">

                {{-- <div class="col-xxl-1 col-xl-2 col-lg-2 col-md-2 col-sm-3 col-12">
                    <div class="image-chk">
                        <input type="checkbox" id="selectImg">
                        <label for="selectImg">
                            <img src={{ Vite::asset('resources/front/images/gallery/1.jpg')}} alt="">
                            <p>image name</p>
                        </label>
                    </div>
                </div> --}}
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="gallery-save" id="submit_image_btn">save</button>
        </div>
      </div>
    </div>
</div>


<input type="hidden" value="" name="select_image_type" id="select_image_type">




<style>
    .image-checkbox {
      list-style-type: none;
    }

    .image-checkbox li {
      display: inline-block;
    }

    .image-checkbox input[type="radio"][id^="myCheckbox"] {
      display: none;
    }

    .image-checkbox label {
      border: 1px solid #fff;
      padding: 10px;
      display: block;
      position: relative;
      margin: 10px;
      cursor: pointer;
    }

    .image-checkbox label:before {
      background-color: white;
      color: white;
      content: " ";
      display: block;
      border-radius: 50%;
      border: 1px solid #F2958D;
      position: absolute;
      top: -5px;
      left: -5px;
      width: 25px;
      height: 25px;
      text-align: center;
      line-height: 28px;
      transition-duration: 0.4s;
      transform: scale(0);
    }

    .image-checkbox label img {
      height: 70px;
      width: 70px;
      transition-duration: 0.2s;
      transform-origin: 50% 50%;
    }

    .image-checkbox input:checked + label {
      border-color: #ddd;
    }

    .image-checkbox input:checked + label:before {
      content: "✓";
      background-color: #F2958D;
      transform: scale(1);
    }

    .image-checkbox input:checked + label img {
      transform: scale(0.9);
      /* box-shadow: 0 0 5px #333; */
      z-index: -1;
    }
    </style>

@endsection
@push('scripts')

<script type="module">
    var attribute_name_id = $("#attribute_name_id").val();
    var last_item_row = $("#last_item_row").val();
    var i = parseInt(last_item_row)+1;
    $(document).on('click', '.add_variation', function(){
        ++i;
        $(".variation-wrap").append(`
            <div class="variation-box">
                <div class="delete-variation-btn">
                    <button type="button" class="delete-more-varitaion delete_variation"><i class="fa-regular fa-trash-can"></i></button>
                </div>
                <div class="row g-3">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <div class="input-wrap">
                            <label class="lable-head">Name <sup class="star-mark">*</sup></label>
                            <input type="text" class="form-control input-style required_field" name="attribute[` + attribute_name_id + `][item][` + i + `][name]" id="" placeholder="e.g : P413641LR">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <div class="input-wrap">
                            <label class="lable-head">Attribute (use ",")</label>
                            <input type="text" class="form-control input-style" name="attribute[` + attribute_name_id + `][item][` + i + `][name_attribute]" id="" placeholder="e.g : XS,XXL">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 col-12">
                        <div class="input-wrap">
                            <label class="lable-head">Stock <sup class="star-mark">*</sup></label>
                            <input type="number" class="form-control input-style required_field" name="attribute[` + attribute_name_id + `][item][` + i + `][stock]" id="" placeholder="Stock">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 col-12">
                        <div class="input-wrap">
                            <label class="lable-head">Price <sup class="star-mark">*</sup></label>
                            <input type="number" class="form-control input-style required_field" name="attribute[` + attribute_name_id + `][item][` + i + `][price]" id="" placeholder="Price">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 col-12">
                        <div class="select-btn-img">
                            <label class="lable-head">select image <sup class="star-mark">*</sup></label>
                            <button type="button" class="img-select-btn select_image" data-row_id="` + i + `" data-old_image="" data-type="add">select image</button>
                        </div>
                        <input type="hidden" name="attribute[` + attribute_name_id + `][item][` + i + `][images]" id="selected_imgArr_`+i+`">
                        <input type="hidden" name="attribute[` + attribute_name_id + `][item][` + i + `][images_name]" id="selected_imgNameArr_`+i+`">
                    </div>
                    <div class="col-12">
                        <div class="white-box-head-small">
                            <h3>Overview</h3>
                        </div>
                        <div class="row g-3">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="input-wrap">
                                    <textarea class="form-control input-style product_overview" name="attribute[` + attribute_name_id + `][item][` + i + `][product_overview]" id=""></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        `);

        $('.product_overview').summernote({
            height: 100,
        });
    });
    $(document).on('click', '.delete_variation', function(){
        $(this).closest(".variation-box").remove();
    });


</script>
<script type="module">

    $(document).ready(function() {
        if (window.File && window.FileList && window.FileReader) {
            $("#product-img").on("change", function(e) {
            var files = e.target.files,
                filesLength = files.length;
            for (var i = 0; i < filesLength; i++) {
                var f = files[i]
                var fileReader = new FileReader();
                fileReader.onload = (function(e) {
                var file = e.target;
                $("<div class=\"show-img\">" +
                    "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                    "<button type=\"button\" class=\"img-close\"><i class=\"fa-solid fa-xmark\"></i></button>" +
                    "</div>").insertAfter("#show_image");
                $(".img-close").click(function(){
                    $(this).parent(".show-img").remove();
                });

                // Old code here
                /*$("<img></img>", {
                    class: "imageThumb",
                    src: e.target.result,
                    title: file.name + " | Click to remove"
                }).insertAfter("#files").click(function(){$(this).remove();});*/

                });
                fileReader.readAsDataURL(f);
            }
            console.log(files);
            });
        } else {
            alert("Your browser doesn't support to File")
        }
    });
    $(document).ready(function(){
        const gallery_modal  = document.getElementById('imageGallery');
        const image_gallery_modal = new Modal(gallery_modal);

        $(document).on('click','.select_image',function(){
            image_gallery_modal.show(); //Image gallery Modal open
            $("#imageGallery #attr_row_id").val($(this).data("row_id"));
            //console.log($(this).data("row_id"));
            var select_image_type = $(this).data("row_id");
            $("#select_image_type").val(select_image_type);
            $('.loaderwraper-main').attr("style", "display:block");


            var old_image = $(this).data("old_image");
            var type = $(this).data("type");


            $.ajax({
                url: "{{route('admin.all_product_image')}}",
                type: "get",
                data:{select_image_type:select_image_type, old_image:old_image, type:type},
                dataType: 'json',
                success: function(result) {
                    //console.log(result);
                    $('#image_list').html(result.html);
                    $('.loaderwraper-main').attr("style", "display:none");
                    //$('#imageGallery').modal('show');
                    //$('#imageGallery').show();
                    //console.log(result.sub_categories);
                    /* $.each(result.sub_categories, function(key, value) {
                        var selected = '';
                        if (value.id == cource_details.sub_category_id) {
                            selected = 'selected';
                        }
                        $("#sub_category_idInput").append('<option value="' + value
                            .id + '" ' + selected + '>' + value.name + '</option>');
                    }); */

                }
            });
        });

        // $(document).on('click','.select_image',function(){
        //     image_gallery_modal.show();
        //     asdtest();
        // });


        var imageArray = [];
        var imageNameArray = [];
        $('#submit_image_btn').on('click', function(e) {

            image_gallery_modal.hide(); //Image gallery Modal close
            var row = $('#attr_row_id').val();
            //console.log($('#attr_row_id').val());

            // console.log(row);

            imageArray = [];
            imageNameArray = [];

            if(row=='main_image'){
                var image_id = $('input[type=radio][name=mainimage]:checked').val();
                $("#main_image_id").val(image_id);
                $("#main_image_name").val($('#selectImgName_'+image_id).val());
            }else{
                $('.image_val').each(function() {
                    if ($(this).is(":checked"))
                    {
                        imageArray.push($(this).val());
                        imageNameArray.push($('#selectImgName_'+$(this).val()).val()) ;
                    }
                });
            }

            if(row=='product_images'){
                $('#product_image_id').val(imageArray);
                $('#product_image_name').val(imageNameArray);
            }else{
                console.log(row);
                $('#selected_imgArr_'+row).val(imageArray);
                $('#selected_imgNameArr_'+row).val(imageNameArray);
                //console.log(imageNameArray);
            }

            $("#searchImagename").val("");


        });

        //Variation radio change event
        $('input[type=radio][name=is_variation]').change(function() {
            if (this.value == 0) {

                $('.required_no').prop('required', true);
                $('.required_field').removeAttr('required');

                $('#with_out_variation').show();
                $('#with_variation').hide();
            }
            else if (this.value == 1) {
                $('.required_no').removeAttr('required');
                $('.required_field').prop('required', true);

                $('#with_out_variation').hide();
                $('#with_variation').show();
            }
        });



    });

    window.searchImage = function(val) {
        var select_image_type = $("#select_image_type").val();
        $.ajax({
            url: "{{route('admin.search_all_product_image')}}",
            type: "get",
            data:{select_image_type:select_image_type,searchval:val},
            dataType: 'json',
            success: function(result) {
                //console.log(result);
                $('#image_list').html(result.html);
                $('.loaderwraper-main').attr("style", "display:none");

            }
        });

    }


    window.delete_Item = function(product_id, val) {
        $.ajax({
            url: "{{route('admin.delete_product_attribute_items')}}",
            type: "get",
            data:{product_attribute_items_id:val, product_id:product_id},
            dataType: 'json',
            success: function(result) {
                if(result.status==1){
                    $("#variation-box"+val).remove();
                }else if(result.status==0){
                    alert(result.msg);
                }

            }
        });
    }











</script>


<style>
    .note-editor .note-editing-area {
        position: relative !important;
        background-color: #fff !important;
    }
    .note-editable ul{
      list-style: disc !important;
      list-style-position: inside !important;
    }

    .note-editable ol {
      list-style: decimal !important;
      list-style-position: inside !important;
    }
</style>


@endpush



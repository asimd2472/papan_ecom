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
                <div class="input-wrap">
                    <label class="lable-head">Original Price <sup class="star-mark">*</sup></label>
                    <input type="text" class="form-control input-style isnumber required_no" name="product_price" id="product_price" placeholder="Price" required value="{{$products->product_price}}">
                    @error('product_price')
                        <span class="error">{{ $message }}</span>
                    @enderror
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
                
                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="input-wrap">
                        <label class="lable-head">Selling Price <sup class="star-mark">*</sup></label>
                        <input type="text" class="form-control input-style isnumber required_no" name="product_offerprice" id="product_offerprice" placeholder="Discount Price" value="{{$products->product_offerprice}}">
                        @error('product_offerprice')
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

                    <div id="variation_container">

                        @if(!empty($variations) && count($variations) > 0)
                            @foreach($variations as $key => $variation)
                            <div class="variation-box row mb-3 align-items-center" id="variation-box{{$variation->id}}">

                                <!-- Hidden ID (IMPORTANT for update) -->
                                <input type="hidden" name="variation[id][]" value="{{$variation->id}}">

                                <!-- Color -->
                                <div class="col-md-3 d-flex align-items-center">
                                    <input type="color" name="variation[color][]" 
                                        class="form-control form-control-color me-2"
                                        value="{{$variation->color}}">
                                    <span class="color-code">{{$variation->color}}</span>
                                </div>

                                <!-- Size -->
                                <div class="col-md-3">
                                    <input type="text" name="variation[size][]" 
                                        class="form-control"
                                        value="{{$variation->size}}">
                                </div>

                                <!-- Price -->
                                <div class="col-md-3">
                                    <input type="number" name="variation[price][]" 
                                        class="form-control"
                                        value="{{$variation->price}}">
                                </div>

                                <!-- Delete -->
                                <div class="col-md-3">
                                    <button type="button" 
                                        class="btn btn-danger delete_old_variation"
                                        data-id="{{$variation->id}}">
                                        X
                                    </button>
                                </div>

                            </div>
                            @endforeach
                        @endif

                    </div>
                    
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

    var i = 0;
    
    $(document).on('click', '.delete_variation', function(){
        $(this).closest(".variation-box").remove();
    });

    $(document).on('click', '.add_variation', function () {

        let html = `
        <div class="variation-box row mb-3 align-items-center">

            <!-- New item (no id) -->
            <input type="hidden" name="variation[id][]" value="">

            <div class="col-md-3 d-flex align-items-center">
                <input type="color" name="variation[color][]" class="form-control form-control-color me-2" value="#000000">
                <span class="color-code">#000000</span>
            </div>

            <div class="col-md-3">
                <input type="text" name="variation[size][]" class="form-control" placeholder="Size">
            </div>

            <div class="col-md-3">
                <input type="number" name="variation[price][]" class="form-control" placeholder="Price">
            </div>

            <div class="col-md-3">
                <button type="button" class="btn btn-danger delete_variation">X</button>
            </div>

        </div>
        `;

        $('#variation_container').append(html);
    });


    $(document).on('click', '.delete_old_variation', function(){

        let id = $(this).data('id');
        let row = $(this).closest('.variation-box');

        if(confirm("Are you sure?")) {
            $.ajax({
                url: "{{route('admin.delete_product_variation')}}",
                type: "POST",
                data: {
                    id: id,
                    _token: "{{csrf_token()}}"
                },
                success: function(res){
                    if(res.status == 1){
                        row.remove();
                    }else{
                        alert("Failed to delete");
                    }
                }
            });
        }

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



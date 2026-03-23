@extends('layouts.admin')
@section('content')
<div class="bedcrumb-wrap row justify-content-between align-items-center">
    <div class="col-auto">
        <div class="page-name">All Image List</div>
    </div>
    <div class="col-auto">
        <div class="bedcrumb-list">
            <ul class="d-flex">
                <li><a href="{{route('admin.all_image')}}">Image List</a></li>
                <li>Image List</li>
            </ul>
        </div>
    </div>
  </div>

<div class="content-wraper">
    <form action="{{url('admin/save_customrod_images')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="input-wrap">
                    <label class="lable-head">Select Image<sup class="star-mark">*</sup></label>
                    <button type="button" class="img-select-btn select_image"  data-row_id="product_images">Select image</button>
                    <input type="hidden" name="product_image_id" id="product_image_id" value="">
                    <input type="hidden" name="product_image_name" id="product_image_name" value="">
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                <div class="input-wrap">
                    <label class="lable-head">.</label>
                    <button type="submit" class="img-select-btn">Save</button>
                </div>
            </div>
        </div>
    </form>
    <div class="dashboard-white-box mt-3">
        <div class="gallery-list-all">
            <div class="image-option">
                <div class="d-flex flex-wrap justify-content-between">
                    <ul>
                        <li class="checkbox">
                            <input type="checkbox" id="allcheck">
                            <label for="allcheck">check all</label>
                        </li>
                        <li>
                            <button class="select-img-delete" id="delete_image" type="submit" style="display: none;"><i class="fa-solid fa-trash-can"></i></button>
                        </li>
                    </ul>
                    {{-- <ul>
                        <li>
                            <div class="input-wrap">
                                <input type="text" class="form-control input-style" name="" id="" placeholder="Search">
                            </div>
                        </li>
                    </ul> --}}
                </div>
            </div>
            <div class="row g-3">
                @foreach ($customrods as $image)
                    <div class="col-xxl-1 col-xl-2 col-lg-3 col-md-3 col-sm-3 col-12">
                        <div class="image-chk">
                            <input type="checkbox" name="image_names[]" value="{{$image->id}}" class="selectedId" id="selectImg_{{$image->id}}">
                            <label for="selectImg_{{$image->id}}">
                                <img src={{ asset('upload/product/images/'.rawurlencode($image->image_name))}} alt={{$image->image_name}}>
                                <p>{{$image->image_name}}</p>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
          </div>
    </div>
</div>

<!-- Modal image gallery -->
<div class="modal fade image-gallery-modal" id="imageGallery" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Image Gallery</h5>
          <div class="d-flex">
            {{-- <div class="input-wrap">
                <input type="text" class="form-control input-style" name="" id="" placeholder="Search">
            </div> --}}
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


<script type="module">
    $('#allcheck').click(function () {
        //$('.selectedId').prop('checked', this.checked);
        if(this.checked){
            $('.selectedId').each(function(){
                this.checked = true;
                $('#delete_image').show();
            });
        }else{
             $('.selectedId').each(function(){
                this.checked = false;
                $('#delete_image').hide();
            });
        }
    });

    $('.selectedId').change(function () {
        //console.log($('.selectedId:checked').length);
        if($('.selectedId:checked').length == 0){
            $('#delete_image').hide();
        }else{
            $('#delete_image').show();
        }
        // var check = ($('.selectedId').filter(":checked").length == $('.selectedId').length);
        // $('#selectall').prop("checked", check);
        if($('.selectedId:checked').length == $('.selectedId').length){
            $('#allcheck').prop('checked',true);
        }else{
            $('#allcheck').prop('checked',false);
        }
    });
    $(document).ready(function() {
        $('#delete_image').hide();
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
    $(document).on('click', '#delete_image', function(e) {
        //console.log($('.selectedId:checked').serialize());
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                var action_url = "{{route('admin.delete_image')}}";
                //console.log(action_url);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: 'post',
                    dataType: 'json',
                    url: action_url,
                    data: $('.selectedId:checked').serialize(),
                    success: (response) => {
                        //console.log(response);
                        if (response.success == false) {
                            toastr.error(response.msg)
                        } else {
                            //toastr.success(response.msg)
                            Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )

                            window.location.reload();
                        }


                    },
                    error: (response) => {
                        //$('.loaderwraper-main').attr("style", "display:none");
                        //console.log(response);
                    }
                })

            }
        })
    })


    $(document).ready(function(){
        const gallery_modal  = document.getElementById('imageGallery');
        const image_gallery_modal = new Modal(gallery_modal);

        $(document).on('click','.select_image',function(){
            image_gallery_modal.show(); //Image gallery Modal open
            $("#imageGallery #attr_row_id").val($(this).data("row_id"));
            //console.log($(this).data("row_id"));
            var select_image_type = $(this).data("row_id");
            $('.loaderwraper-main').attr("style", "display:block");

            $.ajax({
                url: "{{route('admin.all_product_image')}}",
                type: "get",
                data:{select_image_type:select_image_type},
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


        var imageArray = [];
        var imageNameArray = [];
        $('#submit_image_btn').on('click', function(e) {

            image_gallery_modal.hide(); //Image gallery Modal close
            var row = $('#attr_row_id').val();
            //console.log($('#attr_row_id').val());

            console.log(row);

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
                $('#selected_imgArr_'+row).val(imageArray);
                $('#selected_imgNameArr_'+row).val(imageNameArray);
                //console.log(imageNameArray);
            }


        });

        //Variation radio change event
        $('input[type=radio][name=is_variation]').change(function() {
            if (this.value == 0) {
                $('#with_out_variation').show();
                $('#with_variation').hide();
            }
            else if (this.value == 1) {
                $('#with_out_variation').hide();
                $('#with_variation').show();
            }
        });

    });
</script>
@endsection

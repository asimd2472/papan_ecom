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
    <form id="brandForm" action="{{route('admin.upload_image')}}" method="post" enctype="multipart/form-data">
        <div class="row g-3">
            @csrf
            <div class="col-xxl-12 col-lg-10 col-md-12 col-sm-12 col-12">
                <div class="admin-input-wrap">
                    <label class="lable-head">Image Upload <sup class="star-mark">*</sup> {{-- [Image should be less than 500kb | Dimensions 367x309 | accept only jpg, jpeg, png] --}}</label>
                    <div class="d-flex upload_box">
                        <div class="product-up">
                            <input type="file" name="image_names[]" id="product-img" data-max_length="" class="upload_inputfile" multiple required>
                            <label for="product-img" class="file-lbl">
                                <span>
                                    <i class="fa-solid fa-upload"></i>
                                </span>
                            </label>
                        </div>
                        <div class="product-up-show file-scroll upload_img_wrap">
                            <span id="show_image"></span>
                            {{-- <div class="show-img">
                                <img src="{{asset('images/catagory/cat1.jpg')}}">
                                <button type="button" class="img-close"><i class="fa-solid fa-xmark"></i></button>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="input-wrap">
                    <button class="dark-btn-B" type="submit" id="categoryBtn">Save Image</button>
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
                @foreach ($images as $image)
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
</script>
@endsection

@extends('layouts.admin')
@section('content')
<div class="bedcrumb-wrap row justify-content-between align-items-center">
    <div class="col-auto">
        <div class="page-name">Update Type</div>
    </div>
    <div class="col-auto">
        <div class="bedcrumb-list">
            <ul class="d-flex">
                <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                <li>Update Type</li>
            </ul>
        </div>
    </div>
  </div>
<div class="content-wraper">
    <form id="typeForm" action="{{url('/admin/save_type')}}" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-4">
                <div class="input-wrap">
                    <label class="lable-head">Type Name <sup class="star-mark">*</sup></label>
                    <input type="text" class="form-control input-style" name="typename" id="typename" placeholder="Type name" value="{{$producttype->typename}}" required>
                    @error('typename')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="select-wrap">
                    <label class="lable-head">Iamge</label>
                    <input type="file" class="form-control" name="typeimage" id="typeimage">
                    @error('typeimage')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="select-wrap">
                    <label class="lable-head">Category <sup class="star-mark">*</sup></label>
                    <select name="category_id" id="category_id" class="form-control input-style" required>
                            <option value="">Select Category</option>
                            @foreach ($productcategory as $item)
                                <option value="{{$item->id}}" @if($item->id==$producttype->category_id) selected @endif>{{$item->title}}</option>
                            @endforeach
                    </select>
                    @error('category_id')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12 mt-2">
                <div class="input-wrap">
                    <label class="lable-head">Description</label>
                    <textarea class="form-control" name="typedesc" id="typedesc" rows="5">{{$producttype->typedesc}}</textarea>
                    @error('typedesc')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>


            <input type="hidden" name="id" value="{{$producttype->id}}">

            @csrf

            <div class="col-md-12 mt-3">
                <div class="input-wrap">
                    <button class="dark-btn-B" type="submit" id="categoryBtn">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>
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
</script>

@endsection



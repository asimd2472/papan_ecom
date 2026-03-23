@extends('layouts.admin')
@section('content')
<div class="bedcrumb-wrap row justify-content-between align-items-center">
    <div class="col-auto">
        <div class="page-name">Update Category</div>
    </div>
    <div class="col-auto">
        <div class="bedcrumb-list">
            <ul class="d-flex">
                <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                <li>Update Category</li>
            </ul>
        </div>
    </div>
  </div>
<div class="content-wraper">
    <form id="categoryForm" action="{{url('/admin/save_category')}}" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-8">
                <div class="input-wrap">
                    <label class="lable-head">Category Name <sup class="star-mark">*</sup></label>
                    <input type="text" class="form-control input-style" name="title" id="title" placeholder="Category name" value="{{$productcategory->title}}" required>
                    @error('title')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="select-wrap">
                    <label class="lable-head">Category Iamge <sup class="star-mark">*</sup></label>
                    <input type="file" class="form-control" name="categoryimage" id="categoryimage">
                    @error('categoryimage')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12 mt-2">
              <div class="input-wrap">
                  <label class="lable-head">Description</label>
                  <textarea class="form-control" name="categorydesc" id="categorydesc" rows="5">{{$productcategory->categorydesc}}</textarea>
                  @error('categorydesc')
                      <span class="error">{{ $message }}</span>
                  @enderror
              </div>
            </div>
            {{-- <div class="col-xxl-12 col-lg-10 col-md-12 col-sm-12 col-12">
                <div class="input-wrap">
                    <label class="lable-head">Select Brand</label>
                    <ul class="image-checkbox">
                        @foreach ($brand as $key=>$item)
                            <li>
                                <input type="checkbox" id="myCheckbox{{$key}}" name="brand[]" value="{{$item->id}}"
                                @if(in_array($item->id, $select_brand)) checked @endif />
                                <label for="myCheckbox{{$key}}"><img src="{{asset('storage/images/'.$item->brandimage)}}" /></label>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div> --}}

            <div class="col-md-3 mt-2">
                <div class="input-wrap">
                    <label class="lable-head">Length (in Inches)</label>
                    <input type="text" class="form-control input-style isnumber" name="length" id="length" placeholder="Length" value="{{$productcategory->length}}" required>
                    @error('length')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-3 mt-2">
                <div class="input-wrap">
                    <label class="lable-head">Width (in Inches)</label>
                    <input type="text" class="form-control input-style isnumber" name="width" id="width" placeholder="Width" value="{{$productcategory->width}}" required>
                    @error('width')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-3 mt-2">
                <div class="input-wrap">
                    <label class="lable-head">Height (in Inches)</label>
                    <input type="text" class="form-control input-style isnumber" name="height" id="height" placeholder="Height" value="{{$productcategory->height}}" required>
                    @error('height')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-3 mt-2">
                <div class="input-wrap">
                    <label class="lable-head">Weight (in Pounds)</label>
                    <input type="text" class="form-control input-style isnumber" name="weight" id="weight" placeholder="Weight" value="{{$productcategory->weight}}" required>
                    @error('weight')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <input type="hidden" name="id" value="{{$productcategory->id}}">

            @csrf

            <div class="col-md-12 mt-4">
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

<style>
.image-checkbox {
  list-style-type: none;
}

.image-checkbox li {
  display: inline-block;
}

input[type="checkbox"][id^="myCheckbox"] {
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

label:before {
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

label img {
  height: 100px;
  width: 100px;
  transition-duration: 0.2s;
  transform-origin: 50% 50%;
}

:checked + label {
  border-color: #ddd;
}

:checked + label:before {
  content: "✓";
  background-color: #F2958D;
  transform: scale(1);
}

:checked + label img {
  transform: scale(0.9);
  /* box-shadow: 0 0 5px #333; */
  z-index: -1;
}
</style>

@endsection



@extends('layouts.admin')
@section('content')
<div class="bedcrumb-wrap row justify-content-between align-items-center">
    <div class="col-auto">
        <div class="page-name">Home Page</div>
    </div>
    <div class="col-auto">
        <div class="bedcrumb-list">
            <ul class="d-flex">
                <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                <li>Home page</li>
            </ul>
        </div>
    </div>
  </div>
  
<div class="content-wraper">
    <form id="categoryForm" action="{{url('/admin/save_home_page')}}" method="post" enctype="multipart/form-data">
        <div class="row g-3">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="input-wrap">
                    <label class="lable-head">Banner Image <sup class="star-mark">*</sup></label>
                    <input type="file" class="form-control input-style" name="banner_image" id="banner_image">
                    @error('banner_image')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <img src="{{asset('storage/images/'.@$pages->banner_image)}}" width="100" alt="">
            </div>
            <div class="col-md-12">
              <div class="input-wrap">
                  <label class="lable-head">About</label>
                  <textarea class="form-control" name="about" id="about" rows="5">{{@$pages->about}}</textarea>
                  @error('about')
                      <span class="error">{{ $message }}</span>
                  @enderror
              </div>
            </div>
            <div class="col-md-12">
                <div class="input-wrap">
                    <label class="lable-head">About Title</label>
                    <input type="text" class="form-control" name="about_title" value="{{@$pages->about_title}}">
                    @error('about_title')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="input-wrap">
                    <label class="lable-head">About Image <sup class="star-mark">*</sup></label>
                    <input type="file" class="form-control input-style" name="about_image" id="about_image">
                    @error('about_image')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <img src="{{asset('storage/images/'.@$pages->about_image)}}" width="100" alt="">
            </div>

            <input type="hidden" name="id" value="{{@$pages->id}}">

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



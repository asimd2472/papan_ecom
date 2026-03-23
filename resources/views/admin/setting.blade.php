@extends('layouts.admin')
@section('content')
<div class="bedcrumb-wrap row justify-content-between align-items-center">
    <div class="col-auto">
        <div class="page-name">Settings</div>
    </div>
    <div class="col-auto">
        <div class="bedcrumb-list">
            <ul class="d-flex">
                <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                <li>Settings</li>
            </ul>
        </div>
    </div>
  </div>
<div class="content-wraper">

    <ul class="nav nav-tabs" id="myTab" role="tablist">

        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Tax</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Warehouse Address</button>
          </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <form id="taxForm" method="post" action="{{url('/admin/save_tax')}}" class="needs-validation mt-4" novalidate="novalidate" enctype="multipart/form-data">
                <div class="row">
                    @csrf
                    <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 col-12">
                        <label class="lable-head">Tax <sup class="star-mark">*</sup></label>
                        <div class="input-group mb-3">
                            <input type="text" name="services_tax" class="form-control isnumber" placeholder="Tax" aria-label="Tax" aria-describedby="basic-addon2" maxlength="3" minlength="1" value="@if(!empty($setting)){{$setting->services_tax}}@endif" required>
                            <span class="input-group-text" id="basic-addon2">%</span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-wrap">
                            <button class="dark-btn-B" type="submit">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
            <form id="settingForm" action="{{url('/admin/save_setting')}}" method="post" enctype="multipart/form-data">
                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <div class="input-wrap">
                            <label class="lable-head">Street Address <sup class="star-mark">*</sup></label>
                            <input type="text" class="form-control input-style" name="from_address" id="from_address" placeholder="Address" value="@if(!empty($setting)){{$setting->from_address}}@endif" required>
                            @error('from_address')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-wrap">
                            <label class="lable-head">City <sup class="star-mark">*</sup></label>
                            <input type="text" class="form-control input-style" name="from_city" id="from_city" placeholder="City" value="@if(!empty($setting)){{$setting->from_city}}@endif" required>
                            @error('from_city')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="input-wrap">
                            <label class="lable-head">State <sup class="star-mark">*</sup></label>
                            <select name="from_state" id="" class="form-control input-style" required>
                                <option value="">Select State</option>
                                @foreach ($state as $item)
                                    <option value="{{$item->iso2}}" @if($item->iso2==$setting->from_state) selected @endif>{{$item->name}}</option>
                                @endforeach
                            </select>
                            @error('from_state')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-wrap">
                            <label class="lable-head">Zip Code <sup class="star-mark">*</sup></label>
                            <input type="text" class="form-control input-style" name="from_zip" id="from_zip" placeholder="Zip Code" value="@if(!empty($setting)){{$setting->from_zip}}@endif" required>
                            @error('from_zip')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <input type="hidden" name="id" value="@if(!empty($setting)){{$setting->id}}@endif">


                    @csrf

                    <div class="col-md-12">
                        <div class="input-wrap">
                            <button class="dark-btn-B" type="submit" id="categoryBtn">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>








</div>
<script type="module">
    $(document).ready(() => {
        $("#site_logo").change(function () {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function (event) {
                    var image3 = '<img src="' + event.target.result + '">';
                    $(".site_logo").html(image3);
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endsection



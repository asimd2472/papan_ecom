@extends('layouts.admin')
@section('content')
<div class="bedcrumb-wrap row justify-content-between align-items-center">
    <div class="col-auto">
        <div class="page-name">Add Location</div>
    </div>
    <div class="col-auto">
        <div class="bedcrumb-list">
            <ul class="d-flex">
                <li><a href="{{url('admin/dashboard')}}">Add Location</a></li>
                <li>Add Location</li>
            </ul>
        </div>
    </div>
  </div>
<div class="content-wraper">
    <form id="LocationForm" action="{{url('/admin/save_location')}}" method="post" enctype="multipart/form-data">
        <div class="row g-3">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <label class="lable-head">Delivery Locations<sup class="star-mark">*</sup></label>
                <div class="input-group mb-3">
                    <input type="text" name="location" class="form-control" placeholder="Delivery Locations" aria-label="location" aria-describedby="basic-addon2" required>
                </div>
            </div>
            @csrf
            <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="input-wrap">
                    <label class="lable-head">Charges </label>
                    <input type="text" class="form-control" name="charges" id="charges" placeholder="Charges">
                    @error('charges')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <input type="hidden" name="id" id="id" value="">
            <div class="col-md-12">
                <div class="input-wrap">
                    <button class="dark-btn-B" type="submit" id="categoryBtn">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

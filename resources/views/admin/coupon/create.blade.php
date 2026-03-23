@extends('layouts.admin')
@section('content')
<div class="bedcrumb-wrap row justify-content-between align-items-center">
    <div class="col-auto">
        <div class="page-name">Add coupon</div>
    </div>
    <div class="col-auto">
        <div class="bedcrumb-list">
            <ul class="d-flex">
                <li><a href="{{url('admin/dashboard')}}">Add coupon</a></li>
                <li>Add coupon</li>
            </ul>
        </div>
    </div>
  </div>
<div class="content-wraper">
    <form id="CouponForm" action="{{url('/admin/save_coupon')}}" method="post" enctype="multipart/form-data">
        <div class="row g-3">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <label class="lable-head">Discount <sup class="star-mark">*</sup></label>
                <div class="input-group mb-3">
                    <input type="text" name="coupon_discount" class="form-control isnumber" placeholder="Discount" aria-label="Discount" aria-describedby="basic-addon2" maxlength="3" minlength="1" required>
                    <span class="input-group-text" id="basic-addon2">%</span>
                </div>
            </div>
            @csrf
            <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="input-wrap">
                    <label class="lable-head">Coupon Code <sup class="star-mark">*</sup></label>
                    <input type="text" class="form-control" name="coupon_code" id="coupon_code" placeholder="Coupon Code" required>
                    @error('coupon_code')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                <div class="select-wrap">
                    <label class="lable-head">Category <sup class="star-mark">*</sup></label>
                    <select class="select2 form-select" name="coupon_category[]" multiple required>
                        @foreach ($productcategory as $item)
                            <option value="{{$item->id}}">{{$item->title}}</option>
                        @endforeach

                    </select>
                    @error('coupon_category')
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

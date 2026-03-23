@extends('layouts.admin')
@section('content')
<div class="bedcrumb-wrap row justify-content-between align-items-center">
    <div class="col-auto">
        <div class="page-name">Brand</div>
    </div>
    <div class="col-auto">
        <div class="bedcrumb-list">
            <ul class="d-flex">
                <li><a href="{{url('admin/dashboard')}}">Brand</a></li>
                <li>Brand List</li>
            </ul>
        </div>
    </div>
  </div>
<div class="content-wraper">
    <form id="brandForm" action="{{url('/admin/save_brand')}}" method="post" enctype="multipart/form-data">
        <div class="row g-3">
            <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="input-wrap">
                    <label class="lable-head">Brand Name <sup class="star-mark">*</sup></label>
                    <input type="text" class="form-control input-style" name="brandname" id="brandname" placeholder="Brand Name" required>
                    @error('brandname')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            @csrf
            <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="input-wrap">
                    <label class="lable-head">Brand Iamge</label>
                    <input type="file" class="form-control" name="brandimage" id="brandimage" required>
                    @error('brandimage')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <input type="hidden" name="id" id="id" value="">
            <div class="col-md-12">
                <div class="input-wrap">
                    <button class="dark-btn-B" type="submit" id="categoryBtn">Add New Brand</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="content-wraper mt-3">
    <table class="table table-bordered">
        <thead>
          <tr>
            <th>Brand Name</th>
            <th>Brand Image</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($brand as $item)
                <tr>
                    <td>{{$item->brandname}}</td>
                    <td><img src="{{asset('storage/images/'.$item->brandimage)}}" width="60" alt=""></td>
                    <td>
                        <a href="javascript:void(0)" onclick="editbrand('{{$item->id}}', '{{$item->brandname}}')" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="{{url('admin/delete_brand')}}/{{$item->id}}" onclick="return confirm('Are you sure you want to delete?');" class="btn btn-danger btn-sm"><i class="fa-sharp fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
      {{ $brand->links('vendor.pagination.bootstrap-5') }}
</div>
@endsection

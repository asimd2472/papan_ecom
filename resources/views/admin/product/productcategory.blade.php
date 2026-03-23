@extends('layouts.admin')
@section('content')
<div class="bedcrumb-wrap row justify-content-between align-items-center">
    <div class="col-auto">
        <div class="page-name">Category</div>
    </div>
    <div class="col-auto">
        <div class="bedcrumb-list">
            <ul class="d-flex">
                <li><a href="{{url('admin/dashboard')}}">Category</a></li>
                <li>Category List</li>
            </ul>
        </div>
    </div>
  </div>
{{-- <div class="content-wraper">
    <form id="categoryForm" action="{{url('/admin/save_category')}}" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="input-wrap">
                    <label class="lable-head">Category <sup class="star-mark">*</sup></label>
                    <input type="text" class="form-control input-style" name="title" id="title" placeholder="Category" required>
                    @error('title')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            @csrf
            <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="input-wrap">
                    <label class="lable-head">Category Iamge</label>
                    <input type="file" class="form-control" name="categoryimage" id="categoryimage">
                    @error('categoryimage')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <input type="hidden" name="id" id="id" value="">
            <div class="col-md-12">
                <div class="input-wrap">
                    <button class="dark-btn-B" type="submit" id="categoryBtn">Create New Caregory</button>
                </div>
            </div>
        </div>
    </form>
</div> --}}

<div class="content-wraper mt-3">
    <div class="content-wraper-inner">
        <a href="{{url('admin/create-catrgory')}}" class="dark-btn-A">Create New</a>
    </div>
    <table class="table table-bordered">
        <thead>
          <tr>
            <th>Category</th>
            <th>Category Image</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($productcategory as $item)
                <tr>
                    <td>{{$item->title}}</td>
                    <td><img src="{{asset('storage/images/'.$item->categoryimage)}}" width="60" alt=""></td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input commoncls" role="switch" type="checkbox" name="status" id="packId_{{$item->id}}" onclick="checkStatusproductcategory('{{$item->id}}', this.value)" {{ $item->status==1 ? 'checked': '' }}>
                        </div>
                    </td>
                    <td>
                        <a href="{{url('admin/edit_productcategory')}}/{{$item->id}}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="{{url('admin/delete_productcategory')}}/{{$item->id}}" onclick="return confirm('Are you sure you want to delete?');" class="btn btn-danger btn-sm"><i class="fa-sharp fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
      {{ $productcategory->links('vendor.pagination.bootstrap-5') }}
</div>
@endsection

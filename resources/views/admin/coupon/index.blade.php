@extends('layouts.admin')
@section('content')
<div class="bedcrumb-wrap row justify-content-between align-items-center">
    <div class="col-auto">
        <div class="page-name">Coupon</div>
    </div>
    <div class="col-auto">
        <div class="bedcrumb-list">
            <ul class="d-flex">
                <li><a href="{{url('admin/dashboard')}}">Coupon</a></li>
                <li>Coupon List</li>
            </ul>
        </div>
    </div>
  </div>


<div class="content-wraper mt-3">
    <div class="content-wraper-inner">
        <a href="{{url('admin/create-coupon')}}" class="dark-btn-A">Create New</a>
    </div>
    <table class="table table-bordered">
        <thead>
          <tr>
            <th>Coupon Code</th>
            <th>Coupon Discount</th>
            {{-- <th>Action</th> --}}
          </tr>
        </thead>
        <tbody>
            @foreach ($coupon as $item)
                <tr>
                    <td>{{$item->coupon_code}}</td>
                    <td>{{$item->coupon_discount}}%</td>
                    <td>
                        <a href="{{url('admin/edit_coupon')}}/{{$item->id}}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="{{url('admin/delete_coupon')}}/{{$item->id}}" onclick="return confirm('Are you sure you want to delete?');" class="btn btn-danger btn-sm"><i class="fa-sharp fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
</div>
@endsection

@extends('layouts.admin')
@section('content')
<div class="bedcrumb-wrap row justify-content-between align-items-center">
    <div class="col-auto">
        <div class="page-name">Delivery Locations and Charges</div>
    </div>
    <div class="col-auto">
        <div class="bedcrumb-list">
            <ul class="d-flex">
                <li><a href="{{url('admin/dashboard')}}">Delivery Locations and Charges</a></li>
                {{-- <li>Coupon List</li> --}}
            </ul>
        </div>
    </div>
  </div>


<div class="content-wraper mt-3">
    <div class="content-wraper-inner">
        <a href="{{url('admin/create-delivery-locations')}}" class="dark-btn-A">Create New</a>
    </div>
    <table class="table table-bordered">
        <thead>
          <tr>
            <th>Address</th>
            <th>Charges</th>
            {{-- <th>Action</th> --}}
          </tr>
        </thead>
        <tbody>
            @foreach ($delivery_locations as $item)
                <tr>
                    <td>{{$item->location}}</td>
                    <td>{{$item->charges =='' ? 'Free' : $item->charges}}</td>
                    <td>
                        <a href="{{url('admin/edit_location')}}/{{$item->id}}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="{{url('admin/delete_location')}}/{{$item->id}}" onclick="return confirm('Are you sure you want to delete?');" class="btn btn-danger btn-sm"><i class="fa-sharp fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
</div>
@endsection

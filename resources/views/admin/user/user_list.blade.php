@extends('layouts.admin')
@section('content')
<div class="bedcrumb-wrap row justify-content-between align-items-center">
    <div class="col-auto">
        <div class="page-name">Users List</div>
    </div>
    <div class="col-auto">
        <div class="bedcrumb-list">
            <ul class="d-flex">
                <li><a href="{{url('admin/dashboard')}}">Users List</a></li>
                <li>Users List</li>
            </ul>
        </div>
    </div>
</div>

<div class="content-wraper mt-3">
    <table class="table table-bordered">
        <thead>
          <tr>
            
            <th>Sl No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $key=>$item)
                <tr>
                    <td>{{($key+1)}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{date('M d, Y', strtotime(str_replace('.', '/', $item->created_at)))}}</td>
                    <td>
                        <a href="{{url('admin/edit-product')}}/{{$item->id}}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="{{url('admin/delete_productcategory')}}/{{$item->id}}" onclick="return confirm('Are you sure you want to delete?');" class="btn btn-danger btn-sm"><i class="fa-sharp fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
      {{ $users->links('vendor.pagination.bootstrap-5') }}
</div>
@endsection

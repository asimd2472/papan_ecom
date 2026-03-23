@extends('layouts.admin')
@section('content')
<div class="bedcrumb-wrap row justify-content-between align-items-center">
    <div class="col-auto">
        <div class="page-name">NewsLetter</div>
    </div>
    <div class="col-auto">
        <div class="bedcrumb-list">
            <ul class="d-flex">
                <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                <li>Newsletter List</li>
            </ul>
        </div>
    </div>
  </div>

<div class="content-wraper mt-3">
    <table class="table table-bordered">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Email Id</th>
              <th scope="col">Created Date</th>
              <th scope="col">Action</th>

            </tr>
          </thead>
          <tbody>
              @foreach ($newsletters as $key=>$item)


              <tr>
                  <th scope="row">{{($key+1)}}</th>
                  <td>{{$item->email}}</td>
                  <td>{{date('M d, Y', strtotime(str_replace('.', '/', $item->created_at)))}}</td>
                  <td><a href="{{url('admin/delete_newsletters')}}/{{$item->id}}" onclick="return confirm('Are you sure you want to delete?');" class="btn btn-danger btn-sm"><i class="fa-sharp fa-solid fa-trash"></i></a></td>
              </tr>

            @endforeach

          </tbody>
      </table>
      {{ $newsletters->links('vendor.pagination.bootstrap-5') }}
</div>
@endsection

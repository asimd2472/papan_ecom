@extends('layouts.admin')
@section('content')
<div class="bedcrumb-wrap row justify-content-between align-items-center">
    <div class="col-auto">
        <div class="page-name">Order</div>
    </div>
    <div class="col-auto">
        <div class="bedcrumb-list">
            <ul class="d-flex">
                <li><a href="{{url('admin/dashboard')}}">Order</a></li>
                <li>Order List</li>
            </ul>
        </div>
    </div>
  </div>

<div class="content-wraper mt-3">
    <table class="table table-bordered">
        <thead>
            <tr>
              {{-- <th scope="col">#</th> --}}
              <th scope="col">User</th>
              <th scope="col">Order No.</th>
              <th scope="col">Amount</th>
              <th scope="col">Date</th>
              {{-- <th scope="col">Status</th> --}}
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
              @foreach ($order_details as $key=>$item)


              <tr>
                  {{-- <th scope="row">{{($key+1)}}</th> --}}
                  <td>{{$item->name}}</td>
                  <td>{{$item->order_no}}</td>
                  <td>{{$item->total_pay}}</td>
                  <td>{{date('M d, Y', strtotime(str_replace('.', '/', $item->created_at)))}}</td>
                  {{-- <td>{{$item->current_status}}</td> --}}
                  <td><a href="{{url('admin/order-details/'.$item->id)}}" title="Order details"><i class="fas fa-clipboard-list"></a></td>
              </tr>

            @endforeach

          </tbody>
      </table>
      {{ $order_details->links('vendor.pagination.bootstrap-5') }}
</div>
@endsection

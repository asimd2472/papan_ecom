@extends('layouts.admin')
@section('content')
<div class="bedcrumb-wrap row justify-content-between align-items-center">
    <div class="col-auto">
        <div class="page-name">Product List</div>
    </div>
    <div class="col-auto">
        <div class="bedcrumb-list">
            <ul class="d-flex">
                <li><a href="{{url('admin/dashboard')}}">Product List</a></li>
                <li>Product List List</li>
            </ul>
        </div>
    </div>
  </div>

<div class="content-wraper mt-3">
    <div>
        <form action="" method="get" id="filter">
            <div class="row">

                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="" class="form-label">Category</label>
                            <select class="form-control custom-select form-control-select" id="" name="category_id">
                                <option value="">Select Category</option>
                                @forelse ($productCategory as $category)
                                    <option value="{{$category->id}}" {{request()->input('category_id') == $category->id ? 'selected' : ''}}>{{$category->title}}</option>
                                @empty

                                @endforelse
                            </select>
                        </div>
                    </div>


                <div class="col-12">
                    <ul class="saveSrcArea d-flex align-items-center justify-content-center mb-2">
                        {{-- <li>
                            <a href="javascript:?" class="btn btn-primary" id="reset">Reset</i></a>
                        </li> --}}
                        <li>
                            <button class="btn btn-primary" type="submit">Search <i class="fas fa-arrow-circle-right"></i></button>
                        </li>



                    </ul>
                </div>
            </div>
        </form>
    </div>

    <table class="table table-bordered">
        <thead>
          <tr>

            <th>Image</th>
            <th>Title</th>
            <th>Category</th>
            {{-- <th>Price</th>
            <th>Status</th> --}}
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($products as $item)
                <tr>

                    <td>
                        <img src="{{asset("upload/product/images/".$item->main_image_name)}}" width="60" alt="">
                    </td>
                    <td>{{$item->product_title}}</td>
                    <td>{{$item->productCategory->title}}</td>
                    {{-- <td>{{$item->product_price}}</td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input commoncls" role="switch" type="checkbox" name="status" id="packId_{{$item->id}}" onclick="checkStatusproductcategory('{{$item->id}}', this.value)" {{ $item->status==1 ? 'checked': '' }}>
                        </div>
                    </td> --}}
                    <td>
                        <a href="{{url('admin/edit-product')}}/{{$item->id}}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="{{url('admin/delete_product')}}/{{$item->id}}" onclick="return confirm('Are you sure you want to delete?');" class="btn btn-danger btn-sm"><i class="fa-sharp fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
      {{ $products->appends($_GET)->links('vendor.pagination.bootstrap-5') }}
</div>
@endsection

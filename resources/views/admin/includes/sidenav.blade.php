<div class="sidebar">
    <div class="brand-logo">
        <a href="#">
            {{-- <img class="img-block" src="{{ Vite::asset('resources/admin/images/logo-white.png')}}" alt=""> --}}
        </a>
    </div>
    <nav class="sideban-nav">
        <ul>
            <li class="{{Route::currentRouteName() == 'admin.dashboard' ? 'active' : ''}}"><a href="{{route('admin.dashboard')}}"><span class="menu-left-icon"><i class="fa-solid fa-gauge-high"></i></span><p>Dashboard</p></a></li>
            {{-- <li class="{{Route::currentRouteName() == 'admin.testimonials' ? 'active' : ''}}"><a href="{{route('admin.testimonials')}}"><span class="menu-left-icon"><i class="fa-solid fa-comment"></i></span><p>Testimonials</p></a></li> --}}
            {{-- <li class="{{Route::currentRouteName() == 'admin.brand' ? 'active' : ''}}"><a href="{{route('admin.brand')}}"><span class="menu-left-icon"><i class="fa-solid fa-users"></i></span><p>Brand</p></a></li> --}}

            <li class="menu-open {{request()->segment(2) == 'productcategory' || request()->segment(2) == 'producttype' || request()->segment(3) == 'all-images' || request()->segment(2) == 'createproduct' || request()->segment(2) == 'product-list' || request()->segment(2) == 'custom_rod' ? 'active' : ''}}">
                <a href="javascript:;">
                    <span class="menu-left-icon"><i class="fa-solid fa-blog"></i></span>
                    <p>Product<i class="fa-solid fa-chevron-down"></i></p>
                </a>
                <ul class="sub-menu-list" @if(request()->segment(2) == 'productcategory' || request()->segment(2) == 'producttype' || request()->segment(3) == 'all-images' || request()->segment(2) == 'createproduct' || request()->segment(2) == 'product-list' || request()->segment(2) == 'custom_rod') style="display: block; @else  style="display: none; @endif ">
                    <li class="{{request()->segment(2) == 'productcategory' ? 'sub-active' : ''}}"><a href="{{url('admin/productcategory')}}"><p>Category</p></a></li>
                    {{-- <li class="{{request()->segment(2) == 'producttype' ? 'sub-active' : ''}}"><a href="{{url('admin/producttype')}}"><p>Type</p></a></li> --}}
                    <li class="{{Route::currentRouteName() == 'admin.all_image' ? 'sub-active' : ''}}"><a href="{{route('admin.all_image')}}"><p>All Images</p></a></li>
                    <li class="{{request()->segment(2) == 'createproduct' ? 'sub-active' : ''}}"><a href="{{url('admin/createproduct')}}"><p>Create Product</p></a></li>
                    <li class="{{request()->segment(2) == 'product-list' ? 'sub-active' : ''}}"><a href="{{url('admin/product-list')}}"><p>Product List</p></a></li>
                    {{-- <li class="{{request()->segment(2) == 'upload_file' ? 'sub-active' : ''}}"><a href="{{url('admin/upload_file')}}"><p>Upload product </p></a></li> --}}
                    {{-- <li class="{{request()->segment(2) == 'custom_rod' ? 'sub-active' : ''}}"><a href="{{url('admin/custom_rod')}}"><p>Custom Rods </p></a></li> --}}
                </ul>
            </li>

            <li class="{{Route::currentRouteName() == 'admin.order_list' ? 'active' : ''}}"><a href="{{route('admin.order_list')}}"><span class="menu-left-icon"><i class="fa-solid fa-gauge-high"></i></span><p>Order List</p></a></li>
            {{-- <li class="{{Route::currentRouteName() == 'admin.newslater_list' ? 'active' : ''}}"><a href="{{route('admin.newslater_list')}}"><span class="menu-left-icon"><i class="fa-solid fa-envelope-open-text"></i></span><p>Newsletter List</p></a></li> --}}

            {{-- <li class="{{Route::currentRouteName() == 'admin.users' ? 'active' : ''}}"><a href="{{route('admin.users')}}"><span class="menu-left-icon"><i class="fa-solid fa-users"></i></span><p>Users</p></a></li> --}}
            {{-- <li class="{{Route::currentRouteName() == 'admin.setting' ? 'active' : ''}}"><a href="{{route('admin.setting')}}"><span class="menu-left-icon"><i class="fa-solid fa-gear"></i></span><p>Setting</p></a></li> --}}
            {{-- <li class="{{Route::currentRouteName() == 'admin.coupon' ? 'active' : ''}}"><a href="{{route('admin.coupon')}}"><span class="menu-left-icon"><i class="fa-solid fa-money-bill"></i></span><p>Coupon</p></a></li> --}}
            <li class="{{Route::currentRouteName() == 'admin.home_page' ? 'active' : ''}}"><a href="{{route('admin.home_page')}}"><span class="menu-left-icon"><i class="fa-solid fa-file"></i></span><p>Home Page</p></a></li>
            <li class="{{Route::currentRouteName() == 'admin.delivery_locations' ? 'active' : ''}}"><a href="{{route('admin.delivery_locations')}}"><span class="menu-left-icon"><i class="fa-solid fa-map-location"></i></span><p>Delivery Locations</p></a></li>
        </ul>
    </nav>
</div>

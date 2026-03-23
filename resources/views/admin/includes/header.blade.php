<header class="site-header">
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <div class="side-menu-close d-flex flex-column align-items-center justify-content-center">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="col-auto">
            <div class="account-area">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        @if (Auth::user()->admin_img!='')
                            <span class="avatar"><img src="{{asset('storage/images/'.Auth::user()->admin_img)}}" alt=""></span>
                        @else
                            <span class="avatar"><img src="{{ Vite::asset('resources/admin/images/placeholder.png')}}" alt=""></span>
                        @endif
                      <p>{{@Auth::user()->name}}</p>
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                      <li><a class="dropdown-item" href="{{url('admin/my-account')}}"><i class="fa-solid fa-user-gear"></i>my account</a></li>
                      <li><a class="dropdown-item" href="{{route('admin.logout')}}"><i class="fa-solid fa-arrow-right-from-bracket"></i>logout</a></li>
                    </ul>
                  </div>
            </div>
        </div>
    </div>
</header>

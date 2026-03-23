@extends('layouts.admin')
@section('content')
<div class="content-wraper">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Profile</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Change Password</button>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <form id="myAccountform" method="post" action="{{url('/admin/update_profile')}}" class="needs-validation mt-4" novalidate="novalidate" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xl-6 col-lg-12 col-md-12 col-12">
                        <div class="admin-profile-box">
                            <div class="admin-profile-box-head">
                                <h3>{{$user_details->name}}</h3>
                                {{-- <h4>Admin</h4> --}}
                            </div>
                            <div class="admin-profile-box-img">
                                <div class="admin-imgupload">
                                    <div class="admin-imgupload-edit">
                                        <input type="file" name="admin_img" id="imgUpload" accept=".jpg, .jpeg, .png">
                                        <label for="imgUpload"></label>
                                    </div>
                                    <div class="admin-img-preview">
                                        @if ($user_details->admin_img!='')
                                            <div id="imagePreview" style="background-image: url('{{asset('storage/images/'.$user_details->admin_img)}}');"></div>
                                        @else
                                            <div id="imagePreview" style="background-image: url('{{ Vite::asset('resources/admin/images/placeholder.png')}}');"></div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12 col-md-12 col-12">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="input-wrap">
                                    <label class="lable-head">Name</label>
                                    <input type="text" class="form-control input-style" name="name" id="name" value="{{$user_details->name}}" required>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-2">
                                <div class="input-wrap">
                                    <label class="lable-head">Email</label>
                                    <input type="text" class="form-control input-style" name="email" id="email" value="{{$user_details->email}}" required>
                                </div>
                            </div>
                            @csrf

                            <div class="col-12 mt-2">
                                <div class="">
                                    <button class="dark-btn-B" type="submit">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <form id="changepasswordform" method="post" action="{{url('/admin/changepassword')}}" class="needs-validation mt-4" novalidate="novalidate" enctype="multipart/form-data">
                <div class="row">
                    @csrf
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="input-wrap">
                            <label class="lable-head">Password</label>
                            <input type="password" class="form-control input-style" name="password" id="password" required>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="input-wrap">
                            <label class="lable-head">Confirm password</label>
                            <input type="password" class="form-control input-style" name="confirm_password" id="confirm_password" required>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="">
                            <button class="dark-btn-B" type="submit">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
      </div>
</div>
@endsection

@push('scripts')
<script type="module">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imgUpload").change(function() {
        readURL(this);
    });
</script>
@endpush

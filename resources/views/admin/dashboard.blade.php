@extends('layouts.admin')
@section('content')
<div class="content-wraper">
    <div class="row g-3">
        <div class="col-xxl-8 col-lg-6 col-md-12 col-sm-12 col-12">
            <div class="dashboard-white-box">
                <div class="admin-details-wrap">
                    <h3>Hi, Welcome Back <span>{{@Auth::user()->name}}</span></h3>
                    {{-- <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eligendi, exercitationem temporibus officiis suscipit a, deserunt rem praesentium earum consequatur tenetur corporis libero officia dolorum accusamus mollitia hic nam quisquam adipisci!</p> --}}
                </div>
            </div>
        </div>
        {{-- <div class="col-xxl-4 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="dashboard-white-box">
                <div class="white-box-head">
                    <h3></h3>
                </div>
                <div class="white-box-wrap">
                    <div class="white-box-wrap-lft">
                        <div class="box-wrap-lft-box">
                            <strong>{{$contactform}}</strong>
                        </div>
                    </div>
                    <div class="white-box-wrap-rgt">
                        <div class="box-wrap-rgt-box">
                            <i class="fa-regular fa-user"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    <div class="row g-3 mt-0">
        
        

    



    </div>

</div>

@endsection


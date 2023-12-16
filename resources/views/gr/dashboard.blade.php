@extends('gr.layout.app')
@section('body')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Admin Dashboard</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xxl-12">
                <div class="d-flex flex-column h-100">
                    <div class="row h-100">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body p-0">
                                    <div class="alert alert-warning border-0 rounded-0 m-0 d-flex align-items-center" role="alert">
                                        <i data-feather="alert-triangle" class="text-warning me-2 icon-sm"></i>
                                        <div class="flex-grow-1 text-truncate">
                                            Hello {{auth()->user()->name}}
                                        </div>
                                        
                                        <div class="flex-shrink-0">
                                            <a href="pages-pricing.html" class="text-reset text-decoration-underline">Login on : {{Session('login')}}</a>
                                        </div>
                                    </div>

                                    <div class="row align-items-end">
                                        <div class="col-sm-8">
                                            <div class="p-3">
                                                <p class="fs-16 lh-base">You are authorized to Read, Write and Delete the data from admin. <i class="mdi mdi-arrow-right"></i></p>
                                                <div class="mt-3">
                                                    <a href="{{url('logout')}}" class="btn btn-success">Logout</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="px-3">
                                                <img src="assets/images/logo-dark1.png" class="img-fluid" alt="" style="margin: 20px 0;   text-align: right; float: right; ">
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end card-body-->
                            </div>
                        </div> <!-- end col-->
                    </div> <!-- end row-->

                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p class="fw-medium text-muted mb-0">Total Category :</p>
                                            <a href="{{url('adCatReport')}}"><h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="0">{{$del}}</span></h2></a>

                                        </div>
                                        <div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                                    <i data-feather="users" class="text-info"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-md-3">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p class="fw-medium text-muted mb-0">Total Subscriber</p>
                                            <a href="{{url('subReport')}}"><h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="0">{{$rice}}</span></h2></a>

                                        </div>
                                        <div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                                    <i data-feather="activity" class="text-info"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                        <div class="col-md-3">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p class="fw-medium text-muted mb-0">Total Ads Posted</p>
                                            
                                           <a href="{{url('adReport')}}"><h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="0">{{$use}}</span></h2></a>

                                        </div>
                                        <div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                                    <i data-feather="activity" class="text-info"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                        <div class="col-md-3">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p class="fw-medium text-muted mb-0">Total Active Ads</p>
                                            <a href="{{url('adReport')}}"><h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="0">{{$activeAdd}}</span>

                                            </h2>
                                            </a>
                                        </div>
                                        <div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                                    <i data-feather="clock" class="text-info"></i>
                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                        <div class="col-md-3">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p class="fw-medium text-muted mb-0">Total Ads Query</p>
                                            <a href="{{url('adenquiry')}}"><h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="0">{{$prod}}</span>

                                            </h2>
                                            </a>
                                        </div>
                                        <div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                                    <i data-feather="clock" class="text-info"></i>
                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                        <div class="col-md-3">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p class="fw-medium text-muted mb-0">Free Subscriber</p>
                                            <a href="{{url('SubscriberRep/free')}}"><h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="0">{{$free}}</span></h2></a>

                                        </div>
                                        <div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                                    <i data-feather="clock" class="text-info"></i>
                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                        <div class="col-md-3">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p class="fw-medium text-muted mb-0">Boost Subscriber</p>
                                            <a href="{{url('SubscriberRep/Boost')}}"><h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="0">{{$Boost}}</span>

                                            </h2>
                                            </a>
                                        </div>
                                        <div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                                    <i data-feather="clock" class="text-info"></i>
                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                        <div class="col-md-3">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p class="fw-medium text-muted mb-0">Premium Subscriber</p>
                                            <a href="{{url('SubscriberRep/Premium')}}"><h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="0">{{$Premium}}</span>

                                            </h2>
                                            </a>
                                        </div>
                                        <div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                                    <i data-feather="clock" class="text-info"></i>
                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                        <!-- end col-->

                    </div> <!-- end row-->

                    
                </div>
            </div> <!-- end col-->


        </div> <!-- end row-->





    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection
@extends('web.layout.app')
@section('body')
<div id="page-content">
    <!--Collection Banner-->
    <div class="flash-message">

        @if(Session::has('error'))

        <p class="alert alert-danger">{{ Session::get('error') }} <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
        @if(Session::has('success'))

        <p class="alert alert-success">{{ Session::get('success') }} <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">&times;</a></p>
        @endif

    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!--Container-->
    <div class="container">
        <!--Main Content-->
        <div class="row">
            <div class="box col-12 col-sm-12 col-md-8 col-lg-6 offset-md-2 offset-lg-3">

                @if(Session::has('fotp') && Session::has('femail'))
                <form action="{{url('otpmatch')}}" method="post" action="#" accept-charset="UTF-8" class="customer-form mt-2 mt-lg-5">
                    @csrf
                    <h3 class="h4 text-uppercase mb-2">Reset your password</h3>
                    <p>Please enter OTP.</p>
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="CustomerEmail" class="d-none">OTP <span class="required">*</span></label>
                                <input type="text" name="otp" placeholder="Enter OTP" id="CustomerEmail" required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-left col-12 col-sm-12 col-md-12 col-lg-12">
                            <p class="d-flex-center">
                                <input type="submit" class="btn rounded me-auto" value="Password Reset">
                                <a href="{{route('resendFotp')}}" style="margin-right: 35px;"><i class="align-middle icon an an-an-double-left me-2"></i>resend OTP</a>
                                <a href="{{route('flogin')}}"><i class="align-middle icon an an-an-double-left me-2"></i>Back To Login Page</a>
                            </p>
                        </div>
                    </div>
                </form>
                @elseif(Session::has('femail'))
                <form action="{{url('updatePassword')}}" method="post" action="#" accept-charset="UTF-8" class="customer-form mt-2 mt-lg-5">
                    @csrf
                    <h3 class="h4 text-uppercase mb-2">Reset your password</h3>
                    
                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="CustomerEmail" class="d-none">Password <span class="required">*</span></label>
                                <input type="text" name="password" placeholder="Enter New Password"  required />
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="CustomerEmail" class="d-none">Confirm Password<span class="required">*</span></label>
                                <input type="text" name="password_confirmation" placeholder="Confirm Password"  required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-left col-12 col-sm-12 col-md-12 col-lg-12">
                            <p class="d-flex-center">
                                <input type="submit" class="btn rounded me-auto" value="Password Reset">
                                <a href="{{route('flogin')}}"><i class="align-middle icon an an-an-double-left me-2"></i>Back To Login Page</a>
                            </p>
                        </div>
                    </div>
                </form>
                @else
                <form action="{{url('fpassword')}}" method="post" action="#" accept-charset="UTF-8" class="customer-form mt-2 mt-lg-5">
                    @csrf
                    <h3 class="h4 text-uppercase mb-2">Reset your password</h3>
                    <p>Please enter your email address below.</p>
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="CustomerEmail" class="d-none">Email Address <span class="required">*</span></label>
                                <input type="email" name="email" placeholder="Email" id="CustomerEmail" required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-left col-12 col-sm-12 col-md-12 col-lg-12">
                            <p class="d-flex-center">
                                <input type="submit" class="btn rounded me-auto" value="Password Reset">
                                <a href="{{route('login')}}"><i class="align-middle icon an an-an-double-left me-2"></i>Back To Login Page</a>
                            </p>
                        </div>
                    </div>
                </form>
                @endif
            </div>
        </div>
        <!--End Main Content-->
    </div>
    <!--End Container-->
</div>
@endsection
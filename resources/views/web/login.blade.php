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

        <div class="login-register pt-2 pt-lg-5">
            <br><br>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-4 mb-md-0">
                    <div class="inner">
                        <form method="post" action="{{url('submitlogin')}}" class="customer-form">
                            @csrf
                            <h3 class="h4 text-uppercase">REGISTERED CUSTOMERS</h3>
                            <p>If you have an account with us, please log in.</p>
                            <div class="row">
                                <!--<div class="col-12 col-sm-12 col-md-12 col-lg-12">-->
                                <!--    <div class="form-group">-->
                                <!--        <a href="{{url('/auth/google/redirect')}}" class="btn btn-danger btn-block w-100 mb-2"><i class="icon an an-google mx-1 pr-5" style="border-color:white;"></i>Login with Google</a>-->
                                <!--        <a href="{{url('/auth/fbook/redirect')}}" class="btn btn-primary btn-block w-100" style="background-color: #2d57bc !important;"><i class="icon an an-facebook mx-1 pr-5" style="border-color:white;"></i>Login with Facebook</a>-->
                                <!--    </div>-->
                                <!--</div>-->
                                <!--<p style="text-align:center">OR</p>-->
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="CustomerEmail" class="d-none">Email <span class="required">*</span></label>
                                        <input type="email" name="email" placeholder="Email" id="CustomerEmail" value="" required />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="CustomerPassword" class="d-none">Password <span class="required">*</span></label>
                                        <input type="password" name="password" placeholder="Password" id="CustomerPassword" value="" required />
                                    </div>
                                </div>
                                @if(Session::has('otp'))
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="CustomerPassword" class="d-none">OTP<span class="required">*</span></label>
                                        <input type="text" name="otp" placeholder="OTP" id="" value="" required />
                                    </div>
                                </div>
                                @endif
                            </div>

                            <div class="row">
                                <div class="text-left col-12 col-sm-12 col-md-12 col-lg-12">
                                    <p class="d-flex-center">
                                        <input type="submit" class="btn rounded me-auto" value="Sign In">
                                        @if(Session::has('otp'))
                                        <a href="{{url('resendOTP')}}" style="margin-right: 23px;">Resend OTP?</a>
                                        @endif
                                        <a href="{{url('forgotPassword')}}">Forgot password?</a>
                                    </p>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="inner">
                        <h3 class="h4 text-uppercase">NEW CUSTOMER?</h3>
                        <p>Registering for this site allows you to access your order status and history. We’ll get a new account set up for you in no time. For this will only ask you for information necessary to make the purchase process faster and easier</p>
                        <a href="{{url('register')}}" class="btn rounded">Create an account</a>
                         @if(Session::has('otp'))
                        <a href="{{url('loginWOA')}}" class="btn rounded mt-2">Login With Other Account</a>

                        @endif
                    </div>
                </div>
            </div>
           
            <br><br>
        </div>
        <!--End Main Content-->

    </div>
    <!--End Container-->
</div>
@endsection
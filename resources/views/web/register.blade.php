@extends('web.layout.app')
@section('body')
<style>
    #loader {
    display: none;
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 150px;
  height: 150px;
  margin: -75px 0 0 -75px;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  animation: spin 1s linear infinite;  
}
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
</style>
<div id='loader'></div>

<div id="page-content">
    <!--Collection Banner-->
    <!--Container-->
        <div class="flash-message">

        @if(Session::has('error'))

        <p class="alert alert-danger">{{ Session::get('error') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
        @if(Session::has('success'))

        <p class="alert alert-success">{{ Session::get('success') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
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
    <div class="container">
   
            <br><br><br><br>
        <!--Main Content-->
        <div class="row">
            <div class="col-12 col-sm-3 col-md-3 col-lg-3 box mt-2 mt-lg-5"></div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 box mt-2 mt-lg-5">
                <h3 class="h4 text-uppercase mb-3">Signup Information</h3>
                <form method="post" action="{{route('registerUser')}}" accept-charset="UTF-8" class="customer-form">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="CustomerFirstName" class="d-none">First Name <span class="required">*</span></label>
                                <input id="CustomerFirstName" autocomplete="false" type="text" name="firstName" placeholder="First Name" value="{{old('firstName')}}" required />
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="CustomerLastName" class="d-none">Last Name <span class="required">*</span></label>
                                <input id="CustomerLastName" autocomplete="false" type="text" name="lastName" placeholder="Last Name" value="{{old('lastName')}}" required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="CustomerEmail" class="d-none">Email Address <span class="required">*</span></label>
                                <input id="CustomerEmail" autocomplete="false" type="email" name="email" placeholder="Email" required  value="{{old('email')}}" />
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="CustomerEmail" class="d-none">Phone<span class="required">*</span></label>
                                <input id="CustomerEmail" autocomplete="false" type="text" name="phone" placeholder="phone" required  value="{{old('phone')}}" />
                            </div>
                        </div>
                    </div>
                    

                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="CustomerPassword" class="d-none">Password <span class="required">*</span></label>
                                <input id="CustomerPassword" autocomplete="false" type="password" name="password" placeholder="Password" required />
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="CustomerConfirmPassword" class="d-none">Confirm Password <span class="required">*</span></label>
                                <input id="CustomerConfirmPassword" autocomplete="false" type="password" name="password_confirmation" placeholder="Confirm Password" required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="AccountType" class="d-none">Account Type <span class="required">*</span></label>
                                <select name="account_type" id="AccountType" required style="color:#959595 !important">
                                    <option value="">Account Type</option>
                                    <option value="u">User</option>
                                    <option value="v">Vendor</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="text-left col-12 col-sm-12 col-md-6 col-lg-6">
                            <input type="submit" class="btn rounded mb-3" value="Submit">
                        </div>
                        <div class="text-right col-12 col-sm-12 col-md-6 col-lg-6">
                            <a href="{{url('login')}}"><i class="align-middle icon an an-an-double-left me-2"></i>Back To Login</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--End Main Content-->
        <br><br><br><br>
            <br><br><br><br>
            <br><br><br><br>
    </div>
    <!--End Container-->
</div>
<script>
    $(function() {
    $( "form" ).submit(function() {
        $('#loader').show();
    });
        });
</script>
@endsection

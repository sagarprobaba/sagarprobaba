@extends('layout.master')


@section('page_title','Profile baba')
@section('page_heading','Profile baba')

@section('head')

@endsection

@section('container')

<section class="free-list-form2">
    <div class="container">
        <div class="row">
            <div class="col-md-4" style="float: none;margin: 50px auto;">
                
                <form method="POST" class="loginfoms_otp" action="{{ route('verify_otp',$data) }}">
                    @csrf
                    
                    <div class="form-group" id="otp_box" >
                        <label>Mobile OTP</label>
                        <input id="mobile_otp" type="text" class="form-control{{ $errors->has('mobile_otp') ? ' is-invalid' : '' }}" name="mobile_otp" >
            
                        @if ($errors->has('mobile_otp'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('mobile_otp') }}</strong>
                        </span>
                        @endif
                    </div>
                
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Verify') }}
                        </button>
                            
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>

@endsection
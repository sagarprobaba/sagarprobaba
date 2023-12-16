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

                <div id="" style="display: none;" class="alert alert-success login_massage" role="alert">
                    <p>You are successfully logged in</p>
                </div>
                <div id="" style="display: none;" class="alert alert-danger login_massage_arrer" role="alertN">
                    <p>These credentials do not match our records.</p>
                </div>
                
                <form method="POST" class="loginfoms" action="{{ route('ajax.login') }}">
                    @csrf
                    <div class="form-group">
                            <label>Mobile Number</label>
                            <input id="mobile" type="text" placeholder="Mobile Number" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ old('mobile') }}"  autofocus>
                
                            @if ($errors->has('mobile'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('mobile') }}</strong>
                            </span>
                            @endif
                    </div>
                
                    <div class="form-group">
                            <label>Password</label>
                            <input id="password" placeholder="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >
                
                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                    </div>
                    
                    <div>
                        <label >
                            <input name="agreement" type="checkbox" value="agreement_don" required="" style="height: 14px;margin-right: 7px;margin-bottom: 16px;">
                            I agree to {{ config('app.name') }} 
                            <a href="{{ url('terms-conditions') }}">terms and conditions.</a>
                        </label>
                        <label>
                            <a class="btn-link" href="{{ route('register') }}" style="display: block;">
                                {{ __('Need an Account?') }}
                            </a>
                        </label>
                    </div>
                
                    <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                            
                            <div style="float: right;">
                                @if (Route::has('password.request'))
                                <a class="btn-link" href="{{ route('password.request') }}" style="display: block;">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                                
                            </div>
                            
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>

@endsection
{{-- add js section  --}}
@section('javascript')
<script type="text/javascript">
    $(document).ready(function() {
 
        var frm = $('.loginfoms')
        frm.submit(function (e) {
            e.preventDefault();
            var formdata = $(this).serialize();
            var href = $(this).attr('action');
            $.ajax({
                headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
                url: href,
                type: 'POST',
                cache: false,
                data: formdata,
                datatype: 'Json',
                success: function(data) {
                    if(data==1){
                        $('.login_massage').show();
                        $('.login_massage').text("You are successfully logged in");
                        setTimeout(function(){ location.reload(); }, 1000);
                    }else{

                        $('.login_massage_arrer').show();
                        $('.login_massage_arrer').text("These credentials do not match our records.");
                        setTimeout(function(){ 
                            $('.login_massage_arrer').hide();
                        }, 2000);
                    }
                },
                error: function(xhr,textStatus,thrownError) {
                    $('.error').remove();
                    $.each(xhr.responseJSON.errors, function( index, value ) {
                        $('.loginfoms').find( "input[name="+index+"],select[name="+index+"],textarea[name="+index+"],select[name='"+index+"[]']").after( "<span class='text-danger error'>"+ value +"</span>" );
                    });
                    if (xhr.status == 401){
                    }
                }
            });
        });
    });
</script>
@endsection
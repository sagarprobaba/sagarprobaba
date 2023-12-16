@extends('layout.master')
@section('page_title',config('app.name'))
@section('page_heading',config('app.name'))

@section('head')

<style type="text/css">
	.visitors.email_verifier #email-verifier-form {
		margin: 0 auto 100px;
		max-width: 770px;
		padding: 40px;
		border-radius: 3px;
		-moz-border-radius: 3px;
		-webkit-border-radius: 3px;
		background-color: #fff;
		box-shadow: 0 6px 30px
		rgba(0,0,0,.25);
	}
	.main-input-group {
		width: calc(100% + 8px);
		margin: 0 -4px;
		border: 1px solid #d2d2d2;
		box-shadow: 0 1px 3px
		rgba(0,0,0,.06);
		border-radius: 3px;
		transition: all 150ms ease;
		height: 52px;
		z-index: 1;
	}
	.main-input-group input[type="email"] {
		background: #fefefe;
		padding: 15px 14px;
		font-size: 15px;
		height: 52px;
		border: 0 !important;
	}
	.main-input-group button {
		text-align: center;
		padding: 12px 30px;
		color: #191919;
		height: 52px;
		min-width: 82px;
		text-align: center;
		color: #666;
		font-size: 14px;
		font-weight: 600;
		border: 0;
		border-left-color: currentcolor;
		border-left-style: none;
		border-left-width: 0px;
		border-left: 1px solid #d9d9d9;
		border-radius: 0 3px 3px 0;
		transition: all 150ms ease;
	}
	.verifier-message {
		padding-top: 20px;
		color: #888;
	}
	.NJIUIUHOHIU{
		margin: 48px 0 100px;
		margin-bottom: 22px;
		font-weight: 500;
		font-size: 35px;
		text-align: center;
	}
	.subtitle {
		font-size: 18px;
		line-height: 30px;
		font-weight: 500;
		max-width: 600px;
		letter-spacing: 0;
		text-align: center;
		margin: 15px auto 0;
		color: #898484;
	}
	.l_F_G_G_{
		margin: auto;
		margin-top: auto;
		display: inherit;
		margin-top: 12px;
		background: #ec1d24;
		border-radius: 0;
		padding: 10px 28px;
		color: #fff;
		font-size: 14px;
	}
	section.faq {
		border-top: 2px solid 
		#e6e6e6;
		background-color:
		#fafbfb;
		color:
		#191919;
		padding: 80px 0 100px;
	}
	section.faq .faq-reply {
		padding-left: 25px;
		line-height: 26px;
		border-left: 3px solid 
		#e6e6e6;
	}
	section.faq h2 {
		color: 
		#333;
		font-size: 28px;
		text-align: left;
		margin-bottom: 30px;
	}
</style>

@endsection

@section('container')

<section class="product-demo visitors email_verifier">
	<div class="container">
		<h1 class="NJIUIUHOHIU">
			<i class="fa fa-check-circle"></i>
			Email Verifier
			<div class="subtitle">Verify the validity of any email address with the most complete email verification service.</div>
		</h1>
		{!! Form::model(Auth::user(),['route' => ['verify.sand'],'method' => 'post', 'id' => 'email-verifier-form']) !!}
		@if(Session::has('message'))
		<div class="alert alert-success">
			{{ Session::get('message') }}
		</div>
		@endif
		<div class="input-group main-input-group">
			{{ Form::email('email',null, ['class' => 'form-control inputDisabled', 'id' => 'email-field', 'required', 'disabled', 'placeholder' => 'Enter email']) }}
			<span class="input-group-btn">
				<button class="btn-white" data-loading="none" id="edit">
					Edit
				</button>
			</span>
		</div>
		@if ($errors->has('email'))
		<label id="email-error" class="error text-danger" for="email">
			<small>{{ $errors->first('email') }}</small>
		</label>
		@endif
		<div class="verifier-message">Enter an email address to verify its accuracy.</div>
		<button type="submit" id="service_bttn" class="btn btn-default l_F_G_G_">Email verify</button>
		{!! Form::close() !!}					
	</div>
</section>
@endsection

{{-- add prosenall js --}}
@section('javascript')

<script type="text/javascript">
	$("#edit").click(function(event){
		event.preventDefault();
	   $('.inputDisabled').prop("disabled", false); // Element(s) are now enabled.
	});
</script>
@endsection


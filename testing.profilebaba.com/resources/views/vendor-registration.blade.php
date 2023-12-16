@extends('layout.master')

@section('page_title','Business Registration')
@section('page_heading','Business Registration')

@section('head')

@endsection

@section('container')

<main>
	<section class="catds">
		<div class="container">
			<div class="row">
				<div class="col-md-8" style="margin: auto;float: none;">
					<div class="row">

						<div class="col-md-6">
							<div class="form-content">
								<div class="form-heading">
									<h2>Business Registration</h2>
								</div>

								<span id="errormsg"></span>

								<form id="ari_register_pop" method="POST" action="{{url('/ajax/register22')}}" data-redirect_after_register="{{url('/user/dashboard')}}">
									{{ csrf_field() }}
									<input type="hidden" name="member_id" value="2">

									<div class="form-group ari_register_pop_msg">
									</div>
									<div class="form-group">
										<label>Name</label>
										<input name="name" type="text" class="form-control" id="user_name" data-validation="required">
									</div>
									<div class="form-group">
										<label>Email</label>
										<input name="email" type="email" class="form-control" id="email_id" data-validation="email">
									</div>
									<div class="form-group">
										<label>Mobile Number</label>
										<input name="phone" type="text" class="form-control" id="mobile_num" data-validation="required">
									</div>
									<div class="form-group">
										<label>Password</label>
										<input name="password" type="password" class="form-control" id="password" data-validation="required">
									</div>
									<div class="form-btn"> 
										<button type="submit" id="signup" class="btn lbtn ari_register_pop_submit_btn">Submit</button>	
									</div>
									
								</form>
								
    							<br>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</section>
</main>

@endsection
{{-- add js section  --}}
@section('javascript')

@endsection
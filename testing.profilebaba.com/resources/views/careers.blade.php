@extends('layout.master')


@section('page_title','Profile baba')
@section('page_heading','Profile baba')

@section('head')

@endsection

@section('container')

<section class="catds">

	<div class="jumbotron profile_banner" style="background:#333; background-size: 100%;margin-top:5px;">
		<div class="container for-about no_bg">
			<h1>Career</h1>
			<ul class="breadcrumb">
				<li>
					<a href="{{url('/')}}">Home</a>
				</li>
				<li class="current"><span>Career</span></li>
			</ul>
		</div>
	</div>


	<section class="career_page">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<div class="row">
						<div class="col-sm-12">
							<div class="career_page_heading">
								<h3>Application Information</h3>

								<p class="pb-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>
							</div>
						</div>

						<div class="col-md-12">

							<form id="contact_us_pop" action="{{ route('contact_us_submit') }}" method="post">

								<div class="form-group contact_us_pop_msg">
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>First Name</label>
											<input type="text" name="f_name" placeholder="First Name" class="form-control" data-validation="required">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Last Name</label>
											<input type="text" name="l_name" placeholder="Last Name" class="form-control" data-validation="required">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Email</label>
											<input type="text" name="email" placeholder="Email" class="form-control" data-validation="required">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Phone Number</label>
											<input type="text" name="phone" placeholder="Phone Number" class="form-control" data-validation="required">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Message</label>
											<textarea rows="5" name="message" placeholder="Message" class="form-control" data-validation="required"></textarea>
										</div>
									</div>

									<div class="col-sm-12">
										<div class="frm-btn text-center"><button class="form-sub-btn btn career-btn">Submit</button> </div>
									</div>

								</div>
								{{csrf_field()}}
							</form>

						</div>

					</div>
				</div>
			</div>
		</div>
	</section>

</section>

@endsection
{{-- add js section  --}}
@section('javascript')

@endsection

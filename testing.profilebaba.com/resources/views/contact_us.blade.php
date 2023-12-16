@extends('layout.master')


@section('page_title','Profile baba')
@section('page_heading','Profile baba')

@section('head')

@endsection

@section('container')

<section class="catds">

	<div class="container-fluid about_wrapper">
		<div class="container">

			<div class="row">
				<div class="col-md-7 offset-lg-1">
					<div class="heading mb--42">
						<h2>Fill The Form</h2>
						<hr class="delimeter">
					</div>

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

				<div class="col-lg-4 col-md-5 mb-md--50">

					<div class="heading mb--42">
						<h2 class="mb-30">Get In Touch</h2>
						<hr class="bdr_bottom">
					</div>
					<div class="contact-info mb--30 mt-20">
						<p><i class="fa fa-map-marker"></i>A- 13, Shyam vihar Phase 1 , Najafgarh, New Delhi,110043 </p>
						<p><i class="fa fa-phone"></i> 9625062467, 8851612763, 8700187375 </p>
						<p><i class="fa fa-envelope"></i><a href="mailto:info@profilebaba.com"> profilebaba1@gmail.com</a> </p>
					</div>
					<div class="social__item">
						<ul>
							<li> <a href="https://www.facebook.com/profile.php?id=100068096178386"> <i class="fa fa-facebook"></i> </a> </li>
							<li> <a href="https://twitter.com/babaprofile"> <i class="fa fa-twitter"></i> </a> </li>
							<li> <a href="#"> <i class="fa fa-linkedin"></i> </a> </li>
							<li> <a href="#"> <i class="fa fa-google-plus"></i> </a> </li>
						</ul>
					</div>

				</div>
			</div>
		</div>
	</div>

</section>

@endsection
{{-- add js section  --}}
@section('javascript')

@endsection

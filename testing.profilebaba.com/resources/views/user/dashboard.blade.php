@extends('layout.master')


@section('page_title','Profile')
@section('page_heading','Profile')

@section('head')

@endsection

@section('container')

<main>
	<section class="dashbord-section">
		<div class="container">

			<div class="row">

				@include('user.user_side_bar')

				<div class="col-md-9 col-sm-8">
					<div class="right-deshboard">
						<div class="panel panel-default profle4">
							<div class="panel-heading">Welcome to {{ (Auth::user()->member_id == 2)? 'Aritst' : 'User' }} dashboard</div>

							<div class="panel-body dashbbox clearfix">

								@if (Auth::user()->member_id == 2 && Auth::user()->verifiedstatus!='Yes')
								<p class="text-danger">Business account your are not verified.</p>
								@endif

								<p><strong>Name:</strong> {{ Auth::user()->name ?? 'N/A' }}</p>
								<p><strong>Email:</strong> {{ Auth::user()->email ?? 'N/A' }}</p>
								<p><strong>Contact number:</strong> {{ Auth::user()->contact_number ?? 'N/A' }}</p>

								{{--<strong> <p>My slogen: {{</strong> Auth::user()->my_slogen ?? 'N/A' }}</p> --}}
								<p><strong>Address:</strong> {{ Auth::user()->address ?? 'N/A' }}</p>

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

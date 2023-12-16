@extends('layout.master')


@section('page_title','Profile baba')
@section('page_heading','Profile baba')

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

						@if(Session::has('message'))
						<div class="alert alert-success">
							{{ Session::get('message') }}
						</div>
						@endif

						@if(Session::has('error'))
						<div class="alert alert-danger">
							{{ Session::get('error') }}
						</div>
						@endif

						@if (Session::has('errors'))
						<div class="alert alert-danger">
							@foreach ($errors->all() as $error)
							{{ $error }}<br/>
							@endforeach
						</div>
						@endif

						<div class="panel panel-default">
							<div class="panel-heading">Profile</div>
							<div class="panel-body">
								<form id="profile" action="{{url('/change_password/')}}"   enctype="multipart/form-data" method="post"  >
									{{ csrf_field() }}
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Old Password</label>
												<input type="password" class="form-control" name="old_password" id="old_password" placeholder="Old Password" >
											</div>								
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>New Password</label>
												<input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password" >
											</div>								
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>confirm Password</label>
												<input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="confirm Password" >
											</div>								
										</div>
										<div class="col-md-12">
											<button type="submit" id="pwd_change" class="sbmt-btn">Submit</button>
										</div>
									</div>
								</form>		
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
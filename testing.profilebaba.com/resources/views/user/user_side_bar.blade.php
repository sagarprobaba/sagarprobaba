@php
	$link = \Route::currentRouteName();
@endphp
<div class="col-md-3 col-sm-4">
	<div class="left-desboard">
		<div class="dash-img">

			<img class="img-responsive center-block" src="{{ CustomValue::filecheck(Auth::user()->profile_photo,'/uploads/users/')}}" style="width: 110px;border-radius: 50%;height: 110px;overflow: hidden;" >

			<div class="edit-btn">
				<a href="{{ route('user.profile_edit') }}"><span class="glyphicon glyphicon-edit"></span></a>
			</div>
		</div>
		<ul>
			<li class="{{ $link == 'user.dashboard' ? 'active':'' }}"><a href="{{ route('user.dashboard') }}"><span class="glyphicon glyphicon-user"></span> Dashboard</a></li>
			<li class="{{ $link == 'user.profile_edit' ? 'active':'' }}"><a href="{{ route('user.profile_edit') }}"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
			<li class="{{ $link == 'change.password' ? 'active':'' }}"><a href="{{ route('change.password') }}"><span class="glyphicon glyphicon-lock"></span> Change Password</a></li>

			<li class="{{ $link == 'user.enquiry_send' ? 'active':'' }}"><a href="{{ route('user.enquiry_send') }}"><span class="glyphicon glyphicon-book"></span>My Enquiry</a></li>
			{{-- <li class="{{ $link == 'user.booking_send' ? 'active':'' }}"><a href="{{ route('user.booking_send') }}"><span class="glyphicon glyphicon-book"></span>My Booking</a></li> --}}
		</ul>

		<p class="prding">Business Profile Option</p>
		<ul>
			<li class="{{ $link == 'user.enquiry' ? 'active':'' }}"><a href="{{ route('user.enquiry') }}" style="border-top: #ccc 1px solid;"><span class="glyphicon glyphicon-book"></span>Enquiry</a></li>
			<li class="{{ $link == 'user.business_profile' ? 'active':'' }}"><a href="{{ route('user.business_profile') }}"><span class="glyphicon glyphicon-book"></span>Business Profile</a></li>
            <li class="{{ $link == 'user.general_information' ? 'active':'' }}"><a href="{{ route('user.general_information') }}"><span class="glyphicon glyphicon-book"></span>Add New Profile</a></li>
		</ul>
	</div>
</div>

@php
	$link = \Route::currentRouteName();

@endphp
<ul class="nav nav-tabs">
    <h4>Business Information</h4>
    <li class="{{ $link == 'user.general_information' ? 'active':'' }}" ><a href="{{ route('user.general_information')}}">General Information</a></li>
    <li class="{{ $link == 'user.business_contact' ? 'active':'' }}" ><a href="{{ route('user.business_contact')}}">Contact Information</a></li>
    <li class="{{ $link == 'user.service_location' ? 'active':'' }}" ><a href="{{ route('user.service_location')}}">Service Locations</a></li>
    <li class="{{ $link == 'user.business_other' ? 'active':'' }}" ><a href="{{ route('user.business_other')}}">Other Information</a></li>
    <li class="{{ $link == 'user.business_upload_video' ? 'active':'' }}" ><a href="{{ route('user.business_upload_video')}}">Upload Files</a></li>
    <li class="{{ $link == 'user.dashboard' ? 'active':'' }}" ><a href="{{ route('user.dashboard')}}">Exit</a></li>
</ul>

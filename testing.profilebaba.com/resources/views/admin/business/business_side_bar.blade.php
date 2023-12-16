@php
	$link = \Route::currentRouteName();

@endphp
<ul class="nav nav-tabs">
    <h4>Business Information</h4>
    <li class="{{ $link == 'admin.user.business_location' ? 'active':'' }}" ><a href="{{ route('admin.user.business_location',['userid'=>$userid ?? $data['user_id'],'id'=>$data['vendor_id']??0])}}">General Information</a></li>
    <li class="{{ $link == 'admin.user.business_contact' ? 'active':'' }}" ><a href="{{ route('admin.user.business_contact',$data['vendor_id']??0)}}">Contact Information</a></li>
    <li class="{{ $link == 'admin.user.service_location' ? 'active':'' }}" ><a href="{{ route('admin.user.service_location',$data['vendor_id']??0)}}">Service Locations</a></li>
    <li class="{{ $link == 'admin.user.business_other' ? 'active':'' }}" ><a href="{{ route('admin.user.business_other',$data['vendor_id']??0)}}">Other Information</a></li>
    <li class="{{ $link == 'admin.user.business_upload_video' ? 'active':'' }}" ><a href="{{ route('admin.user.business_upload_video',$data['vendor_id']??0)}}">Upload Files</a></li>
</ul>
<style>
#user_register .form-group{
    width: 50%;
    padding: 10px;
    float: left;
}
#user_register .form-group.sbtn5{
    width: 100%;
    padding: 10px;
    float: left;
}
#user_register .week .form-group{
    width: 100%;
    padding: 0;
    float: left;
}
#user_register .form-group.cperson label{
    width: 100%;
    display: block;
}
#user_register .form-group.cperson .form-control{
    width: 80%;
    float: left;
}
#user_register .form-group.cperson .form-control.pre{
    width: 20%;
    float: left;
}
</style>
@extends('admin.layout.master')

@section('page_title','Enquiry')

@section('title','Enquiry')

@section('container')




@if(Session::has('message'))
<div class="alert alert-success">
	{{ Session::get('message') }}
</div>
@endif




@if (Session::has('errors'))
<div class="alert alert-danger">
	@foreach ($errors->all() as $error)
	{{ $error }}<br/>
	@endforeach
</div>
@endif

<a  class="btn  btn-secondary " href="{{url('/admin/enquiry_lawyer')}}"><i class="fa fa-chevron-circle-left"></i> Back</a>

<br />
<table class="table table-hover  table-striped">
	<tr>
		<td>Business Profile</td>
		<td>
			@if($item->user)
			<a href="{{url('/admin/user/'.$item->userid.'/edit')}}" target="_blank">{{$item->user->name}}  </a>
			@endif
		</td>
	</tr>
	<tr>
		<td> Name </td>
		<td>{{$item->name}} </td>
	</tr>

	<tr>
		<td> Email </td>
		<td>{{$item->email}} </td>
	</tr>
	<tr>
		<td> Phone </td>
		<td>{{$item->phone}} </td>
	</tr>
	@if ($item->event)
	<tr>
		<td>Work and service:</td>
		<td>{{ str_replace('?','₹',$item->event) }}</td>
	</tr>
	@endif
	<tr>
		<td> Message</td>
		<td>{{$item->message}} </td>
	</tr>
</table>
<br />
<a  class="btn  btn-secondary " href="{{url('/admin/enquiry_lawyer')}}"><i class="fa fa-chevron-circle-left"></i> Back</a>
@endsection

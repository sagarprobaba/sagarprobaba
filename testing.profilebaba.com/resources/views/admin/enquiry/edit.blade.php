@extends('admin.layout.master')

@section('page_title','Booking')

@section('title','Booking')

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

<a  class="btn  btn-secondary " href="{{ route('admin_enquiry') }}"><i class="fa fa-chevron-circle-left"></i> Back</a>
<br />
<table class="table table-hover  table-striped">
	<tr>
		<td>vendor</td> 
		<td>
			@if($item->user) 
			<a href="{{url('/admin/user/'.$item->vendor_id.'/edit')}}" target="_blank">{{$item->user->name}}  </a>
			@endif
		</td>
	</tr>
	<tr>
		<td> Name </td> 
		<td>
			{{$item->name}}
			@if($item->user_by)
			<a href="{{url('/admin/user/'.$item->userid.'/edit')}}" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a>
			@endif
		</td>
	</tr>

	<tr>
		<td> Email </td> 
		<td>{{$item->email}} </td>
	</tr>
	<tr>
		<td> Phone </td> 
		<td>{{$item->phone}} </td>
	</tr>
	<tr>
		<td>Event Type:</td>
		<td>{{ str_replace('?','₹',$item->event) }}</td>
	</tr>
	<tr>
		<td> State </td> 
		<td>{{$item->state->stitle ?? ''}} </td>
	</tr>
	<tr>
		<td> City </td> 
		<td>{{$item->city_one->title ?? ''}} </td>
	</tr>
	<tr>
		<td> Date </td> 
		<td>{{$item->date }} </td>
	</tr>
	<tr>
		<td>First performance to START at: </td> 
		<td>{{$item->starttime}} </td>
	</tr>
	<tr>
		<td>Final performance to END at: </td> 
		<td>{{$item->finishtime}} </td>
	</tr>

	<tr>
		<td>Payment gateway: </td> 
		<td>{{$item->payment_gateway}} </td>
	</tr>

	<tr>
		<td>Payment status: </td> 
		<td><span class="badge badge-primary" >{{$item->payment_gateway_transaction_status}}</span></td>
	</tr>

	<tr>
		<td>Payment Data: </td> 
		<td>
			@if ($item->payment_gateway_data)
			<div style="max-height: 200px;overflow: auto;">
				<?php 
				$payment_gateway_data = json_decode($item->payment_gateway_data, true);
				$payment_gateway_data = array_filter($payment_gateway_data);
				?>
				@foreach ($payment_gateway_data as $p_g_key => $p_f_values)

				{{ $p_g_key }}: {{ $p_f_values }}<br>

				@endforeach
			</div>
			@endif
		</td>
	</tr>

	<tr>
		<td> Message</td> 
		<td>{{$item->message}} </td>
	</tr>
	<tr>
		<td>created at:</td>
		<td>{{ $item->created_at }}</td>
	</tr>
</table> 
<a  class="btn  btn-secondary " href="{{ route('admin_enquiry') }}"><i class="fa fa-chevron-circle-left"></i> Back</a>
@endsection
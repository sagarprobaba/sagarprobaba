@extends('admin.layout.master')

@section('page_title','contact')

@section('title','contact')

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

<a  class="btn  btn-secondary " href="{{ route('admin_contact') }}"><i class="fa fa-chevron-circle-left"></i> Back</a>

<br />
<table class="table table-hover  table-striped">
	<tr>
		<td> Name </td> 
		<td>{{$item->f_name}} {{$item->l_name}}</td>
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
		<td> Message</td> 
		<td>{{$item->message}} </td>
	</tr>
</table> 
<br />
<a  class="btn  btn-secondary " href="{{ route('admin_contact') }}"><i class="fa fa-chevron-circle-left"></i> Back</a>
@endsection
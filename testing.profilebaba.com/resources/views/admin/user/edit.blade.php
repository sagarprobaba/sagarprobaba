@extends('admin.layout.master')
@section('page_title','Area')
@section('page_heading','Area')
@section('add_link',url('/admin/region/create'))
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

{!! Form::model($item,['route' => ['user.update', $item->id],'method' => 'patch', 'novalidate' => 'novalidate',  'autocomplete' => 'off', 'enctype' => 'multipart/form-data',]) !!}

<section class="top-bredcumb">
	<div class="row">
		<div class="col-lg-3">
			<h4>Create User Option</h4>
		</div>
		<div class="col-lg-6">				
			<ul class="breadcrumb">
				<li><a href="#">Dashboard</a></li>
				<li><a href="#">User Manager</a></li>
				<li>edit</li>
			</ul>
		</div>
		<div class="col-lg-3 text-right">
			<button type="submit" class="btn btn-round btn-success save-btn" name="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
			<button type="button" class="btn btn-round btn-warning reset-btn"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
			<button type="button" class="btn btn-round btn-danger back-btn"><i class="fa fa-undo" aria-hidden="true"></i> Back</button>
		</div>
	</div>
</section>

@php
	$user = $item;
@endphp
@include('admin.user._form_htlm')

{!! Form::close() !!}
@endsection
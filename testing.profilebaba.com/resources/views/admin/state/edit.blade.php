@extends('admin.layout.master')

@section('page_title','state')

@section('page_heading','state')

@section('add_link',url('/admin/state/create'))

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

<script type="text/javascript" src="{{asset('/public/admin/ckeditor/ckeditor.js')}}"></script>

{!! Form::model($item,['route' => ['state.update', $item->stid],'method' => 'patch', 'novalidate' => 'novalidate',  'autocomplete' => 'off', 'enctype' => 'multipart/form-data',]) !!}

<section class="top-bredcumb">
	<div class="row">
		<div class="col-lg-3">
			<h4>Edit State</h4>
		</div>
		<div class="col-lg-6">				
			<ul class="breadcrumb"> 
				<li><a href="#">Dashboard</a></li>
				<li><a href="#">State</a></li>
				<li>Edit</li>
			</ul>
		</div>
		<div class="col-lg-3 text-right">
			<button type="submit" class="btn btn-round btn-success save-btn" name="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
		</div>
	</div>
</section>

@include('admin.state._form_htlm')

{!! Form::close() !!}
@endsection



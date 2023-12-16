@extends('admin.layout.master')

@section('page_title', $type['title'])

@section('page_heading', $type['titles'])

@section('add_link',route($type['route_pr'].'create'))

@section('container')

{!! Form::model($data,['route' => [$type['route_pr'].'update', $data->id],'method' => 'patch', 'novalidate' => 'novalidate', 'enctype' => 'multipart/form-data',]) !!}

<section class="top-bredcumb">
	<div class="row">
		<div class="col-lg-3">
			<h4>Edit {{ $type['title'] }} </h4>
		</div>
		<div class="col-lg-6">				
			<ul class="breadcrumb">
				<li><a href="#">Dashboard</a></li>
				<li><a href="#">{{ $type['title'] }} Manager</a></li>
				<li>Edit</li>
			</ul>
		</div>
		<div class="col-lg-3 text-right">
			<button type="submit" class="btn btn-round btn-success save-btn" name="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
		</div> 
	</div> 

</section>

<div class="row">
	<div class="col-lg-9">
		<section class="panel">
			<div class="panel-body">
				<div class="row">

					@include('admin.ItemB._form')

				</div>	
			</div>
		</section>
	</div>
	<input type ="hidden" name="submit" value="submit">
</div>

{!! Form::close() !!}


@endsection

{{-- add prosenall js --}}
@section('javascript')

<script type="text/javascript" src="{{asset('/public/admin/ckeditor/ckeditor.js')}}"></script>

@endsection

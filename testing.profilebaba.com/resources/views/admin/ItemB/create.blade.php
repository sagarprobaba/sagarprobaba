@extends('admin.layout.master')

@section('page_title', $type['title'])

@section('page_heading', $type['titles'])

@section('container')

{!! Form::open(['route' => [$type['route_pr'].'store'],'method' => 'post', 'novalidate' => 'novalidate', 'enctype' => 'multipart/form-data',]) !!}

<section class="top-bredcumb">
	<div class="row">
		<div class="col-lg-3">
			<h4>{{ $type['title'] }}</h4>
		</div>
		<div class="col-lg-6">				
			<ul class="breadcrumb">
				<li><a href="#">Dashboard</a></li>
				<li><a href="#">{{ $type['title'] }} Manager</a></li>
				<li>Create</li>
			</ul>
		</div> 

		<div class="col-lg-3 text-right">
			<button type="submit" class="btn btn-round btn-success save-btn" name="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
		</div>
	</div>
</section>
<div class="row">
	<div class="col-lg-12">
		<section class="panel">
			<div class="panel-body">
				<div class="row">

					@include('admin.ItemB._form')

				</div>

			</div>
		</section>


	</div>

</section>
{!! Form::close() !!}

@endsection

{{-- add prosenall js --}}
@section('javascript')

@endsection

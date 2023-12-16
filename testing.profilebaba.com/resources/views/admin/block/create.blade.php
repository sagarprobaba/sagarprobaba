@extends('admin.layout.master')
@section('page_title','block')
@section('page_heading','block')
@section('add_link',route('block.store'))
@section('container')

{!! Form::open(['route' => ['block.store'],'method' => 'post', 'novalidate' => 'novalidate', 'enctype' => 'multipart/form-data',]) !!}

<section class="top-bredcumb">
	<div class="row">
		<div class="col-lg-3">
			<h4>block</h4>
		</div>
		<div class="col-lg-6">				
			<ul class="breadcrumb">
				<li><a href="#">Dashboard</a></li>
				<li><a href="#">block Manager</a></li>
				<li>Create</li>
			</ul>
		</div>

		<div class="col-lg-3 text-right">
			<button type="submit" class="btn btn-round btn-success save-btn" name="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
			<button type="button" class="btn btn-round btn-warning reset-btn"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
			<button type="button" class="btn btn-round btn-danger back-btn"><i class="fa fa-undo" aria-hidden="true"></i> Back</button>
		</div>
	</div>
</section>
<div class="row">
	{{csrf_field()}}
	<div class="col-lg-12">
		<section class="panel">
			<div class="panel-body">
				<div class="row">

					@include('admin.block._form')

				</div>

			</div>
		</section>

		{!! Form::close() !!}

	</div>

</section>

@endsection

{{-- add prosenall js --}}
@section('javascript')

@endsection

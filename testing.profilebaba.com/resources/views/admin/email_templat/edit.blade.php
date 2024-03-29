@extends('admin.layout.master')

@section('page_title','Email Templates ')

@section('page_heading','Email Templates ')

@section('add_link',route('email-templates.create'))

@section('container')

{!! Form::model($emailTemplate,['route' => ['email-templates.update', $emailTemplate->id],'method' => 'patch', 'novalidate' => 'novalidate', 'enctype' => 'multipart/form-data',]) !!}

<section class="top-bredcumb">
	<div class="row">
		<div class="col-lg-3">
			<h4>Edit Email Templates </h4>
		</div>
		<div class="col-lg-6">				
			<ul class="breadcrumb">
				<li><a href="#">Dashboard</a></li>
				<li><a href="#">Email Templates Manager</a></li>
				<li>Edit</li>
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
	<div class="col-lg-9">
		<section class="panel">
			<header class="panel-heading">Email Templates Details</header>
			<div class="panel-body">
				<div class="row">

						@include('admin.email_templat._form')

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

<script>
	$(document).ready(function() {
		$('.state').select2();
	});


	$("#title").keyup(function(){

		var Text = $(this).val();
		Text = Text.toLowerCase();
		var regExp = /\s+/g;
		Text = Text.replace(regExp,'-');
		
		$("#slug").val(Text);        
	});
</script>

@endsection

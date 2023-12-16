@extends('admin.layout.master')
@section('page_title','Education')
@section('page_heading','Education')
@section('add_link',url('/admin/court/create'))
@section('container')

{!! Form::open(['route' => ['court.store'],'method' => 'post', 'novalidate' => 'novalidate', 'enctype' => 'multipart/form-data',]) !!}

	<section class="top-bredcumb">
		<div class="row">
			<div class="col-lg-3">
				<h4>Education</h4>
			</div>
			<div class="col-lg-6">				
				<ul class="breadcrumb">
					<li><a href="#">Dashboard</a></li>
					<li><a href="#">Education Manager</a></li>
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

						@include('admin.court._form_htlm')

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

<script>
	$(document).ready(function() {
		$('.state').select2();
		$('.city').select2();
		$('.area').select2();
		$('.pincode').select2();

		$('.state').change(function() {
			$('.city').empty();
			$('.area').empty();
			$('.pincode').empty();

			var stid = $('.state').val();

			var qc = "stid="+stid;

			$.ajax({
				url:"{{url('/admin/ajax/city_list')}}",
				type:"GET",
				data:qc,
				success:function(output){
					$('.city').html(output);
					
				}	
			});

		});

		$('.city').change(function() {

			$('.area').empty();
			$('.pincode').empty();

			var ctid = $('.city').val();
			var qc = "ctid="+ctid;
			

			$.ajax({
				url:"{{url('/admin/ajax/area_list')}}",
				type:"GET",
				data:qc,
				success:function(output){
					$('.area').html(output);
					
				}	
			});
			
			$.ajax({
				url:"{{url('/admin/ajax/pincode_list')}}",
				type:"GET",
				data:qc,
				success:function(output){
					$('.pincode').html(output);
					
				}	
			});		

		});

	});
</script>

@endsection

@extends('admin.layout.master')
@section('page_title','Pincode')
@section('page_heading','Pincode')
@section('add_link',url('/admin/pincode/create'))
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
<form action="{{url('/admin/pincode/'.$item->pinid)}}" name="frm_add_pincode"  enctype="multipart/form-data" method="post" accept-charset="utf-8">
	{{ csrf_field() }}
	{{ method_field('PUT')}}  
	
	<section class="top-bredcumb">
		<div class="row">
			<div class="col-lg-3">
				<h4>Update Pincode</h4>
			</div>
			<div class="col-lg-6">				
				<ul class="breadcrumb">
					<li><a href="#">Dashboard</a></li>
					<li><a href="#">Pincode Manager</a></li>
					<li>Update</li>
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

				<header class="panel-heading">Pincode Details</header>

				<div class="panel-body">

					<div class="form-group">
						<select  name="coid" id="country" class="form-control country javascript_select" >
							<?php
							$StateController = new App\Http\Controllers\Admin\StateController;
							echo $StateController->country_list([$item->coid]);
							?>
						</select>
					</div>                                             				
					<div class="form-group">
						<select  name="stid" id="state" class="form-control state javascript_select" >
							<?php
							$StateController=new App\Http\Controllers\Admin\StateController;
							echo $StateController->state_list([$item->stid]);
							?>	
						</select>
					</div>
					<div class="form-group">
						<select  name="ctid" id="city" class="form-control city javascript_select">
							<option value="" selected="selected">Select City</option>	
						</select> 
					</div>

					<div class="form-group">
						<select  name="regid" id="area" class="form-control area javascript_select">
							<option value="" selected="selected">Select Area</option>	
						</select>
					</div>

					<div class="form-group">
						<input type="text" name="ptitle" class="form-control" value="{{$item->ptitle}}">
					</div>

				</div>

			</section>

		</div>

		
		<input type ="hidden" name="submit" value="submit">
		

	</div>
</form>
@endsection
@section('javascript')
<script>
	$(document).ready(function() {
		$('.country').change(function() {
			$('.state').empty();
			var coid = $('.country').val();
			var qs = "coid="+coid;
			$.ajax({
				url:"{{url('/admin/ajax/state_list')}}",
				type:"GET",
				data:qs,
				success:function(output){
					$('.state').html(output);

					$(".state option").each(function(){
					    if($(this).val() == '{{ $item->stid }}'){
					    	$(this).prop('selected', true);
					    }
					});
				}	
			});
		});
		
		$('.state').change(function() {

			$('.city').empty();
			var stid = $('.state').val();

			select_city(stid);

		});
		function select_city(stid=0){
			var qc = "stid="+stid;
			$.ajax({
				url:"{{url('/admin/ajax/city_list')}}",
				type:"GET",
				data:qc,
				success:function(output){
					$('.city').html(output);

					$(".city option").each(function(){
					    if($(this).val() == '{{ $item->ctid }}'){
					    	$(this).prop('selected', true);
					    }
					});
				}	
			});
		}
		select_city({{ $item->stid }});

		$('.city').change(function() {
			$('.area').empty();
			var ctid = $('.city').val();
			select_area(ctid);

		});
		function select_area(ctid=0){
			var qc = "ctid="+ctid;
			$.ajax({
				url:"{{url('/admin/ajax/area_list')}}",
				type:"GET",
				data:qc,
				success:function(output){
					$('.area').html(output);

					$(".area option").each(function(){
					    if($(this).val() == '{{ $item->regid }}'){
					    	$(this).prop('selected', true);
					    }
					});
				}	
			});
		}
		select_area({{ $item->ctid }});

	});
</script>
@endsection
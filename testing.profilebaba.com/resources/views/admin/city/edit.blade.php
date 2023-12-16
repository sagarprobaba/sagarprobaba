@extends('admin.layout.master')

@section('page_title','City')

@section('page_heading','City')

@section('add_link',url('/admin/City/create'))

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
{{-- {{ dd($item->title) }} --}}
<form action="{{ route('city.update',$item->ctid) }}" name="frm_add_categories" id="frm_add_categories" enctype="multipart/form-data" method="post" accept-charset="utf-8">


	{{ csrf_field() }}
	{{ method_field('PUT')}}  

	<section class="top-bredcumb">

		<div class="row">

			<div class="col-lg-3">

				<h4>Create Citys</h4>

			</div>

			<div class="col-lg-6">				

				<ul class="breadcrumb">

					<li><a href="#">Dashboard</a></li>

					<li><a href="#">Citys Manager</a></li>

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

				<header class="panel-heading">Citys Details</header>
				<div class="panel-body">

					<div class="form-group">

						<select  name="coid" id= "country" class="form-control country javascript_select">

							<?php
							$StateController=new App\Http\Controllers\Admin\StateController;
							echo $StateController->country_list([$item->coid]);
							?>
							
						</select>

					</div>
					
					<div class="form-group">

						<select  name="stid" id= "state" class="form-control state javascript_select">
						</select>

					</div>

					<div class="form-group">

						<input type="text" name="title" id="categoriesTitle" class="form-control" value="{{ $item->title }}">


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
		// $('.country').change(function() {
		$(document).on("change",'.country',function(){
			state_select();
		});

		state_select();
		function state_select(){
			$('.state').empty();
			var coid=$('.country').val();
			var qs="coid="+coid;
			$.ajax({
				url:"{{url('/admin/ajax/state_list')}}",
				type:"GET",
				data:qs,
				success:function(output){
					$('.state').html(output);
					
					$(".state option").each(function(){
					    // Add $(this).val() to your list
					    if($(this).val() == '{{ $item->stid }}'){
					    	$(this).prop('selected', true);
					    }
					});
				}
			});
		}
	});
</script>
@endsection
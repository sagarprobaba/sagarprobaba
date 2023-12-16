@extends('admin.layout.master')

@section('page_title','City')

@section('page_heading','City')

@section('add_link',url('/admin/city/create'))

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
<form action="{{url('/admin/city/')}}" name="frm_add_categories"  enctype="multipart/form-data" method="post" accept-charset="utf-8">

	<section class="top-bredcumb">

		<div class="row">

			<div class="col-lg-3">

				<h4>Create City Option</h4>

			</div>

			<div class="col-lg-6">				

				<ul class="breadcrumb">

					<li><a href="#">Dashboard</a></li>

					<li><a href="#">City Manager</a></li>

					<li>Create</li>

				</ul>

			</div>

			<div class="col-lg-3 text-right">

				<button type="submit" class="btn btn-round btn-success save-btn" name="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>

			</div>

		</div>

	</section>

	<div class="row">

		{{csrf_field()}}
		<div class="col-lg-9">

			<section class="panel">

				<header class="panel-heading">City Details</header>

				<div class="panel-body">

					<div class="form-group">

						<select  name="coid" id= "country" class="form-control country javascript_select" >

							<?php
							$StateController=new App\Http\Controllers\Admin\StateController;
							echo $StateController->country_list();
							?>
							
						</select>

					</div>
					
					<div class="form-group">

						<select  name="stid" id= "state" class="form-control state javascript_select" >

							<option value="" selected="selected">Select state</option>
							
						</select>

					</div>


					<div class="form-group">
						<input required type="text" min="1" name="title" id="categoriesTitle" class="form-control" placeholder="City Name">

					</div>

				</div>

			</section>

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

			var coid=$('.country').val();

			var qs="coid="+coid;
			
			$.ajax({
				url:"{{url('/admin/ajax/state_list')}}",
				type:"GET",
				data:qs,
				success:function(output){
					$('.state').html(output);
				}
			});
		});

	});
</script>
@endsection
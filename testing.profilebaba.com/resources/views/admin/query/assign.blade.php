@extends('admin.layout.master')

@section('page_title','Assign Query')

@section('page_heading','Assign Query')

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
<form action="{{url('/admin/assign-vendor-query/')}}" name="frm_add_categories" id="frm_add_categories" enctype="multipart/form-data" method="post" accept-charset="utf-8">

	<section class="top-bredcumb">

		<div class="row">

			<div class="col-lg-3">

				<h4>Assign Query</h4>

			</div>

			<div class="col-lg-6">				

				<ul class="breadcrumb">

					<li><a href="#;">Dashboard</a></li>

					<li><a href="#;">Query Manager</a></li>

					<li>Assign</li>

				</ul>

			</div>

			<div class="col-lg-3 text-right">

				<button type="submit" class="btn btn-round btn-success save-btn" name="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>

				<button onclick="window.history.go(-1); return false;" type="button" class="btn btn-round btn-danger back-btn"><i class="fa fa-undo" aria-hidden="true"></i> Back</button>

			</div>

		</div>

	</section>
	
	

	<div class="row">

		{{csrf_field()}}
		<div class="col-lg-8">

			<section class="panel">

				<header class="panel-heading">User Details</header>

				<div class="panel-body">
                    <h5>{{$query->user->name}}</h5>
                    <p><b>Contact number: </b>{{$query->user->contact_number}}</p>
					<p><b>Category: </b>{{$query->category->title}}</p>
                    <p><b>Location: </b>{{$query->location}}</p>				
					<p><b>Date: </b>{{$query->created_at}}</p>
				</div>

			</section>

		</div>

		<div class="col-lg-4 removePaddingLeft">

			<section class="panel">

				<header class="panel-heading">Assign to Executive</header>

				<div class="panel-body">
                    <input type="hidden" name="query_id" value="{{$query->id}}"/>
					<div class="form-group">

						<label for="assignTo">Executive List:</label>

						<select name="assigned_to" id="assignTo" class="form-control">

							<option value="0">Select Executive</option>
							<?php 
							$category=\App\Admin::where('role_id',3)->get();
							?> 
							@foreach($category as $val)
							<option value="{{$val->id}}" {{$query->assigned_to == $val->id ? "selected" : ""}}>{{$val->name}}</option>
							@endforeach
							
						</select>

					</div>
				</div>

			</section>

		</div>
		

	</div>
</form>

@endsection



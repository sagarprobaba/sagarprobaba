@extends('admin.layout.master')

@section('page_title','Google Vendor')

@section('page_heading','Google Vendor')

@section('add_link',url('/admin/add-google-vendor'))

@section('top')
@include('admin.layout.top')
@endsection

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

{!! Form::model(request()->all(),['route' => ['get_google_vendor'],'method' => 'get', 'id' => 'filter', 'class' => 'djgbnijb form-inline']) !!}

	<div class="form-group">
		{{ Form::text('name',null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Full Name']) }}
	</div>

	<div class="form-group">
		{{ Form::text('category',null, ['class' => 'form-control', 'id' => 'category', 'placeholder' => 'category']) }}
	</div>

	<div class="form-group">
		{{ Form::text('phone',null, ['class' => 'form-control', 'id' => 'phone', 'placeholder' => 'Phone']) }}
	</div>
	<button type="submit" class="btn btn-default">Submit</button>
	<p style="display: inline-block;font-size: 17px;line-height: 29px;margin-left: 10px;"><span id="lawyer_count">{{ $total_users }}</span> Vendors</p>
	<br>
{!! Form::close() !!}

<div class="adv-table">
		
		<table class="table table-striped table-hover table-bordered">
			<thead>
				<tr>
					<th class="text-center">ID</th>
					<th class="text-center">Name</th>
					<th class="text-center">Contact Number</th>
					<th class="text-center">Category</th>
					<th class="text-center">Location</th>
					<th class="text-center">Search Category</th>
					<th class="text-center">Search Location</th>
					<th class="text-center">Status</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody class="content" id="add_prodect_ajax">
				@include('admin.googleVendor.google_vendor')

			</tbody>
		</table>

</div>

<div class="row">
    <div class="col-md-12">
		<?php 
			$pagination_data =$vendor;
		?>
		<div class="dataTables_paginate paging_bootstrap pagination" id="pagination_data">
			@include('includes.pagination')
		</div>
    </div>
</div>

	<div class="modal fade" id="moveVendor" tabindex="-1" role="dialog" aria-labelledby="moveVendorLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="moveVendorLabel">Move Vendor</h5>
				</div>
				<form method="post" action="{{url('/admin/move-google-vendor')}}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				{{ csrf_field() }}
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6 form-group">
								<label>Contact Person Name</label>
								<input type="text" required class="form-control" name="name" placeholder="Contact Person Name"/>
							</div>
							<div class="col-md-6 form-group">
								<label>Mobile Number</label>
								<input type="text" required class="form-control" id="contact_number" placeholder="Mobile Number" name="contact_number"/>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-group">
								<label>Email</label>
								<input type="email" class="form-control" placeholder="Email" name="email"/>
							</div>
							<div class="col-md-6 form-group">
								<label>Password</label>
								<input type="text" class="form-control" placeholder="Password" name="password"/>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-group">
								<label>Address</label>
								<input type="text" class="form-control" placeholder="Address" name="address" id="address"/>
							</div>
							<div class="col-md-6 form-group">
								<label>Profile Picture</label>
								<input type="file" class="form-control" name="profile_pic"/>
							</div>
						</div>
						<input type="hidden" id="google_vendor_id" name="google_vendor_id" value=""/>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>

@endsection

<script>
	function movevendor($id, $mobile, $address) {
		$("#google_vendor_id").val($id);
		$("#contact_number").val($mobile);
		$("#address").val($address);
		$("#moveVendor").modal("show");
	}
</script>
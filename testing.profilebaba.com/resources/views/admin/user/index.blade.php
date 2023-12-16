@extends('admin.layout.master')
@section('page_title','User')
@section('page_heading','User')
@section('add_link',url('/admin/user/create'))
@section('top')
@include('admin.layout.top')
@endsection
@section('container')

<style type="text/css" media="screen">
	.djgbnijb{
		padding-bottom: 12px;
		border-bottom: 1px solid #bec3c7;
	}
	.dataTables_paginate{
		padding: 0;
		margin-bottom: 0 !important;
	} 
	.dataTables_paginate .pagination{
		margin: 0;
	}
	.djgbnijb.form-inline .form-group {
        margin-bottom: 2px;
        margin-top: 2px;
    }
</style>
{!! Form::model(request()->all(),['route' => ['admin_user'],'method' => 'get', 'id' => 'filter', 'class' => 'djgbnijb form-inline']) !!}

	<div class="form-group">
		{{ Form::text('name',null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Full Name']) }}
	</div>

	<div class="form-group">
		{{ Form::text('email',null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email']) }}
	</div>

	<div class="form-group">
		{{ Form::text('phone',null, ['class' => 'form-control', 'id' => 'phone', 'placeholder' => 'Phone']) }}
	</div>
	<button type="submit" class="btn btn-default">Submit</button>
	<p style="display: inline-block;font-size: 17px;line-height: 29px;margin-left: 10px;"><span id="lawyer_count">{{ $total_users }}</span> Users</p>
	<br>
{!! Form::close() !!}

<div class="adv-table">
	<table class="table table-striped table-hover table-bordered" id="user_table">
		<thead>
			<tr>
				<th class="text-center">No.</th>
				<th class="text-center">User name</th>
				<th class="text-center">Email ID</th>							
				<th class="text-center">Contact number</th>						
				<th class="text-center">Is Vendor</th>							
				<th class="text-center">Created on</th>
				<th class="text-center" style="width:310px">Action</th>
			</tr>
		</thead>
		<tbody class="content" id="add_prodect_ajax">

			@include('admin.user.user_include')

		</tbody>
	</table>
</div>  
<!-- <div class="row">

	<div class="col-lg-6">

	</div>

	<div class="col-lg-6">
		<?php 
		$pagination_data =$items;
		?>
		<div class="dataTables_paginate paging_bootstrap pagination" id="pagination_data">
			@include('includes.pagination')
		</div>
	</div>
</div>   -->
@endsection

@section('javascript')
<script>
  $('#user_table').DataTable();
</script>
@endsection
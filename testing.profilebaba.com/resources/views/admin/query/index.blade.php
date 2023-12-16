@extends('admin.layout.master')

@section('page_title','Vendor Query')

@section('page_heading','Vendor Query')

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

{!! Form::model(request()->all(),['route' => ['query_for_vendor'],'method' => 'get', 'id' => 'filter', 'class' => 'form-inline']) !!}

	<div class="form-group">
		{{ Form::text('name',null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'User Name']) }}
	</div>

	<div class="form-group">
		{{ Form::text('category',null, ['class' => 'form-control', 'id' => 'category', 'placeholder' => 'Category']) }}
	</div>

	<div class="form-group">
    @php 
      $response = ['Response Count',10,20,50,100,150,200,250];
    @endphp
		{{ Form::select('response_count',$response, null, ['class' => 'form-control', 'id' => 'response_count', 'placeholder' => 'Response Count']) }}
	</div>

  <div class="form-group">
    @php 
      $per_page = ['Records Per Page',10,20,50,100,150,200,250];
    @endphp
		{{ Form::select('records_per_page',$per_page, null, ['class' => 'form-control', 'id' => 'records_per_page', 'placeholder' => 'Records per page']) }}
	</div>
	<button type="submit" class="btn btn-default">Submit</button>
	<p style="display: inline-block;font-size: 17px;line-height: 29px;margin-left: 10px;"><span id="lawyer_count">{{ $total_users }}</span> Queries</p>
	<br>
{!! Form::close() !!}

<div class="adv-table" style="padding-top:10px;">

  <table class="table table-striped table-hover table-bordered">

    <thead>

      <tr>

        <th class="text-center">ID.</th>

        <th class="text-center">User</th>

        <th class="text-center">Category</th>
        <th class="text-center">Location</th>
        <th class="text-center">Response Count</th>
        <th class="text-center">Assigned To</th>
        <th class="text-center">Status</th>

        <th class="text-center">Created on</th>

        <th class="text-center" style="width:210px">Action</th>

      </tr>

    </thead>

    <tbody class="content" id="add_prodect_ajax">

    @include('admin.query.vendor')



    </tbody>

  </table>

</div>  

<div class="row">
    <div class="col-md-12">
		<?php 
			$pagination_data =$query;
		?>
		<div class="dataTables_paginate paging_bootstrap pagination" id="pagination_data">
			@include('includes.pagination')
		</div>
    </div>
</div>

@endsection
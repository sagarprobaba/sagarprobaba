@extends('admin.layout.master')
@section('page_title','Area')
@section('page_heading','Area')

@section('add_link',url('/admin/region/create'))

@section('top')
@include('admin.layout.top')
@endsection

@section('container')

<div class="adv-table">

	<form class="form-inline" action="{{url('/admin/region')}}">
		<div class="form-group">
			<label>Filter</label>
		</div>

		<div class="form-group">
			<input type="text" name="area" class="form-control"  placeholder="Enter Area" value="{{request('area')}}" />

		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-default">Submit</button>
		</div>

	</form>
	<br>


	{{-- id="editable-sample" --}}
	<table class="table table-striped table-hover table-bordered">
		<thead>
			<tr>
				<th class="text-center">No.</th>
				<th class="text-center">Area</th>
				<th class="text-center">City</th>
				<th class="text-center">State</th>
				<th class="text-center">Country</th>
				<th class="text-center">Created on</th>
				<th class="text-center" style="width:210px">Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($items as $k=>$item)
			<tr>
				<td class="text-center">{{ $loop->iteration }}</td>
				<td class="text-center">{{$item->rtitle}}</td>
				<td class="text-center">{{$item->title}}</td>								
				<td class="text-center">{{$item->stitle}}</td>
				<td class="text-center">India</td>
				<td class="text-center">{{$item->created_at}}</td>
				<td class="text-center">
					<a class="btn btn-primary btn-xs" href="{{url('/admin/region/'.$item->regid.'/edit')}}"><i class="fa fa-pencil"> Edit </i></a>
					<form action="{{url('/admin/region/'.$item->regid)}}" method="post" class="btnform" style="display: inline-block;">
						<input type="hidden" name="_method" value="DELETE" />
						{{csrf_field()}}
						<button class="btn btn-danger btn-xs  " type="submit" name="submit" ><i class="fa fa-trash-o"> Delete</i></button >
					</form>
				</td>

			</tr>
			@endforeach
		</tbody>
	</table>
	<div class="row">
		<div class="col-lg-6">
			<span class="record_info">
				Showing 10 of 14
			</span>
		</div>
		<div class="col-lg-6">
			<div class="dataTables_paginate paging_bootstrap pagination">
				{{ $items->appends(request()->all())->links() }}
			</div>
		</div>
	</div>
</div>  
@endsection
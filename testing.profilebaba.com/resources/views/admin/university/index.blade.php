@extends('admin.layout.master')

@section('page_title','University')

@section('page_heading','University')

@section('add_link',url('/admin/university/create'))

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

<div class="adv-table">
	<table class="table table-striped table-hover table-bordered" id="editable-sample">
		<thead>
			<tr>
				<th class="text-center">No.</th>
				<th class="text-center">University Name</th>
				<th class="text-center">Created on</th>
				<th class="text-center" >Action</th>
			</tr>
		</thead>

		<tbody>
			<?php $i = 0; ?>
			@foreach($items as $item)
			<?php $i++; ?>
			<tr>
				<td class="text-center">{{ $loop->iteration }}</td>
				<td>{{$item->title}}</td>
				<td class="text-center">{{$item->created_at }}</td>
				<td class="text-center">
					<a class="btn btn-primary btn-xs" href="{{url('/admin/university/'.$item->unid.'/edit')}}">
						<i class="fa fa-pencil"> Edit </i>
					</a>
					<form action="{{url('/admin/university/'.$item->eduid)}}" method="post" style="display:inline-block">
						<input type="hidden" name="_method" value="DELETE" />
						{{csrf_field()}}
						<button class="btn btn-danger btn-xs  " type="submit" name="submit" ><i class="fa fa-trash-o"> Delete</i></button >
					</form>

				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{{-- <div class="row">
		<div class="col-lg-12">
			<div class="dataTables_paginate paging_bootstrap pagination">
				{{$items->links()}}

			</div>
		</div>
	</div> --}}
</div>  
@endsection
@extends('admin.layout.master')

@section('page_title','block')

@section('page_heading','block')

@section('add_link',route('block.create'))

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
				<th>ID</th>
				<th style="width: 180px;">Title</th>
				<th style="width: 180px;">Slug</th>
				<th>body</th>
				<th style="width: 100px;">Date</th>
				<th style="width: 180px;">Activon</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($categories as $block)
			<tr class="gradeX">
				<td>{{ $block->id }}</td>
				<td>{{ $block->title }}</td>
				<td>{{ $block->slug }}</td>
				<td>
					<iframe style="border: none;width: 100%; height: 140px;" srcdoc="{{ str_replace('base_url',url('/'),$block->body) }}"></iframe>
				</td>
				<td>
					{{ date('d-m-Y', strtotime($block->created_at)) }}
				</td>

				<td style="display: flex;">
					<a href="{{ route('block.edit',$block->id) }}" class="btn btn-success btn-sm">
						<i class="fa fa-pencil"></i> Edit
					</a>
					{{-- <form method="post" action="{{ route('block.destroy',[$block->id]) }}">
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
						<button type="submit" class="btn btn-danger btn-sm ml-2"><i class="fa fa-trash-o"></i>Delete</button>
					</form> --}}
				</td>
			</tr>
			@endforeach
			
		</tbody>
	</table>
</div>
			
@endsection

{{-- add prosenall js --}}
@section('javascript')

@endsection

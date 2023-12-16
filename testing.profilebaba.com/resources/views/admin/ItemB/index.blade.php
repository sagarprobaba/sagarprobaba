@extends('admin.layout.master')

@section('page_title', $type['titles'])

@section('page_heading', $type['titles'])

@section('add_link',route($type['route_pr'].'create'))

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
<div class="panel">
	<div class="panel-body">
		
		<table class="table table-striped table-hover table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>Question</th>
					<th>Answer</th>
					<th style="width: 100px;">Date</th>
					<th style="width: 180px;">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($datas as $data)
				<tr>
					<td>{{ $data->id }}</td>
					<td>{{ $data->question }}</td>
					<td>{{ $data->answer }}</td>
					<td>
						{{ date('d-m-Y', strtotime($data->created_at)) }}
					</td>
					<td class="text-center">
						<a class="btn btn-primary btn-xs" href="{{ route($type['route_pr'].'edit',$data->id) }}">
							<i class="fa fa-edit"></i> Edit
						</a>
						<form action="{{ route($type['route_pr'].'destroy',[$data->id]) }}" method="post" style="display: inline-block">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							<button class="btn btn-xs btn-danger" onclick="return confirm('Are you sure want to delete this ?');return false;"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</button>
						</form>
					</td>

				</tr>
				@endforeach

			</tbody>
		</table>

		<div class="row">
			<div class="col-lg-6">
			</div>
			<div class="col-lg-6" style="text-align: right;">
				{{$datas->links()}}
			</div>
		</div>

	</div>
</div>


@endsection

{{-- add prosenall js --}}
@section('javascript')

@endsection

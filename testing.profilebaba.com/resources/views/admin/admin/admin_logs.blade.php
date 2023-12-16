@extends('admin.layout.master')

@section('page_title', 'Admin logs')

@section('page_heading', 'Admin logs')

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
					<th>Name</th>
					<th>Url</th>
					<th>Query</th>
					<th style="width: 100px;">Date</th>
					{{-- <th style="width: 180px;">Activon</th> --}}
				</tr>
			</thead>
			<tbody>
				@foreach ($admin_logs as $data)
				<tr>
					<td>{{ $data->id }}</td>
					<td>{{ $data->admin->name ?? '' }}</td>
					<td>{{ $data->current_url }}</td>
					<td>{{ $data->get_query_log }}</td>
					<td>
						{{ date('d-m-Y', strtotime($data->created_at)) }}
					</td>
					<td class="text-center">
						<form action="{{ route('admin_log_delet',[$data->id]) }}" method="post" style="display: inline-block">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							<button class="btn btn-xs btn-danger" ><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</button>
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
				{{$admin_logs->links()}}
			</div>
		</div>

	</div>
</div>


@endsection

{{-- add prosenall js --}}
@section('javascript')

@endsection

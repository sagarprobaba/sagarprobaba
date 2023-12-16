@extends('admin.layout.master')

@section('page_title','Permission')

@section('page_heading','Permission')

@section('add_link',url('/admin/permission/create'))

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
		
		<table class="table table-striped table-hover table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>Role</th>
					<th>Menu</th>
					<th style="width: 180px;">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($data as $key=>$data)
				<tr>
					<td rowspan="{{count($data)+1}}">{{ $loop->iteration }}</td>
					<td rowspan="{{count($data)+1}}">{{ $key }}</td>
				</tr>
					@foreach ($data as $val)
					<tr>
						<td>{{ $val->name }}</td>
						
						<td class="text-center">
							<form action="{{ url('/admin/permission/'.$val->id) }}" method="post" style="display: inline-block">
								<input type="hidden" name="_method" value="DELETE" />
								{{ csrf_field() }}
								<button class="btn btn-xs btn-danger" onclick="return confirm('Are you sure want to delete this ?');return false;"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</button>
							</form>
						</td>
					</tr>
					@endforeach
				@endforeach

			</tbody>
		</table>

</div>


@endsection

@extends('admin.layout.master')

@section('page_title','Admin Menu')

@section('page_heading','Admin Menu')

@section('add_link',url('/admin/admin_menu/create'))

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
					<th>Title</th>
					<th>Parent</th>
					<th>Url</th>
					<th>Created By</th>
					<th style="width: 100px;">Status</th>
					<th style="width: 180px;">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($menuData as $data)
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td>{{ $data->name }}</td>
					<td>{{ $data->parent_id != 0 ? $data->parent->name : '' }}</td>
					<td>{{ $data->url }}</td>
					<td>{{ $data->admin->name }}</td>
					<td>{{ $data->status }}</td>
                    
					<td class="text-center">
						<a class="btn btn-primary btn-xs" href="{{url('/admin/admin_menu/'.$data->id.'/edit')}}">
							<i class="fa fa-edit"></i> Edit
						</a>
						<form action="{{ url('/admin/admin_menu/'.$data->id) }}" method="post" style="display: inline-block">
                            <input type="hidden" name="_method" value="DELETE" />
                            {{ csrf_field() }}
							<button class="btn btn-xs btn-danger" onclick="return confirm('Are you sure want to delete this ?');return false;"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
						</form>
					</td>

				</tr>
				@endforeach

			</tbody>
		</table>

</div>


@endsection

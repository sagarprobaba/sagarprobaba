@extends('admin.layout.master')

@section('page_title','Membership Plan')

@section('page_heading','Membership Plan')

@section('add_link',url('/admin/membership-plan/create'))

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
					<th>Plan type</th>
					<th>Area</th>
					<th>Price</th>
					<th>Lead</th>
					<th>Min. Lead</th>
					<th style="width: 180px;">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($items as $data)
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td>{{ $data->title }}</td>
					<td>{{ $data->plan_type }}</td>
					<td>{{ $data->area }}</td>
					<td>{{ $data->price_per_lead ?? $data->total_price }}</td>
					<td>{{ $data->lead }}</td>
					<td>{{ $data->min_lead }}</td>
                    
					<td class="text-center">
						<a class="btn btn-primary btn-xs" href="{{url('/admin/membership-plan/'.$data->id.'/edit')}}">
							<i class="fa fa-edit"></i> Edit
						</a>
						<form action="{{ url('/admin/membership-plan/'.$data->id) }}" method="post" style="display: inline-block">
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

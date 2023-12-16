@extends('admin.layout.master')

@section('page_title','Membership Vendor')

@section('page_heading','Membership Vendor')

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
					<th>Name</th>
					<th>Contact Number</th>
					<th>Plan</th>
                    <th>Leads</th>
					<th>Payment Mode</th>
					<th style="width: 180px;">Action</th>
				</tr>
			</thead>
			<tbody>
				@if(count($vendor)>0)
				@foreach ($vendor as $data)
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td>{{ $data->user->name }}</td>
					<td>{{ $data->user->contact_number }}</td>
					<td>{{ $data->plan->plan_type }}</td>
                    <td>{{ $data->leads }}</td>
					<td>{{ $data->payment_mode }}</td>
                    
					<td class="text-center">
						<a class="btn btn-primary btn-xs" href="{{url('/admin/membership-vendor/'.$data->id.'/upgrade')}}">
							<i class="fa fa-edit"></i> Upgrade
						</a>
						<form action="{{ url('/admin/membership-vendor/'.$data->id) }}" method="post" style="display: inline-block">
                            <input type="hidden" name="_method" value="DELETE" />
                            {{ csrf_field() }}
							<button class="btn btn-xs btn-danger" type="submit" name="submit"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</button>
						</form>
					</td>

				</tr>
				@endforeach
				@endif
			</tbody>
		</table>

</div>


@endsection

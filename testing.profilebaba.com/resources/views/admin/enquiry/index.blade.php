@extends('admin.layout.master')
@section('page_title',ucfirst($type).'s')

@section('title',ucfirst($type).'s')

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
				<td>S/No</td>
				<td>Name</td>
				<td>Email</td>
				<td>Phone</td>
				<td>State, City</td>
				<td>Event Type </td>
				{{-- <td>Date and time</td> --}}
				<td>Payment status</td> 
				<td>Action</td>
			</tr>
		</thead>
		<tbody>

			<?php $n=1; ?>

			@foreach($items as $value)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{$value->name}}</td>
				<td>{{$value->email}}</td>
				<td>{{$value->phone}}</td>
				<td>{{$value->state->stitle ?? ''}}, {{$value->city_one->title ?? ''}}</td>
				<td>{{ str_replace('?','₹',$value->event)}}</td>
				{{-- <td>
					Date: {{ $value->date }},<br>
					START at: {{ $value->starttime }},<br>
					END at: {{ $value->finishtime }}
				</td> --}}
				<td>
					@if($value->payment_gateway_transaction_status)
					<span class="badge badge-primary" >{{ $value->payment_gateway_transaction_status }}</span>
					@endif
				</td>
				<td>
					<a class="btn btn-primary btn-xs" href="{{ route('admin_enquiry_edit',$value->en_id) }}"><i class="fa fa-pencil"> Edit </i></a>
					<form action="{{url('/admin/'.$type.'/'.$value->en_id)}}" method="post" class="btnform">
						<input type="hidden" name="_method" value="DELETE" />
						{{csrf_field()}}
						<input    type="hidden" name="submit" value="Delete" />
						<button onclick="return confirm('Are you sure want to delete this ?');return false;" class="btn btn-danger btn-xs  " type="submit" name="submit" >
							<i class="fa fa-trash-o"> Delete</i>
						</button >
					</form>
				</td>
			</tr>

			<?php $n++; ?>
			@endforeach
		</tbody>

	</table>
</div>
{{-- <div class="text-center">{{ $items->links()}}</div> --}}
@endsection
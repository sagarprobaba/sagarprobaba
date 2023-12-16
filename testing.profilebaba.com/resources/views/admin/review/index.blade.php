@extends('admin.layout.master')
@section('page_title','Product Reviews')
@section('title','Product Reviews')

@section('container')
<table width="100%" border="0" class="table table-striped table-hover">
	<tr class="table_heading">
		<td>S/No</td>
		<td>Name</td>
		<td>Email</td>
		<td>Rating</td>
		<td>Review</td>
		<td>Status</td>
		<td>Date</td>
		<td>Edit</td>
		<td>Delete</td>
	</tr>

	<?php $n=1; ?>
	@foreach($items as $value)
	
	<tr>
		<td>{{$n}}</td>
		<td> {{$value->name}}</td>
		<td>{{$value->email}}</td>
		<td> {{$value->massage}} </td>
		<td>{{substr($value->review,0,100)}}</td>
		<td>
			<?php  
			if($value->status!=0){
				echo '<i style="color:green" class="fa fa-check-circle"></i>';
			}else{
				echo '<i style="color:red" class="fa fa-minus-circle"></i>';
			}
			?>
		</td>
		<td>
			<?php 
			$date = date('jS F Y h:i A', strtotime($value->created_at)); 
			echo  $date;
			?>
		</td>
		<td><a  href="{{url('/admin/'.$type.'/'.$value->id.'/edit')}}"><i class="fa  fa-edit"></i></a></td>
		<td>
			<form action="{{url('/admin/'.$type.'/'.$value->id)}}" method="post">
				<input type="hidden" name="_method" value="DELETE" />
				{{csrf_field()}}
				<input    type="hidden" name="submit" value="Delete" />
				<button class="btn btn-danger" onclick="return confirm('Are you sure want to delete this ?');return false;"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
			</form>
		</td>
	</tr>
	<?php $n++; ?>
	@endforeach
</table>
<div class="text-center">{{ $items->links() }}</div>
@endsection
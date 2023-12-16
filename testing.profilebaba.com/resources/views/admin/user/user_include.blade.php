@foreach($items as $k=>$item)
<tr>
	<td class="text-center">{{ $loop->iteration }}</td>
	<td class="text-center">{{ $item->name }}</td>
	<td>{{ $item->email }}</td>
	<td class="text-center">{{ $item->contact_number }}</td>							
	<td class="text-center">{{ $item->is_vendor }}</td>								
	<td class="text-center">{{$item->created_at}}</td>
	<td class="text-center">
		@if($item->is_vendor == 1)
		<a class="btn btn-primary btn-xs" href="{{ route('admin.user.business_profile',$item->id) }}"><i class="fa fa-pencil"> Business profile </i></a>
		@else
		<a class="btn btn-primary btn-xs" href="{{ route('admin.user.business_location', array($item->id, 0)) }}"><i class="fa fa-pencil"> Add Business profile </i></a>
		@endif
		<a class="btn btn-primary btn-xs" href="{{url('/admin/user/'.$item->id.'/edit')}}"><i class="fa fa-pencil"> Edit </i></a>
		<form action="{{url('/admin/user/'.$item->id)}}" method="post" class="btnform">
			<input type="hidden" name="_method" value="DELETE" />
			{{csrf_field()}}
			<button class="btn btn-danger btn-xs  " type="submit" name="submit" ><i class="fa fa-trash-o"> Delete</i></button >
		</form>
	</td>

</tr>
@endforeach
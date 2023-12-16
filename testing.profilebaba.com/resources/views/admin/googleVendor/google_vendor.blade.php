@foreach ($vendor as $data)
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td>{{ $data->name }}</td>
					<td>{{ $data->phone }}</td>
					<td>{{ $data->category }}</td>
					<td>{{ $data->location }}</td>
					<td>{{ $data->search_category_id == 0 ? "" : $data->category_s->title }}</td>
					<td>{{ $data->search_location }}</td>
					<td>{{ $data->status == '0' ? 'Block' : 'Validate' }}</td>
                    
					<td class="text-center">
						<a class="btn btn-primary btn-xs" href="{{url('/admin/google-vendor/'.$data->id.'/edit')}}">
							<i class="fa fa-edit"></i> Edit
						</a>
						<a class="btn btn-primary btn-xs" href="#" onClick="movevendor({{$data->id}}, {{$data->phone}}, '{{$data->location}}')">
							<i class="fa fa-arrow-right"></i> Move
						</a>
						<form action="{{ url('/admin/google-vendor/'.$data->id) }}" method="post" style="display: inline-block">
                            <input type="hidden" name="_method" value="DELETE" />
                            {{ csrf_field() }}
							<button class="btn btn-xs btn-danger" type="submit" name="submit"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</button>
						</form>
					</td>

				</tr>
				@endforeach
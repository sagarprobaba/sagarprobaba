@foreach($query as $item)

      <tr>

        <td class="text-center">{{ $loop->iteration }}</td>

        <td class="text-center">{{$item->user->name}}</td>

        <td class="text-center">{{$item->category->title}}</td>
        <td class="text-center">{{$item->location}}</td>
        <td class="text-center">{{$item->response_count}}</td>
        @if($item->assigned_to == 0)
          <td class="text-center">Super Admin</td>
        @else
          <td class="text-center">{{$item->assigned->name}}</td>
        @endif
        <td class="text-center"><span class="{{CustomValue::displayStatus($item->status)}}">{{CustomValue::displayStatus($item->status)}}</span></td>
        <td class="text-center">{{CustomValue::getTime($item->created_at)}}</td>

        <td class="text-center">

          <a class="btn btn-primary btn-xs" href="{{url('/admin/assign-vendor-query/'.$item->id)}}"><i class="fa fa-pencil"> Assign </i></a>
          <a class="btn btn-warning btn-xs" href="{{url('/admin/view-vendor-query/'.$item->id)}}"><i class="fa fa-eye"> View </i></a>
        </td>

      </tr>
 @endforeach

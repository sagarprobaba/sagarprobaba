@extends('admin.layout.master')

@section('page_title','Assign Query')

@section('page_heading','Assign Query')

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

        <th class="text-center">ID.</th>

        <th class="text-center">Sender</th>

        <th class="text-center">Message</th>
        <th class="text-center">Assigned To</th>
        <th class="text-center">Status</th>

        <th class="text-center">Created on</th>

        <th class="text-center" style="width:210px">Action</th>

      </tr>

    </thead>

    <tbody>

    @if(count($chat) > 0)

      @foreach($chat as $item)

      <tr>

        <td class="text-center">{{ $loop->iteration }}</td>

        <td class="text-center">{{$item->sender_type}}</td>

        <td class="text-center">{{$item->message}}</td>
        @if($item->assigned_to == 0)
          <td class="text-center">Super Admin</td>
        @else
          <td class="text-center">{{$item->assigned->name}}</td>
        @endif
        <td class="text-center"><span class="{{CustomValue::displayStatus($item->status)}}">{{CustomValue::displayStatus($item->status)}}</span></td>
        <td class="text-center">{{CustomValue::getTime($item->created_at)}}</td>

        <td class="text-center">

          <a class="btn btn-primary btn-xs" href="{{url('/admin/assign-query/'.$item->id)}}"><i class="fa fa-pencil"> Assign </i></a>
          <a class="btn btn-warning btn-xs" href="{{url('/admin/view-query/'.$item->id)}}"><i class="fa fa-eye"> View </i></a>
        </td>

      </tr>
      @endforeach

    @endif



    </tbody>

  </table>

</div>  

@endsection
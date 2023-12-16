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

<br />



<br />

<table class="table table-striped table-hover table-bordered" id="editable-sample">
    <thead>
		<tr>
            <td>S/No</td>
            <td>Business Profile</td>
            <td>Name</td>
            <td>Email</td>
            <td>Phone</td>
            <td>Message</td>
            <td>Date</td>
            <td>Action</td>
        </tr>
    </thead>


    <?php $n=1; ?>
    @foreach($items as $value)

    <tr>
        <td>{{ $loop->iteration }}</td>

        <td>
            @if($value->user)
            <a href="{{url('/admin/user/'.$value->userid.'/edit')}}" target="_blank">{{$value->user->name}}  </a>

            @endif
        </td>
        <td>{{$value->name}}</td>
        <td>{{$value->email}}</td>
        <td>{{$value->phone}}</td>
        <td>{{$value->message}}</td>
        <td>{{$value->created_at}}</td>
        <td>

            <a  class="btn btn-primary btn-xs"  href="{{url('/admin/'.$type.'/'.$value->enq_id.'/edit')}}">
                <i class="fa fa-eye"></i>
            </a>
            <form action="{{url('/admin/'.$type.'/'.$value->enq_id)}}" method="post" style="display: inline-block;">
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

</table>


<div class="text-center">{{-- {{ $items->links()}} --}}</div>




@endsection

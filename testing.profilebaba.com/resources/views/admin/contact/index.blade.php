@extends('admin.layout.master')
@section('page_title','contacts')

@section('title','contacts')


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
        <td>{{$value->f_name}} {{$value->l_name}}</td>
        <td>{{$value->email}}</td>
        <td>{{$value->phone}}</td>
        <td>{{$value->message}}</td>
        <td>{{$value->created_at}}</td>
        <td>
            <a  class="btn btn-primary btn-xs"  href="{{ route('admin_contact_edit',$value->id) }}">
                <i class="fa fa-eye"></i>
            </a>
            <form action="{{ route('contact.destroy',$value->id) }}" method="post" style="display: inline-block;">
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

{{-- <div class="text-center">{{ $items->links()}}</div> --}}

@endsection

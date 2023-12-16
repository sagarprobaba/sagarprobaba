@extends('admin.layout.master')

@section('page_title',ucfirst($type).'s')

@section('title','Edit '.ucfirst($type))

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
<form action="{{url('/admin/'.$type.'/'.$item->id)}}"   method="post" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="PUT" />

    {{csrf_field()}}

    <table class="table table-stripped table-hovered" width="405" height="226" border="0">
        <tr>
            <td width="89">Name</td>
            <td width="378"><input class="form-control" type="text" name="name" value="{{$item->name}}" /></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input class="form-control" type="text" name="email" value="{{$item->email}}" /></td>
        </tr>
        <tr>
            <td>Rating</td>
            <td><input class="form-control" type="text" name="rating" value="{{$item->rating}}" /></td>
        </tr>
        <tr>
            <td>Review</td>
            <td><textarea class="form-control"  name="massage">{{$item->massage}}</textarea></td>
        </tr>
        <tr>
            <td>Status</td>
            <td>
                <select name="status" class="form-control">
                    <option @if($item->status==1) {{'selected'}} @endif value="1">Active</option>
                    <option @if($item->status==0) {{'selected'}} @endif  value="0">Inactive</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="submit" value="Submit" class="btn btn-primary" /></td>
        </tr>
    </table>
</form>
@endsection
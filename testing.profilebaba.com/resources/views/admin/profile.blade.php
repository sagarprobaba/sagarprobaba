@extends('admin.layout.master')

@section('page_title', 'Admin Profile Edit ')

@section('container')

    @if (Session::has('message'))
        <div class="alert alert-success">
            {{ Session::get('message') }}
        </div>
    @endif

    @if (Session::has('errors'))
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br />
            @endforeach
        </div>
    @endif

    <h3>Admin Profile Edit</h3>
    <br />
    @php
        $data = $admin;
    @endphp

    <form action="{{ url('/admin/profile/' . $data->aid) }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT" />
        {{ csrf_field() }}

        @include('admin.admin._form')

    </form>
@endsection

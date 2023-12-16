@extends('admin.layout.master')
@section('page_title','Area')
@section('page_heading','Area')
@section('add_link',url('/admin/region/create'))
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

@include('admin.business.business_side_bar')

{!! Form::open(['route' => ['admin.user.business_contact_save',$data->user_id],'method' => 'post', 'novalidate' => 'novalidate', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'id' => 'user_register']) !!}
                                
@include('user.business.form.contact_Information')
	
{!! Form::close() !!}

@endsection
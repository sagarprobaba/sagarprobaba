@extends('admin.layout.master')
@section('page_title','Profile')
@section('page_heading','Profile')
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

{!! Form::model($data, ['route' => ['admin.user.business_other_save',$data->id],'method' => 'post', 'novalidate' => 'novalidate', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'id' => 'user_register']) !!}
                                
@include('user.business.form.other_Information')
	
{!! Form::close() !!}

@endsection
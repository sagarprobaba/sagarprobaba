@extends('admin.layout.master')
@section('page_title','Area')
@section('page_heading','Area')

@section('container')

<link href="{{ asset('public/dropzone/css/dropzone.css') }}" rel="stylesheet"/>

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
<style>
	#user_register .form-group{
		width: 50%;
		padding: 10px;
		float: none !important;
	}
</style>

@include('admin.business.business_side_bar')

<h2>Image Upload</h2>

{!! Form::model($data, ['route' => ['admin.user.business_upload_video_save',$data->id],'method' => 'post', 'novalidate' => 'novalidate', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'id' => 'user_register']) !!}
                                
@include('user.business.form.upload_video_logo_pictures')

{!! Form::close() !!}

@php
	$upload_video_logopicture_size = $data->vendor_images()->where('type','file')->sum('size');
	$upload_video_logopicture_size = number_format($upload_video_logopicture_size / 1048576,2);
@endphp
<p>
	Maximum file size allowed for upload: 5 MB
</p>
<p>Upload total file size: {{ $upload_video_logopicture_size }}</p>
<p>Total file size space: {{ 5-$upload_video_logopicture_size }}</p>

<div class="row">
	@if($data)
	<div class="col-md-6">
		<div>
			@foreach ($data->vendor_images()->where('type','file')->groupBy('file')->get(); as $file)
			<div style="width: 25%;padding: 5px;border: 1px solid #040404;border-radius: 5px;margin-top: 15px; display: inline-block;">
				@php
					$extension = pathinfo($file->file, PATHINFO_EXTENSION);
				@endphp
				
				@if (in_array($extension, ['MP4', 'mp4', 'MOV' ,'mov' ,'WMV' ,'wmv', 'FLV', 'flv', 'WebM', 'wedm']))
					<video width="320" height="240" controls style="width: 100%">
						<source src="{{ CustomValue::filecheck($file->file ?? '','/uploads/users/')}}" type="video/mp4">
						Your browser does not support the video tag.
					</video> 
				@else
					<img src="{{ CustomValue::filecheck($file->file,'/uploads/users/') }}" alt="img04" style="width: 100%; display: inline-block;">
				@endif
				
				<a style="text-align: center;display: block;background: #c14444;color: #fff;padding: 7px;" href="{{ route('admin.user.upload_video_delete',['id'=>$data->id,'file'=>$file->id]) }}">Delete</a>
			</div>
			@endforeach

		</div>
	</div>
	@endif
</div> 
<script src="{{ asset('public/dropzone/dropzone.js') }}"></script>

@endsection

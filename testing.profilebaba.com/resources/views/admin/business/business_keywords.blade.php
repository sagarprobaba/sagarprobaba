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

<div class="tab-content">

	<div class="tab-pane active" id="prof4">
		<div class="profile-data">
			Business Keywords
			For business keywords that you no longer wish to be listed in simply click on
			cross next to the keyword and when you are done, Click "Save"
		</div>
	</div>
	
</div>
@endsection
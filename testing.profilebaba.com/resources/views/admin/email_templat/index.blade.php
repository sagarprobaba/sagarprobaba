@extends('admin.layout.master')

@section('page_title','Email Templates')

@section('page_heading','Email Templates')

@section('add_link',route('email-templates.create'))

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
	<table class="table table-striped table-hover table-bordered" id="editable-sample">
		<thead>
			<tr>
				<th>ID</th>
				<th style="width: 180px;">Email Type</th>
				<th style="width: 180px;">Email Subject</th>
				<th>Email Body</th>
				<th style="width: 180px;">Activon</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($email_templates as $email_templat)
			<tr class="gradeX">
				<td>{{ $email_templat->id }}</td>
				<td>{{ $email_templat->email_type }}</td>
				<td>{{ $email_templat->email_subject }}</td>
				<td>
					<iframe style="border: none;width: 100%; height: 140px;" srcdoc="{{ str_replace('base_url',url('/'),$email_templat->email_body) }}"></iframe>
				</td>

				<td style="display: flex;">
					<a href="{{ route('email-templates.edit',$email_templat->id) }}" class="btn btn-success btn-sm">
						<i class="fa fa-pencil"></i> Edit
					</a>
				</td>
			</tr>
			@endforeach
			
		</tbody>
	</table>
</div>
			
@endsection

{{-- add prosenall js --}}
@section('javascript')

@endsection

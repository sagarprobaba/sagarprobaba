@extends('layout.master')


@section('page_title','Profile')
@section('page_heading','Profile')

@section('head')
<style>
	.gallery-table{
		padding-bottom: 0;
	}
	.btn {
	    padding: 6px 12px;
	}
</style>
@endsection

@section('container')

<main>
	<section class="dashbord-section">
		<div class="container">
			<div class="row">
				@include('user.user_side_bar')

				<div class="col-md-9 col-sm-8">
					<div class="right-deshboard rfg">
						@if(Session::has('message'))
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

						{!! Form::open(['route' => ['user.profile_edit.post'],'method' => 'post', 'novalidate' => 'novalidate', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'id' => 'user_register']) !!}
						<div class="panel panel-default">
						<div class="panel-heading">Personal Detail</div>
						<div class="list-form2-inner form-3 panel-body">



							@php
								$user = Auth::user();
							@endphp
							@include('auth.register_form',['register_form_edit' => 1])

							<div class="row">
								<div class="col-md-12">
									<div class="form-group sbtn5" style="text-align: center;">
										<button type="submit" class="btn btn-shape-round form__submit">SAVE</button>
									</div>
								</div>
							</div>
						</div>
						{!! Form::close() !!}

					</div>
				</div>
			</div>
		</div>
	</section>
</main>

@endsection
{{-- add js section  --}}
@section('javascript')
<script type="text/javascript">

</script>
@endsection

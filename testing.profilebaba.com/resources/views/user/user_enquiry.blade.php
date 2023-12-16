@extends('layout.master')


@section('page_title','Profile')
@section('page_heading','Profile')

@section('head')

@endsection

@section('container')

<main>
	<section class="dashbord-section">
		<div class="container">

			<div class="row">

				@include('user.user_side_bar')

				<div class="col-md-9 col-sm-8">
					<div class="right-deshboard">
						<div class="panel panel-default">
							<div class="panel-heading">Enquiry</div>

							<div class="panel-body">
								<div class="row">

									@foreach ($item->enquiry_lawyer as $enquiry)
									<div class="col-md-12">
										<h5>#{{ $loop->iteration }} Enquiry by {{ $enquiry->user_by->name ?? '' }}</h5>
										<table class="table table-striped table-hovered">
											<tr>
												<td>Name:</td>
												<td>{{ $enquiry->name }}</td>
											</tr>
											<tr>
												<td>Mobile Number:</td>
												<td>{{ $enquiry->phone }}</td>
											</tr>
											<tr>
												<td>Email Address:</td>
												<td>{{ $enquiry->email }}</td>
											</tr>
											@if ($enquiry->event)
											<tr>
												<td>Event Type:</td>
												<td>{{ str_replace('?','₹',$enquiry->event) }}</td>
											</tr>
											@endif
											<tr>
												<td>Message:</td>
												<td>{{ $enquiry->message ?? '...' }}</td>
											</tr>
											<tr>
												<td>created at:</td>
												<td>{{ $enquiry->created_at }}</td>
											</tr>
										</table>
									</div>
									@endforeach

									@if ($item->enquiry_lawyer->isEmpty())
									<div class="col-md-12">
										<h5 class="text-center">No Enquiries Yet.</h5>
									</div>
									@endif

								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>

@endsection
{{-- add js section  --}}
@section('javascript')

@endsection

@extends('layout.master')


@section('page_title','Business Profile')
@section('page_heading','Business Profile')

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
							<div class="panel-heading">Business Profiles</div>

							<div class="panel-body">
								<div class="row">

									@foreach ($data as $vendor)
									<div class="col-md-12">
										<h5>#{{ $loop->iteration }} </h5>
										<table class="table table-striped table-hovered">
											<tr>
												<td>Name:</td>
												<td>{{ $vendor->business_name }}</td>
											</tr>
											<tr>
												<td>About Me:</td>
												<td>{{ $vendor->about_me }}</td>
											</tr>
											<tr>
												<td>Category:</td>
                                                <td>
                                                @foreach ($vendor->category()->get() as $item)
												    {{ $item->title.', ' }}
                                                @endforeach
                                                </td>
											</tr>
											<tr>
												<td>Action:</td>
												<td>
													<a class="btn btn-primary btn-xs" href="{{url('/user/business/'.$vendor->id.'/general')}}"><i class="fa fa-pencil"> Edit </i></a>
												</td>
											</tr>
										</table>
									</div>
									@endforeach

									@if ($data->isEmpty())
									<div class="col-md-12">
										<h5 class="text-center">No Business Profiles.</h5>
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

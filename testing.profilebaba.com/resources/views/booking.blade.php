@extends('layout.master')


@section('page_title','Profile baba')
@section('page_heading','Profile baba')

@section('head')
<link rel="stylesheet" href="{{asset('public/css/jquery.ptTimeSelect.css') }}">   
@endsection

@section('container')
@php
	//languages
$languages_T=array(); 
foreach($vendor->languages as $language){

	$languages_T[]=$language->langName; 

}
$languages = implode(" , ",$languages_T); 
@endphp
<main>
	<section class="banner-bg"> 
		<div class="container">
			<div class="banner-content">
			</div>
		</div>
	</section>
	<section class="profile-sec">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-xs-12">
					<div class="banner-iteams">
						<img width="170" height="170" src="{{ CustomValue::filecheck($vendor->profileimg,'/uploads/users/')}}" class="img-responsive">
						<div class="inner-cnt">
							<h4>{{$vendor->name}}</h4>
							<p><i class="fa fa-map-marker" aria-hidden="true"></i> {{$vendor->courttype_user->title ?? ''}} | {{$vendor->user_city->title ?? ''}}</p>
							{{-- <a href="">Read Reviews <i class="fa fa-commenting" aria-hidden="true"></i></a> --}}
							<div class="star-icons">
								<ul>
									@for($i=1;$i<=5;$i++)
									<li><i class="fa fa-star{{ $i<=$vendor->rating ? '' : '-o' }}" aria-hidden="true"></i></li>
									@endfor 
								</ul>
							</div>
							@if (isset($users_price_fast->price))
							<p><strong>Price from ₹{{number_format($users_price_fast->price)}}</strong></p>
							@endif
						</div>
					</div>
				</div>
				<div class="col-md-4 col-xs-12">
				</div>
			</div>
		</div>
	</section>

	<section class="inner-vid-sec">
		<div class="container">
			<div class="video-heading">
				<h3 class="sheading">Booking Now</h3>
			</div>
			<div class="row">
				<div class="col-md-6" style="margin: auto;display: block;float: none;">
					<form id="booking_now_pop" action="{{ route('booking.post',$vendor->slug) }}" method="post" data-redirect_after_booking="{{ route('booking.thank.you') }}">

						<div class="form-group booking_now_pop_msg">
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Name</label>
									<input name="name" type="text" value="{{ Auth::user()->name ?? '' }}" class="form-control" id="name" data-validation="required">
								</div>
								
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Email</label>
									<input name="email" type="text" value="{{ Auth::user()->email ?? '' }}" class="form-control" id="email" data-validation="required">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label>Phone</label>
							<input name="phone" type="text" value="{{ Auth::user()->phone ?? '' }}" class="form-control" id="phone" data-validation="required">
						</div>
						@if (isset($users_issue))
						<div class="form-group">
							<label>Event Type</label>
							<select name="event" id="event" class="form-control" data-validation="required">
								<option value="">--Select Event Type--</option>
								@foreach ($users_issue as $issue)
								<option value="{{ $issue->Issue->issuename ?? '' }} - (Price ₹{{ $issue->price }})${{ $issue->price }}">{{ $issue->Issue->issuename ?? '' }} - (Price ₹{{ $issue->price }})</option>
								@endforeach
							</select>	
						</div>
						@endif

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>State</label>
									{{ Form::select('stid', $states, NULL, ['class' => 'form-control state selectlist', 'id' => 'stid', 'data-validation'=>"required"]) }}
									@if (isset($errors) && $errors->has('stid'))
									<label id="stid-error" class="error text-danger" for="stid">
										{{ $errors->first('stid') }}
									</label>
									@endif
								</div>
								
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>City</label>
									{{ Form::select('ctid', [], NULL, ['class' => 'form-control city selectlist', 'id' => 'ctid', 'data-validation'=>"required"]) }}
									@if (isset($errors) && $errors->has('ctid'))
									<label id="ctid-error" class="error text-danger" for="ctid">
										{{ $errors->first('ctid') }}
									</label>
									@endif
								</div>
							</div>
						</div>

						<div class="form-group">
							<label>Date</label>
							<input name="date" type="text" class="form-control date" id="phone" data-validation="required">
						</div>

						<div class="row" id="sample1">
							<div class="col-md-6">
								<div class="form-group">
									<label>First performance to START at:</label>
									<input name="starttime" type="text" class="form-control" data-validation="required">
								</div>
								
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Final performance to END at:</label>
									<input name="finishtime" type="text" class="form-control" data-validation="required">
									
								</div>
							</div>
						</div>

						<div class="form-group">
							<label>Message</label>
							<textarea class="form-control" id="message" rows="3" name="message" cols="50"></textarea>
						</div>
						<div class="form-btn"> 
							<button type="submit" id="signin" class="btn lbtn">Submit</button> 
						</div>

						<input type="hidden" name="vendor_id" value="{{ $vendor->userid }}">
						{{csrf_field()}}
					</form>
				</div>
			</div>
		</div>
	</section>
</main>

@endsection
{{-- add js section  --}}
@section('javascript')
<script type="text/javascript">
	$(document).ready(function() {
		$('.state').change(function() {
			$('.city').empty();
			var stid = $('.state').val();
			if (stid) {
				var qc = "stid="+stid;
				$.ajax({
					url:"{{url('/admin/ajax/city_list')}}",
					type:"GET",
					data:qc,
					success:function(output){
						$('.city').html(output);
					}	
				});
			}
		});
	});
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<script>
	$(document).ready(function(){
		var to_date_input=$('.date'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		to_date_input.datepicker({
			format: 'dd/mm/yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
		})
		
	})
</script>

<script src="{{asset('public/js/jquery.ptTimeSelect.js') }}"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#sample1 input').ptTimeSelect();
	}); 
</script>

@endsection
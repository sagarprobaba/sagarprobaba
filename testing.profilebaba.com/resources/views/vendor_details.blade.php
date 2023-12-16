@php
    $contact_information = $user->contact_information;
    $other_information = $user->other_information;
    $vendor_images = $user->vendor_images()->where('type','file')->groupBy('file')->get();
    $vendor_rating = $user->vendor_rating()->get();
    
    $reviewg = 0;
    foreach($vendor_rating as $rating){
        $reviewg+=$rating->rating;
    }
    $reviewg = $reviewg > 0 ? $reviewg/count($vendor_rating) : $reviewg;

@endphp


@extends('layout.master')

@section('page_title', $user->business_name ?? '')
@section('page_heading', $user->about ?? '')
 
@section('head')

    <meta name="keywords" content="{{ $user->business_name ?? '' }}" />
    <meta  name="description" content="{{ $user->about ?? '' }}" />

    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@500;600;700&display=swap" rel="stylesheet"> 
    <style>
        .profile-showcase {
            padding-top: 2px;
            background: rgb(251, 128, 42);
            background: linear-gradient(90deg, rgba(251, 128, 42, 1) 0%, rgba(208, 86, 0, 1) 35%, rgba(251, 128, 42, 1) 100%);
            padding-bottom: 45px;
        }

        .bottom-bbanner {
            margin-top: 0px;
        } 

        .profile-showcase .col-md-3 {
            padding: 0px;
        }

        .profile-showcase .col-md-9 {
            padding: 0px;
        }

        .profile-showcase .col-md-9 .row.flex .col-md-8 {
            background: #fff;
            margin: 0px;
            padding: 0px 20px;
            box-shadow: none;
            border: none;
        }

        .profile-showcase .col-md-9 .row.flex .col-md-4 {
            padding: 0px;
        }

        .profile-showcase .col-md-9 .row.flex {
            display: flex;
            margin-right: 0px;
            margin-left: 0px;
        }

        .showcase-center {
            padding: 20px 0px;
        }

        .bbanner img {
            margin-bottom: 4px;
            height: 166px;
            width: 100%;
        }

        .profile-showcase {
            background: rgb(255, 253, 208);
            padding: 0px 15px 0px;
        }

        .showcase-left {
            background: #FB802A;
            color: #fff;
        }

        .prof-cont ul li span {
            margin-right: 2px;
            color: #fff;
            font-weight: 700;
        }

        .prof-cont ul li a,
        .prof-cont h4 {
            color: #fff;
        }

        .showcase-center ul li {
            position: relative;
            padding-left: 152px;
            min-height: 36px;
        }

        .showcase-center ul li span {
            margin-right: 2px;
            color: #FB802A;
            text-transform: capitalize;
            position: absolute;
            left: 0px;
            top: 6px;
            font-weight: 700;
        }

        .showcase-center ul li li {
            border-bottom: none;
            padding: 0px;
        }

        .main-footer {
            margin-top: 0px;
        }

        @media only screen and (max-width:767px) {
            .profile-showcase .col-md-9 .row.flex {
                display: block;
            }

            .bottom-bbanner img {
                width: 100%;
            }

            .bbanner img {
                height: auto;
            }

            .bvideo img {
                width: 100%;
            }

            .profile-showcase .col-md-9 .row.flex .col-md-4 {}

            .profile-showcase .col-md-9 {
                padding: 0px 15px;
            }

            .profile-showcase .col-md-3 {
                padding: 0px 15px;
            }

            .showcase-center ul li {
                position: relative;
                padding-left: 0px;
            }

            .showcase-center ul li span {
                position: initial;
            }
        }

        @media only screen and (min-width:768px) and (max-width:1024px){
            .showcase-center ul li {
                position: relative;
                padding-left: 0px;
            }

            .showcase-center ul li span {
                position: initial;
            }
        }
        
        .revsce .star-rating1 i{
            color: #ccc;
        }

    </style>
    
    <link rel="stylesheet" href="https://rawcdn.githack.com/nextapps-de/spotlight/0.7.8/dist/css/spotlight.min.css">
    
@endsection

@section('container')
    <section class="pr-bredcumb">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-md-offset-3">
                    <h1>Profile Detail</h1>
                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li class="current"><span>Profile Detail</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="profile-showcase c5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="showcase-left">
                        <div class="profimg" style="background: #fff;">
                            <img class="img-responsive" src="{{ CustomValue::filecheck($user->user->profile_pic,'/uploads/users/')}}">
                        </div>
                        <div class="prof-cont">
                            <h4>{{$user->name}}</h4>
                            <div class="rating">
                                @for($i=1;$i<=5;$i++)
                                <span class="fa fa-star {{ $i<=$reviewg ? 'checked' : '' }}"></span>
                                @endfor
                            </div>
                            <ul>
                                <!-- <li><span>Client id :- </span>PB-{{ $user->userid }}</li>
                                <li><span>Designation :- </span>{{$user->OtherDetails->odName ?? ''}}</li> -->
                                
                                @if($user->my_aim)
                                <li style="display: none;"><span>My Aim :- </span>{{$user->my_aim}}</li>
                                @endif
                                
                                @if($user->my_slogen)
                                {{-- <li><span>my slogan :- </span>{{$user->my_slogen}}</li> --}}
                                @endif
                                
                                @if($user->blood_group)
                                <li style="display: none;"><span>Blood Group :- </span>{{$user->blood_group}}</li>
                                @endif
                                
                                @if($user->state)
                                <li style="display: none;"><span>Native Place :- </span>{{$user->state}}</li>
                                @endif
                                
                                @if($user->father_name)
                                <li style="display: none;"><span>Father Name :- </span>{{$user->father_name}}</li>
                                @endif
                                
                                @if($user->religion)
                                <li style="display: none;"><span>Religion :- </span>{{$user->religion}}</li>
                                @endif
                                
                                @if($user->marital_status)
                                <li style="display: none;"><span>Marital Status :- </span>{{$user->marital_status}}</li>
                                @endif
                                
                                @if($user->highest_ualification)
                                <li style="display: none;"><span>Highest Qualification :- </span>{{$user->highest_ualification}}</li>
                                @endif
                                
                                @if($user->describe_your_self)
                                <li style="display: none;"><span>About me :- </span>{{$user->describe_your_self}}</li>
                                @endif
                                
                                @if($user->user->contact_number)
                                <li><span>Contact Number :- </span>{{$user->user->contact_number}}</li>
                                @endif
                                
                                @if($user->user->whatsapp_mumber)
                                <li style="display: none;"><span>Whatsapp Number :- </span>{{$user->user->whatsapp_mumber}}</span></li>
                                @endif
                                
                                @if($user->user->landline_number)
                                <li style="display: none;"><span>Landline Number :- </span>{{$user->user->landline_number}}</span></li>
                                @endif
                                
                                @if($user->user->email)
                                <li><span>Email :- </span>{{$user->user->email}}</span></li>
                                @endif
                                
                                @if($user->user->address)
                                <li><span>Address :- </span>{{$user->user->address}}</span></li>
                                @endif
                                
                            </ul>
                        </div>
                    </div>
                    <div id="map"></div>
                </div>
                <div class="col-md-9">
                    <div class="row flex">
                        <div class="col-md-8">
                            <div class="showcase-center">
                                <h3>Business Detail</h3>
                                <ul>
                                    <li><span>Business Name :- </span>{{$user->business_name ?? ''}}</li>
                                    <li>
                                        <span>category Name :- </span>
                                        @if($user)
                                        {{ implode(' / ', $user->category()->pluck('title')->toArray()) }}
                                        @else
                                        N/A
                                        @endif
                                    </li>
                                    <li><span> Service / Location:- </span>{{$contact_information->area ?? ''}}</li>
                                    <li><span>About us: - </span> {{$user->about_me ?? ''}}</li>
                                <!--</ul>-->
                                
                                <!--<h3>Address Detail</h3>-->
                                <!--<ul>-->
                                    <li><span>Country :- </span>{{$contact_information->country_name->title ?? ''}}</li>
                                    <li><span>State :- </span>{{$contact_information->state_name->name ?? ''}}</li>
                                    <li><span>City :- </span>{{$contact_information->city_name->name ?? ''}}</li>
                                    <li><span>Landmark :- </span>{{$contact_information->landmark ?? ''}}</li>
                                    <li><span>Area :- </span>{{$contact_information->area ?? ''}}</li>
                                    <li><span>Address / Building :- </span>{{$contact_information->address ?? ''}}</li>
                                    <li><span>Pin Code :- </span>{{$contact_information->pincode ?? ''}}</li>
                                    <!-- <li><span>Google Location :- </span><a class="category_title" href="{{$location_information->business_google_location ?? ''}}">{{$location_information->business_google_location ?? ''}}</a></li> -->
                                <!--</ul>-->
                                
                                <!--<h3>Contact Detail</h3>-->
                                <!--<ul>-->
                                    <!--<li><span>Contact Person :- </span>{{$contact_information->contact_person ?? ''}}</li>-->
                                    <!--<li><span>Designation :- </span>{{$contact_information->designation ?? ''}}</li>-->
                                    <li><span>Landline No :- </span>{{$contact_information->landline_number ?? ''}}</li>
                                    <li><span>Mobile No :- </span>{{$contact_information->mobile_number ?? ''}}, {{$contact_information->alternate_number ?? ''}}</li>
                                    <li><span>Whatsapp No.:- </span>{{$contact_information->whatsapp_number ?? ''}}</li>
                                    
                                    @if( isset($contact_information->fax_no) && !empty($contact_information->fax_no) )
                                    <li>
                                        <span>Fax No :- </span>
                                        {{$contact_information->fax_no ?? ''}}
                                        @if( isset($contact_information->fax_no_2) && !empty($contact_information->fax_no_2) )
                                        ,{{$contact_information->fax_no_2 ?? ''}}
                                        @endif
                                    </li>
                                    @endif
                                    
                                    @if( isset($contact_information->toll_free_no) && !empty($contact_information->toll_free_no) )
                                    <li>
                                        <span>Toll Free No :- </span>
                                        {{$contact_information->toll_free_no ?? ''}}
                                        @if( isset($contact_information->toll_free_no_2) && !empty($contact_information->toll_free_no_2) )
                                        ,{{$contact_information->toll_free_no_2 ?? ''}}
                                        @endif
                                    </li>
                                    @endif
                                    
                                    <li><span>Email ID :- </span>{{$contact_information->email ?? ''}}</li>
                                    <li><span>Website :- </span>{{$contact_information->website ?? ''}}</li>
                                    
                                    <li><span>Social Media :- </span>
                                        <ul class="social3">
                                            @if( isset($contact_information->fb_url) && !empty($contact_information->fb_url) )
                                            <li><a target="_blank" class="facebook" href="{{$contact_information->fb_url ?? ''}}"><i class="fa fa-facebook"
                                                        aria-hidden="true"></i></a></li>
                                            @endif
                                            
                                            @if( isset($contact_information->twitter_url) && !empty($contact_information->twitter_url) )
                                            <li><a target="_blank" class="twitter" href="{{$contact_information->twitter_url ?? ''}}"><i class="fa fa-twitter"
                                                        aria-hidden="true"></i></a></li>
                                            @endif
                                            
                                            @if( isset($contact_information->insta_url) && !empty($contact_information->insta_url) )
                                            <li><a target="_blank" class="instagram" href="{{$contact_information->insta_url ?? ''}}"><i class="fa fa-instagram"
                                                        aria-hidden="true"></i></a></li>
                                            @endif
                                            
                                            @if( isset($contact_information->youtube_url) && !empty($contact_information->youtube_url) )
                                            <li><a target="_blank" class="youtube" href="{{$contact_information->youtube_url ?? ''}}"><i class="fa fa-youtube"
                                                        aria-hidden="true"></i></a></li>
                                            @endif
                                            
                                            {{-- <li><a target="_blank" class="linkedin" href="{{$contact_information->business_name ?? ''}}"><i class="fa fa-linkedin"
                                                        aria-hidden="true"></i></a></li> --}}
                                        </ul>
                                    </li>
                                    
                                </ul>
                                <input hidden id="google_location" value="{{$location_information->google_location ?? ''}}" />
                                @if (isset($other_information->display_time) && $other_information->display_time == 'display')
                                <ul>
                                    <li class="timh5">
                                        <span>Hours of Operation :- </span> 
                                        
                                        <p>
                                            <k>Monday :</k> 
                                            @if ($other_information->Monday_closed != 'closed')
                                            {{$other_information->Monday_form ?? ''}} to {{$other_information->Monday_to ?? ''}} 
                                            @else
                                            Closed
                                            @endif
                                        </p>
                                        
                                        <p>
                                            <k>Tuesday : </k> 
                                            @if ($other_information->Tuesday_closed != 'closed')
                                            {{$other_information->Tuesday_form ?? ''}} to {{$other_information->Tuesday_to ?? ''}} 
                                            @else
                                            Closed
                                            @endif
                                        </p>
                                        
                                        <p>
                                            <k>Wednesday  :</k>  
                                            @if ($other_information->Wednesday_closed != 'closed')
                                            {{$other_information->Monday_form ?? ''}} to {{$other_information->Monday_to ?? ''}} 
                                            @else
                                            Closed
                                            @endif
                                        </p>
                                        
                                        <p>
                                            <k>Thursday  : </k>
                                            @if ($other_information->Thursday_closed != 'closed')
                                            {{$other_information->Monday_form ?? ''}} to {{$other_information->Monday_to ?? ''}} 
                                            @else
                                            Closed
                                            @endif
                                        </p>
                                        
                                        <p>
                                            <k>Friday  : </k> 
                                            @if ($other_information->Friday_closed != 'closed')
                                            {{$other_information->Monday_form ?? ''}} to {{$other_information->Monday_to ?? ''}} 
                                            @else
                                            Closed
                                            @endif
                                        </p>
                                        
                                        <p>
                                            <k>Saturday  : </k> 
                                            @if ($other_information->Saturday_closed != 'closed')
                                            {{$other_information->Monday_form ?? ''}} to {{$other_information->Monday_to ?? ''}} 
                                            @else
                                            Closed
                                            @endif
                                        </p>
                                        
                                        <p>
                                            <k>Sunday   :</k>  
                                            @if ($other_information->Sunday_closed != 'closed')
                                            {{$other_information->Monday_form ?? ''}} to {{$other_information->Monday_to ?? ''}} 
                                            @else
                                            Closed
                                            @endif
                                        </p>
                                    </li>
                                </ul> 
                                @endif
                                
                                @if(isset($other_information->payment_mode) && !empty($other_information->payment_mode))
                                
                                <ul>
                                    <li><span>Payment Mode :- </span>{{$other_information->payment_mode ?? ''}}</li>
                                </ul>
                                
                                @endif


                                
                                <div class="alform5">
                                    <h4>Enquiry Now</h4>
                                    <form id="enquiry_now_pop" action="{{ route('enquiry_vendor_submit') }}" method="post">

                                        <div class="form-group enquiry_now_pop_msg">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input name="name" placeholder="Name" type="text" value="{{ Auth::user()->name ?? '' }}" class="form-control" id="name" data-validation="required">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input name="phone" placeholder="Phone" type="text" value="{{ Auth::user()->contact_number ?? '' }}" class="form-control" id="phone" data-validation="required">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input name="email" placeholder="Email" type="text" value="{{ Auth::user()->email ?? '' }}" class="form-control" id="email" data-validation="required">
                                                </div>
                                            </div>
                                          
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea class="form-control" id="message" rows="3" name="message" cols="50" placeholder="Additional message"></textarea>
                                                </div>
                                            </div>
					                        
                                            <input type="hidden" name="vendor_id" value="{{$user->id}}" />
                                            {{csrf_field()}}

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button class="btn">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                                <div class="alform5 revsce">
                                    <h4>Review</h4>
                                    @if($reviewg > 0)
                    					@foreach($vendor_rating as $review)
                    					<div class="media">
                    						<div class="media-left">
                    							<img src="{{url('public/image/default.jpg')}}" class="media-object">
                    						</div>
                    						<div class="media-body">
                    							<h5 class="media-heading">{{$review->name}}</h5>
                    							<ul class="rating5">
                    								@for($i=1;$i<=5;$i++)
                    								<li class="fa fa-star @if($i<=$reviewg) {{'checked'}} @endif"></li>
                    								@endfor
                    							</ul>
                    							<p>{{$review->message}}</p>
                    						</div>
                    					</div>
                    					@endforeach
                    				@else
                    				    <h3 style="color: #c9abab;font-size: 14px;text-align: center;background: #fffdd0;padding: 16px;border-radius: 10px;">Empty Review</h3>
                    				@endif
                
                					<form class="review-form" id="review" action="{{ url('/ajax/vendor_review_submit')}}" method="post">
                						<div class="review_msg"></div>
                						{{csrf_field()}}
                
                						<div class="row review_form_raw">
                							<div class="col-md-12">
                								<h3>Add A Review</h3>
                							</div>
                
                							<div class="col-md-12">
                								<div class="star-rating1">												
                									<i class="fa  fa-star" data-rating="1"></i>
                									<i class="fa  fa-star" data-rating="2"></i>
                									<i class="fa fa-star" data-rating="3"></i>
                									<i class="fa  fa-star" data-rating="4"></i>
                									<i class="fa  fa-star" data-rating="5"></i>
                									<input type="hidden" name="rating"   class="rating-value" value="" data-validation="required">
                								</div>
                							</div>
                							<div class="col-md-6">
                								<div class="form-group">											
                									<input type="text" name="name" data-validation="required" class="form-control" placeholder="Name">
                								</div>
                							</div>
                							<div class="col-md-6">
                								<div class="form-group">											
                									<input type="email"  data-validation="email" name="email" class="form-control" placeholder="Email">
                								</div>
                							</div>
                							<div class="col-md-12">
                								<div class="form-group">											
                									<textarea rows="4" class="form-control"  name="message" placeholder="Add Your Review"></textarea>
                								</div>
                							</div>
                							<div class="col-md-12">
                								<div class="form-group">											
                									<button type="submit" class="submit_review btn">Submit</button>
                									<input type="hidden" name="vendor_id" value="{{$user->id}}" />
                								</div>
                							</div>
                						</div>											
                					</form>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="showcase-right">

                                @if ($user->logo)
                                <div class="blogo">
                                    <img class="img-responsive" src="{{ CustomValue::filecheck($user->logo ?? '','/uploads/users/')}}">
                                </div>
                                <br>
                                @endif

                                
                                <div class="spotlight-group i3" id="upload_video">
                                    <?php $counter_s = 0 ?> 
                                    @foreach ($vendor_images as $file_image)
                                     @php
                                        $extension = pathinfo($file_image->file, PATHINFO_EXTENSION);
                                    @endphp
                                    @if (in_array($extension, ['MP4', 'mp4', 'MOV' ,'mov' ,'WMV' ,'wmv', 'FLV', 'flv', 'WebM', 'wedm']))
                                        {{--<div class="item">
                                            <video width="320" height="240" controls>
                                                <source src="{{ CustomValue::filecheck($file_image->file ?? '','/uploads/users/')}}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                            
                                            <a class="spotlight all_iamge_gall" data-media="video" data-src-mp4="{{ CustomValue::filecheck($file_image->file ?? '','/uploads/users/')}}"></a>
                                        </div>--}}
                                    @else
                                        <?php $counter_s += 1 ?> 
                                        <div class="item">
                                            <img class="img-responsive" src="{{ CustomValue::filecheck($file_image->file ?? '','/uploads/users/')}}">
                                            
                                            <a class="spotlight all_iamge_gall" data-media="image" data-src="{{ CustomValue::filecheck($file_image->file ?? '','/uploads/users/')}}"></a>
                                        </div>
                                    @endif
                                    @endforeach
                                    
                                    @if(($counter_s - 2) >= 0)
                                    <h2 class="promo-images"><span>{{ ($counter_s - 2) }} +</span></h2>
                                    @endif
                                    
                                </div>
                                 
                                
                                  
                                <div class="bvideo" style="display:none;">
                                    <div class="owl-carousel owl-carousel4 owl-theme">
                                        @foreach ($vendor_images as $file_image)
                                            @php
                                                $extension = pathinfo($file_image->file, PATHINFO_EXTENSION);
                                            @endphp
                                            @if (in_array($extension, ['MP4', 'mp4', 'MOV' ,'mov' ,'WMV' ,'wmv', 'FLV', 'flv', 'WebM', 'wedm']))
                                                <div class="blogo">
                                                    <video width="320" height="240" controls>
                                                        <source src="{{ CustomValue::filecheck($file_video->file ?? '','/uploads/users/')}}" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video> 
                                                </div>
                                            @else
                                                <div class="item">
                                                    <img class="img-responsive" src="{{ CustomValue::filecheck($file_image->file ?? '','/uploads/users/')}}">
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                  
                                </div>


                                <div class="bvideo">
                                    <div class="owl-carousel owl-carousel4 owl-theme">
                                        @foreach ($vendor_images as $file_video)
                                            @php
                                                $extension = pathinfo($file_video->file, PATHINFO_EXTENSION);
                                            @endphp
                                            @if (in_array($extension, ['MP4', 'mp4', 'MOV' ,'mov' ,'WMV' ,'wmv', 'FLV', 'flv', 'WebM', 'wedm']))
                                                <div class="blogo">
                                                    <video width="320" height="240" controls>
                                                        <source src="{{ CustomValue::filecheck($file_video->file ?? '','/uploads/users/')}}" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video> 
                                                </div>
                                            @else
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                               
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </section>
    

@endsection
{{-- add js section --}}
@section('javascript')

    <script src="https://rawcdn.githack.com/nextapps-de/spotlight/0.7.8/dist/js/spotlight.min.js" type="text/javascript"></script>
    
    <script>
        $(document).ready(function() {
            var $star_rating = $('.star-rating1 i');
            var SetRatingStar = function() {
                return $star_rating.each(function() {
                    if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this)
                            .data('rating'))) {
                        return $(this).removeClass('fa fa-star').addClass('fa fa-star checked');
                    } else {
                        return $(this).removeClass('fa fa-star checked').addClass('fa fa-star');
                    }
                });
            };

            $star_rating.on('click', function() {
                $star_rating.siblings('input.rating-value').val($(this).data('rating'));
                return SetRatingStar();
            });

            SetRatingStar();

        });

        function goToByScroll(id) {
            id = id.replace("link", "");
            $('html,body').animate({
                    scrollTop: $("#" + id).offset().top
                },
                'slow');
        }
        // Initialize and add the map
        
    </script>
@endsection

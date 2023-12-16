<?php

use App\Models\Cpr_Add_images;
use App\Models\Cpr_banner;
use App\Models\webUser;
use App\Models\Cpr_ad_category;
$cats = Cpr_ad_category::where('parent_id', 0)->where('home',1)->orderByDesc('id')->get();
?>
@extends('web.layout.app')
@section('body')
<style>
    .details .center-left {
        z-index: 9 !important;
    }

    .slick-track {
        float: left !important;
    }

    .home_verticle_menu .menu-outer {
        display: none !important;
    }
	.cat-store{background:#fff !important;margin:0 !important}
	.cat-store ul li {
    width: 10%;
    float: left;
    padding: 0;
    list-style: none;
}
	.cat-store img {
    border: 0.5px solid#ccc;
    border-radius: 10px;
    width: 70px;  height: 70px;
    padding: 5px;
}
.cat-store img:hover
{    -webkit-box-shadow: 0 0 10px#e3e3e3;
    -moz-box-shadow: 0 0 10px#e3e3e3;
    box-shadow: 0 0 10px#e3e3e3;}
.cat-store p.view_all {
    border: 0.5px solid#ccc;
    border-radius: 10px;
    width: 80px;
    margin: auto;
    height: 70px;
    line-height: 62px;
    text-decoration: underline;
}
.store-features.style4 .detail p {
    text-transform: uppercase;
    font-size: 10px;
    height: 30px;
}
</style>


<!--Body Container-->
<div id="page-content">

    <!--Banner Masonary-->



    <div class="container">
        <div class="row">
            <div class="col-sm-3" style="display:none">
                <div class="collapse-menu mt-4">
                    <ul>
                        <li><a href="javascript:void(0);" class="vm-menu"><i class="fa fa-navicon"></i><span>All Categories</span></a>
                            <ul class="vm-dropdown">

                                <li><a href="#"><i class="fa fa-home"></i>HOME</a></li>

                                <li><a href="#"><i class="fa fa-arrow-right"></i>ENTERTAINMENT</a>

                                </li>
                                <li><a href="#"><i class="fa fa-arrow-right"></i>EMERGENCY</a></li>
                                <li><a href="#"><i class="fa fa-arrow-right"></i>ELECTRICIAN</a></li>
                                <li><a href="#"><i class="fa fa-arrow-right"></i>EDUCATION</a></li>
                                <li><a href="#"><i class="fa fa-arrow-right"></i>DOCTOR</a></li>
                                <li><a href="#"><i class="fa fa-arrow-right"></i>DANCE & MUSIC</a></li>
                                <li><a href="#"><i class="fa fa-arrow-right"></i>DAILY NEEDS</a></li>
                                <li><a href="#"><i class="fa fa-arrow-right"></i>CHILD CARE</a></li>
                                <li><a href="#"><i class="fa fa-arrow-right"></i>CARPENTER</a></li>
                                <li><a href="#"><i class="fa fa-arrow-right"></i>BEAUTY</a></li>
                                <li><a href="#"><i class="fa fa-arrow-right"></i>AUTOMOBILES</a>
                                    <ul class="mega-menu">

                                        <li class="megamenu-single">
                                            <span class="mega-menu-title">CARS & SERVICES</span>
                                            <ul>
                                                <li><a href="#">New Car</a></li>
                                                <li><a href="#">Used Cars</a></li>
                                                <li><a href="#">Car Insurance</a></li>
                                                <li><a href="#">Car Services</a></li>
                                                <li><a href="#">Car Spare Parts</a></li>
                                                <li><a href="#">Car Wash & Care</a></li>

                                            </ul>
                                        </li>
                                        <li class="megamenu-single">
                                            <span class="mega-menu-title">BIKES & 2-WHEELER</span>
                                            <ul>
                                                <li><a href="#"> New Bikes & Scooter</a></li>
                                                <li><a href="#">Used Bikes & Scooter</a></li>
                                                <li><a href="#">2-Wheeler Insurance</a></li>
                                                <li><a href="#">2-Wheeler Services</a></li>
                                                <li><a href="#">2-Wheeler Spare Parts</a></li>
                                                <li><a href="#">2-Wheeler Wash & Care</a></li>

                                            </ul>
                                        </li>
                                        <li class="megamenu-single">
                                            <span class="mega-menu-title">COMMERCIAL VEHICLES</span>
                                            <ul>
                                                <li><a href="#">New Vehicles</a></li>
                                                <li><a href="#">Used Vehicles</a></li>
                                                <li><a href="#">Vehicle Insurance</a></li>
                                                <li><a href="#">Vehicle Services</a></li>
                                                <li><a href="#">Vehicle Spare Parts</a></li>
                                                <li><a href="#">Vehicle Wash & Care</a></li>
                                            </ul>
                                        </li>

                                        <li class="megamenu-single">
                                            <span class="mega-menu-title">MORE VEHICLE SERVICES</span>
                                            <ul>
                                                <li><a href="#"> Challan Settlements</a></li>
                                                <li><a href="#">Insurance & Claims</a></li>
                                                <li><a href="#">Loans & Settlement</a></li>
                                                <li><a href="#">Transport Legal Help</a></li>
                                                <li><a href="#">E-Rickshaw Dealers</a></li>
                                                <li><a href="#">Puncture & Type Shop</a></li>


                                            </ul>
                                        </li>

                                    </ul>

                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12">

                <section class="section collection-banners main-collection-banners style8 mt-0 pt-4 mb-0 pb-0">
                    <div class="grid-masonary grid-mr-20">
                        <div class="grid-sizer col-12 col-sm-12 col-md-6 col-lg-6 mw-100"></div>
                        <div class="row mx-0">
                            <!--div class="col-12 col-sm-12 col-md-6 col-lg-6 mw-100 cl-item banner-item">
                                <div class="collection-grid-item banner1">
                                        <?php
                                        $top_ban = Cpr_banner::where('position', 'home-top-left')->first();
                                        ?>
                                    <a href="{{isset($top_ban->link)?$top_ban->link:'javascript:void(0)'}}">
                                        
                                        <div class="img"><img class="rounded-2 blur-up lazyload" data-src="{{asset('public/banner/'.$top_ban->banner)}}" src="{{asset('public/banner/'.$top_ban->banner)}}" style=" height: 489px;" alt="collection" title="" /></div>
                                        <div class="details center-left bg-transparent" >
                                            <div class="inner">                                                
                                                <h3 class="title lh-1 fw-bold">{{$top_ban->heading}}</h3>
                                                <p class="subtitle fs-5 lh-1 mt-1">{{$top_ban->heading}}</p>
                                                <a href="{{isset($top_ban->link)?$top_ban->link:'javascript:void(0)'}}"><span class="btn--link mt-4 small--hide">Search all cars</span></a>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div-->
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 mw-100 cl-item banner-item">
                                <!--div class="collection-grid-item banner2">
                                        <?php
                                        $top_ban_left = Cpr_banner::where('position', 'home-top-right-up')->first();
                                        ?>
                                    <a href="{{isset($top_ban_left->link)?$top_ban_left->link:'javascript:void(0)'}}">
                                        <div class="img"><img class="rounded-2 blur-up lazyload" data-src="{{asset('public/banner/'.$top_ban_left->banner)}}" src="{{asset('public/banner/'.$top_ban_left->banner)}}" alt="collection" title="" style="height:220px" /></div>
                                        <div class="details center-right bg-transparent" style="z-index: 9 !important; ">
                                            <div class="inner text-black">
                                                <h3 class="title lh-1 fw-bold">{{$top_ban_left->heading}}</h3>
                                                <p class="subtitle lh-1 mt-3 mb-0">{{$top_ban_left->heading}}</p>
                                                <span class="btn--link mt-4 small--hide">Search property</span>

                                            </div>
                                        </div>
                                    </a>
                                </div-->
                                <div class="collection-grid-item banner3 ">
                                    <?php
                                    $top_ban_left_down = Cpr_banner::where('position', 'home-top-right-down')->first();
                                    ?>
                                    <a href="{{isset($top_ban_left_down->link)?$top_ban_left_down->link:'javascript:void(0)'}}">
                                        <div class="img"><img class="rounded-2 blur-up lazyload" data-src="{{asset('public/banner/'.$top_ban_left_down->banner)}}" src="{{asset('public/banner/'.$top_ban_left_down->banner)}}" alt="collection" title="" /></div>
                                        <div class="details top-left bg-transparent">
                                            <div class="inner">
                                                <h3 class="title lh-1 fw-bold">{{$top_ban_left_down->heading}}</h3>
                                                <p class="subtitle lh-1 mb-0">{{$top_ban_left_down->heading}}</p>
                                                <span class="btn--link mt-4 small--hide">Search electronics</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
               
            <section class="section store-features style4 cat-store pb-0">
                    <div class="container">                       
                        <div class="row store-info">
						<ul>
						    @foreach($cats as $cat)
						    <a href="{{url('subcat/'.$cat->category_slug)}}">
                            <li class=" align-items-center text-center mb-4">
                                @if(isset($cat->icon))
                                <img class="feature-icon blur-up lazyloaded" src="{{asset('public/public/category/icon/'.$cat->icon)}}" alt="image" width="45" height="45">
                                @else
                                <img class="feature-icon blur-up lazyloaded" src="https://profilebaba.com/webassets/images/hotel-2022.svg" alt="image" width="45" height="45">
                                @endif
                                
							   <div class="detail pt-1">
                                    <p>{{$cat->category_name}}</p>
                                </div>
                            </li>
                            </a>
                            @endforeach
							<li class="align-items-center text-center mb-4">
                               <p class="view_all"><a href="{{url('allcat')}}">View All</a></p>
                                
                            </li>	
							</ul>
							</div>
                    </div>
                </section>




			   <section class="section product-slider pt-5 pb-5 bg-white">
                    <div class="container">
                        <div class="section-header">
                            <h2>New Deals</h2>
                        </div>
                        <div class="productSlider grid-products">
                            @foreach($deal as $data)
                            <div class="item">
                                <!--Start Product Image-->
                                <div class="product-image">
                                    <!--Start Product Image-->
                                    <a href="{{url('product_detail/'.$data->id)}}" class="product-img">
                                        <!--Image-->
                                        <?php
                                        $pic = Cpr_Add_images::where('ad_id', $data->id)->orderBy('image_order', 'ASC')->first();
                                        ?>
                                        <img class="primary blur-up lazyload" data-src="{{asset('public/ad/'.$pic?->image)}}" src="{{asset('public/ad/'.$pic?->image)}}" alt="image" title="" style=" max-width: 210px;max-height: 130px;width:auto" />
                                        <!--End Image-->
                                        <!--Hover Image-->
                                        <img class="hover blur-up lazyload" data-src="{{asset('public/ad/'.$pic?->image)}}" src="{{asset('public/ad/'.$pic?->image)}}" alt="image" title="" style=" max-width: 210px;max-height: 130px;width:auto" />
                                        <!--End Hover Image-->
                                    </a>
                                    <!-- End Product Image -->


                                </div>
                                <!-- End Product Image -->
                                <!--Start Product Details-->
                                <div class="product-details text-left">
                                    <!--Product Name-->
                                    <div class="product-name product-name_fixh " style="word-wrap: break-word;">
                                        <h5>{{$data->title}}</h5>
                                        <a class="text-uppercase fw-normal" href="">₹&nbsp;{{$data->price}}</a>
                                    </div>
                                    <?php
                                    $use = webUser::find($data->user_id);
                                    ?>
                                    <div class="mrchant_wrap">
                                        <a href="{{url('merchant-profile/'.$data->user_id)}}">
                                            @if(isset($use->companyLogo))
                                            <img src="{{asset('public/user/'.$use->companyLogo)}}">
                                            @elseif(isset($use->image))
                                            <img src="{{asset('public/user/'.$use->image)}}">
                                            @else
                                            <img src="assets/images/users/avatar-3.jpg">
                                            @endif
                                            <div class="mrchant_info">
                                                <h5>
                                                    @if(isset($use->companyName))
                                                    {{@$use->companyName}}
                                                    @else
                                                    {{@$use->firstName}} {{@$use->lastName}}
                                                    @endif
                                                </h5>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <!--End Product Details-->
                            </div>
                            @endforeach


                        </div>
                    </div>
                </section>
                <!--Home Slider-->
                <section class="section imgBanners pt-2 pt-md-0 mt-0 home-second-top-bnr">
                    <div class="container">
                        <?php
                        $top_ban_send = Cpr_banner::where('position', 'home-second-top')->first();
                        ?>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12" style="padding:0">
                                <a href="#"><img class="blur-up lazyloaded" src="{{asset('public/banner/'.$top_ban_send->banner)}}" style="width: 100%;" title=" "></a>
                            </div>
                        </div>
                    </div>
                </section>
                <!--End Home Slider-->
                <section class="section section mini-product mt-0 home_mini-product  pt-0 pb-4 bg-white">
                    <div class="container">
                        <div class="section-header">
                            <h2 class="text-transform-none">Featured Deals </h2>
                        </div>

                        <div class="mini-product-list row">
                            @foreach($feature as $cdata)
                            <div class=" col-sm-6">
                                <div class="mini-list-item d-flex clearfix">
                                    <div class="mini-view_image">
                                        <a class="grid-view-item__link" href="{{url('product_detail/'.$cdata->id)}}">
                                            <?php
                                            $pic = Cpr_Add_images::where('ad_id', $cdata->ad_id)->orderBy('image_order', 'ASC')->first();
                                            ?>
                                            <img class="primary blur-up lazyload" data-src="{{asset('public/ad/'.$pic?->image)}}" src="{{asset('public/ad/'.$pic?->image)}}" alt="image" title="product" /></a>
                                    </div>
                                    <div class="ms-3 details" style="word-wrap: break-word;">
                                        <a class="grid-view-item__title" href="{{url('product_detail/'.$cdata->id)}}">{{$cdata->title}}</a>
                                        <div class="grid-view-item__meta mb-2">
                                            <div class="product-price"><span class="price">₹&nbsp;{{$cdata->price}}</span></div>
                                        </div>
                                        <?php
                                        $use = webUser::find($cdata->user_id);
                                        ?>
                                        <div class="mrchant_wrap">
                                            <a href="{{url('merchant-profile/'.$data->user_id)}}">
                                                @if(isset($use->companyLogo))
                                                <img src="{{asset('public/user/'.$use->companyLogo)}}">
                                                @elseif(isset($use->image))
                                                <img src="{{asset('public/user/'.$use->image)}}">
                                                @else
                                                <img src="assets/images/users/avatar-3.jpg">
                                                @endif
                                                <div class="mrchant_info">
                                                    <h5>
                                                        @if(isset($use->companyName))
                                                        {{$use->companyName}}
                                                        @else
                                                        {{$use->firstName}} {{$use->lastName}}
                                                        @endif
                                                    </h5>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach


                        </div>

                    </div>
                </section>

                <!--Home Slider-->
                <section class="section imgBanners pt-2 pt-md-0 mt-0">
                    <div class="container">
                        <?php
                        $top_ban_middle = Cpr_banner::where('position', 'home-middle')->first();
                        ?>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12" style="padding:0">
                                <a href="#">
                                    @if(isset($top_ban_middle))
                                    <img class="blur-up lazyloaded" src="{{asset('public/banner/'.$top_ban_middle->banner)}}" style="width: 100%;" title=" ">
                                    @else
                                    <img class="blur-up lazyloaded" src="{{asset('webassets/images/home-img/c2-png')}}" style="width: 100%;" title="">
                                    @endif</a>
                            </div>
                        </div>
                    </div>
                </section>
                <!--End Home Slider-->
                <section class="section section mini-product mt-0 home_mini-product pt-0">
                    <div class="container">
                        <div class="section-header">
                            <h2 class="text-transform-none">Deal Collection </h2>
                        </div>

                        <div class="mini-product-list row">
                            @foreach($collection as $cdata)
                            <div class=" col-sm-6">
                                <div class="mini-list-item d-flex clearfix">
                                    <div class="mini-view_image">
                                        <a class="grid-view-item__link" href="{{url('product_detail/'.$cdata->id)}}">
                                            <?php
                                            $pic = Cpr_Add_images::where('ad_id', $cdata->ad_id)->orderBy('image_order', 'ASC')->first();
                                            ?>
                                            <img class="primary blur-up lazyload" data-src="{{asset('public/ad/'.$pic?->image)}}" src="{{asset('public/ad/'.$pic?->image)}}" alt="image" title="product" /></a>
                                    </div>
                                    <div class="ms-3 details" style="word-wrap: break-word;">
                                        <a class="grid-view-item__title" href="{{url('product_detail/'.$cdata->id)}}">{{$cdata->title}}</a>
                                        <div class="grid-view-item__meta mb-2">
                                            <div class="product-price"><span class="price">₹&nbsp;{{$cdata->price}}</span></div>
                                        </div>
                                        <?php
                                        $use = webUser::find($cdata->user_id);
                                        ?>
                                        <div class="mrchant_wrap">
                                            <a href="{{url('merchant-profile/'.$data->user_id)}}">
                                                @if(isset($use->companyLogo))
                                                <img src="{{asset('public/user/'.$use->companyLogo)}}">
                                                @elseif(isset($use->image))
                                                <img src="{{asset('public/user/'.$use->image)}}">
                                                @else
                                                <img src="assets/images/users/avatar-3.jpg">
                                                @endif
                                                <div class="mrchant_info">
                                                    <h5>
                                                        @if(isset($use->companyName))
                                                        {{$use->companyName}}
                                                        @else
                                                        {{$use->firstName}} {{$use->lastName}}
                                                        @endif
                                                    </h5>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>

                    </div>
                </section>

                <!--Home Slider-->
                <section class="section imgBanners pt-2 pt-md-0">
                    <div class="container">
                        <?php
                        $top_ban_bootom = Cpr_banner::where('position', 'home-second-last-botom')->first();
                        ?>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12" style="padding:0">
                                <a href="#"><img class="blur-up lazyloaded" src="{{asset('public/banner/'.$top_ban_bootom->banner)}}" style="width: 100%;" title=" "></a>
                            </div>
                        </div>
                    </div>
                </section>
                <!--End Home Slider-->



                <section class="section section mini-product mt-0 home_mini-product pt-0 pb-4 bg-white Electric_mini-product">
                    <div class="container">
                        <div class="section-header">
                            <h2 class="text-transform-none">From Profile Baba </h2>
                        </div>

                        <div class="mini-product-list row">
                            @foreach($Electric as $cdata)
                            <div class=" col-sm-6">
                                <div class="mini-list-item d-flex clearfix ">
                                    <div class="mini-view_image"><a class="grid-view-item__link" href="{{url('product_detail/'.$cdata->id)}}">
                                            <?php
                                            $pic = Cpr_Add_images::where('ad_id', $cdata->ad_id)->orderBy('image_order', 'ASC')->first();
                                            ?>
                                            <img class="primary blur-up lazyload" data-src="{{asset('public/ad/'.$pic?->image)}}" src="{{asset('public/ad/'.$pic?->image)}}" alt="image" title="product" />
                                        </a>
                                    </div>
                                    <div class="ms-3 details" style="word-wrap: break-word;">
                                        <a class="grid-view-item__title" href="{{url('product_detail/'.$cdata->id)}}">{{$cdata->title}}</a>
                                        <div class="grid-view-item__meta mb-2 mt-2">
                                            <div class="product-price"><span class="price">₹&nbsp;{{$cdata->price}}</span></div>
                                        </div>
                                        <?php
                                        $use = webUser::find($cdata->user_id);
                                        ?>
                                        <div class="mrchant_wrap">
                                            <a href="{{url('merchant-profile/'.$data->user_id)}}">
                                                @if(isset($use->companyLogo))
                                                <img src="{{asset('public/user/'.$use->companyLogo)}}">
                                                @elseif(isset($use->image))
                                                <img src="{{asset('public/user/'.$use->image)}}">
                                                @else
                                                <img src="assets/images/users/avatar-3.jpg">
                                                @endif
                                                <div class="mrchant_info">
                                                    <h5>
                                                        @if(isset($use->companyName))
                                                        {{$use->companyName}}
                                                        @else
                                                        {{$use->firstName}} {{$use->lastName}}
                                                        @endif
                                                    </h5>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach



                        </div>

                    </div>
                </section>



                <!--Home Slider-->
                <section class="section imgBanners pt-2 pt-md-0 pb-0 mb-5">
                    <div class="container-fluid p0">
                        <?php
                        $top_bootom = Cpr_banner::where('position', 'home-bottom')->first();
                        ?>

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <a href="#"><img class="blur-up lazyloaded" src="{{asset('public/banner/'.$top_bootom->banner)}}" style="width: 100%;" title=" "></a>
                        </div>

                    </div>
                </section>
                <!--End Home Slider-->

            </div>
        </div>

    </div>


</div>
<!--End Body Container-->


@endsection
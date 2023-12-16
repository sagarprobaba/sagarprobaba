<?php

use App\Models\Cpr_Add_images;
use App\Models\Cpr_banner;
use App\Models\webUser;
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
    width: 70px;height: 70px;
    padding: 10px;
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

            <section class="section store-features style4 cat-store pb-0">
                    <div class="container"> 
					<div class="row store-info">
						<ul>
                            @foreach($cats as $cat)
                            @if($cat->parent_id == 0)
                            <a href="{{url('subcat/'.$cat->category_slug)}}">
                            @else
                            <a href="{{url('adlist/'.$cat->category_slug)}}">
                            @endif
                                <li class="align-items-center text-center mb-4">
                                    @if(isset($cat->icon))
                                    <img class="feature-icon blur-up lazyloaded" src="{{asset('public/public/category/icon/'.$cat->icon)}}" alt="image" width="45" height="45">
                                    @else
                                    <img class="feature-icon blur-up lazyloaded" src="https://profilebaba.com/webassets/images/hotel-2022.svg" alt="image" width="45" height="45">
                                    @endif
                                    
    							   <div class="detail pt-1">
                                        <p style="font-size:10px">{{$cat->category_name}}</p>
                                    </div>
                                </li>
                            </a>
                            @endforeach
								
								
							</ul>
							</div>
				   </div>
                </section>


            

            </div>
        </div>

    </div>


</div>
<!--End Body Container-->


@endsection
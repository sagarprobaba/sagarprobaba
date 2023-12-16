<?php

use App\Models\Cpr_ad_category;
use App\Models\Cpr_footer_category;

$cat = Cpr_ad_category::where('parent_id', 0)->orderByDesc('id')->get();
$mobcat = Cpr_ad_category::where('parent_id', 0)->orderByDesc('id')->get();
$foot = Cpr_footer_category::where('parent_id', 0)->orderByDesc('id')->get();
$footer = Cpr_footer_category::where('parent_id', 0)->orderByDesc('id')->get();
?>
<!doctype html>
<html lang="en">



<head>
    <!--Required Meta Tags-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="description">
    <!-- Title Of Site -->
    <title>Profile Baba</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('webassets/images/favi.png')}}" />
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{asset('webassets/css/plugins.css')}}" />
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{asset('webassets/css/style.css')}}" />
    <link rel="stylesheet" href="{{asset('webassets/css/responsive.css')}}" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <style>
        .toplinks>li>a:hover {
            color: #ea4335 !important;
        }
    </style>
                         @if(isset(Auth::guard('webUser')->user()->id))
                            @if(Auth::guard('webUser')->user()->account_type == 'u')
                            <style>
                                .item a 
                                {
                                            color: #fff !important;
                                }
                            </style>                          
                            @endif
                         @endif
</head>

<body class="template-index index-demo20 home_verticle_menu">
    <!-- Page Loader -->
    <!--div id="pre-loader"><img src="{{asset('webassets/images/load.gif')}}" alt="Loading..." /></div-->
    <!-- End Page Loader -->

    <!--Page Wrapper-->
    <div class="page-wrapper">
        <!--Topbar-->
        <div class="top-info-bar" @if(isset(Auth::guard('webUser')->user()->id)) @if(Auth::guard('webUser')->user()->account_type == 'v') style="background-color: yellow !important;" @else style="background-color: green !important;" @endif @endif>
            <div class="container">
                <div class="row">
                    <div class="item d-flex flex-row  col-12 col-sm-6 col-md-7 col-lg-7 d-lg-flex pb-0">
                        <h5
                        @if(isset(Auth::guard('webUser')->user()->id))
                         @if(Auth::guard('webUser')->user()->account_type == 'v')
                         style="color:#222;font-weight: normal;font-size: 13px;" 
                         @else
                         style="color:#fff;font-weight: normal;font-size: 13px;" 
                         @endif
                         @else
                         style="color:#222;font-weight: normal;font-size: 13px;" 
                        @endif
                         class="header_loc"><i class="fa fa-map-marker"></i>Current Location :{{$myLocation->countryName}},{{$myLocation->regionName}},{{$myLocation->cityName}}</h5>
                    </div>
                    <div class="item fw-600 d-flex flex-row justify-content-lg-end justify-content-center justify-content-md-center justify-content-sm-center col-12 col-sm-6 col-md-5 col-lg-5 d-none d-lg-flex pb-0">
                        <ul class="toplinks list-inline m-0">
                           <!-- <li class="list-inline-item"><a href="https://e2od.com/page/coming-soon" target="_blank">Daily Deals</a></li>
                            <li class="list-inline-item"><a href="https://e2od.com/page/coming-soon" target="_blank">Help & Contact</a></li>-->
                            <!-- <li class="list-inline-item"><a href="#">Sell</a></li> -->
                            @if(isset(Auth::guard('webUser')->user()->id))
                            <li class="user-link list-inline-item"><a href="{{url('userdashboard')}}" style="font-weight:bolder">{{Auth::guard('webUser')->user()->firstName}}</a></li>
                            <li class="list-inline-item"><a href="{{url('logoutWeb')}}">Logout</a></li>

                            <!-- <div id="userLinks" class="mt-lg-3">
                                    <ul class="user-links">
                                        <li><a href="login.html">Login</a></li>
                                        <li><a href="register.html">Sign Up</a></li>
                                        <li><a href="my-wishlist.html">Wishlist</a></li>
                                        <li><a href="compare-style1.html">Compare</a></li>
                                    </ul>
                                </div> -->
                            @else
                            <li class="list-inline-item"><a href="{{url('login')}}">Log in</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--End Topbar-->

        <!--Header wrap-->
        <div class="header-main header-18" @if(isset(Auth::guard('webUser')->user()->id)) @if(Auth::guard('webUser')->user()->account_type == 'v') style="background-color: yellow !important;" @else style="background-color: green !important;" @endif @endif>
            <!--Header-->
            <header id="header" class="header header-wrap d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <!--Logo / Menu Toggle-->
                        <div class="col-6 col-sm-6 col-md-6 col-lg-2 align-self-center justify-content-start d-flex">
                            <!--Mobile Toggle-->
                            <button type="button" class="btn--link site-header__menu js-mobile-nav-toggle mobile-nav--open me-3 d-lg-none"><i class="icon an an-times-l"></i><i class="icon an an-bars-l"></i></button>
                            <!--End Mobile Toggle-->
                            <!--Logo-->
                            <div class="logo"><a href="{{url('/')}}"><img class="logo-img mh-100" src="{{asset('webassets/images/logo.png')}}" alt="" title="" width="300" /></a></div>
                            <!--End Logo-->
                        </div>
                        <!--End Logo / Menu Toggle-->
                        <!--Search Inline-->
                        <div class="col-1 col-sm-1 col-md-1 col-lg-8 d-none d-lg-block">
                            <form class="form minisearch search-inline px-5 pt-4" id="header-search1" action="{{url('search')}}" method="get">
                                @csrf
                                <label class="label d-none"><span>Search</span></label>
                                <div class="control">
                                    <div class="searchField d-flex">
                                        <div class="search-category">
                                            <select id="rgsearch-category1" name="category" data-default="All Categories" class="">

                                                <option value="">All Categories</option>
                                                @foreach($cat as $allc)
                                                <option value="{{$allc->category_slug}}">{{$allc->category_name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="input-box d-flex w-100">
                                            <input type="text" name="char" value="" id="search" onkeyup="preSearch(this.value)" placeholder="Search services or #" class="input-text rounded-0 border-start-0 border-end-0" required>

                                            <a href="#" title="Search" class="action search " style="background:#ea4335"><button type="submit" style="background-color: transparent;border-color: transparent;"><i class="icon an an-search-l" style="color:#fff"></i></button></a>
                                        </div>
                                    </div>
                                    <ul class="list-group my-search-result" id="searchList" style="max-height: 200px;overflow: auto;z-index: 1;position: fixed;width: 562px;margin-left: 138px;">

                                    </ul>
                                </div>
                            </form>
                        </div>
                        <!--End Search Inline-->
                        <!--Right Action-->
                        <div class="col-6 col-sm-6 col-md-6 col-lg-2 align-self-center icons-col text-right d-flex justify-content-end">
                            <!--Search-->
                            <div class="site-search iconset d-block d-lg-none"><i class="icon an an-search-l"></i><span class="tooltip-label">Search</span></div>
                            <!--End Search-->
                            <!--Wishlist-->
                            <div class="wishlist-link iconset d-none"><i class="icon an an-heart-l"></i><span class="wishlist-count counter d-flex-center justify-content-center position-absolute translate-middle rounded-circle">0</span><span class="tooltip-label">Wishlist</span></div>
                            <!--End Wishlist-->
                            <!--Setting Dropdown-->
                            @if(isset(Auth::guard('webUser')->user()->id))
                            @if(Auth::guard('webUser')->user()->account_type == 'v')
                            <div class="user-link iconset flex-lg-column">
                                <a href="{{route('AddPost.index')}}" class="btn rounded-0 product-form__cart-submit mb-0 add-listing-btn" style="color:#fff">Add Services</a>



                            </div>
                            @endif
                            @endif

                            <!--End Setting Dropdown-->

                            <!--End Setting Dropdown-->
                        </div>
                        <!--End Right Action-->
                    </div>
                </div>
                <!--Search Popup-->
                <div id="search-popup" class="search-drawer">
                    <div class="container">
                        <span class="closeSearch an an-times-l"></span>
                        <form class="form minisearch" id="header-search" action="#" method="get">
                            <label class="label"><span>Search</span></label>
                            <div class="control">
                                <div class="searchField">
                                    <div class="search-category">
                                        <select id="rgsearch-category" name="rgsearch[category]" data-default="All Categories">
                                            <option value="00" label="All Categories" selected="selected">All Categories</option>
                                            <optgroup id="rgsearch-shop" label="Shop">
                                                @foreach($cat as $all)
                                                <option value="{{$allc->category_slug}}">{{$all->category_name}}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div class="input-box">
                                        <button type="submit" title="Search" class="action search rounded-0"><i class="icon an an-search-l"></i></button>
                                        <input type="text" name="q" value="" placeholder="Search by keyword or #" class="input-text rounded-0">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--End Search Popup-->
            </header>
            <!--End Header-->
            <!--Main Navigation Desktop-->
           
            <!--End Main Navigation Desktop-->
        </div>
        <!--End Header wrap-->

        <!--Mobile Menu-->
        <div class="mobile-nav-wrapper" role="navigation">
            <div class="closemobileMenu"><i class="icon an an-times-l pull-right"></i> Close Menu</div>
            <ul id="MobileNav" class="mobile-nav medium">
                <li class="lvl1 parent megamenu"><a href="{{url('/')}}">Home</a>

                </li>
                @foreach($mobcat as $cats)
                <li class="lvl1 parent megamenu"><a href="{{url('adlist/'.$cats->category_slug)}}">{{$cats->category_name}} <i class="an an-plus-l"></i></a>
                    <ul>
                        <?php
                        $sub = Cpr_ad_category::where('parent_id', $cats->id)->get();
                        ?>
                        @if(!empty($sub))
                        @foreach($sub as $sub)
                        <li><a href="{{url('adlist/'.$sub->category_slug)}}" class="site-nav">{{$sub->category_name}} <i class="an an-plus-l"></i></a>
                            <ul>
                                <?php
                                $sub_sub = Cpr_ad_category::where('parent_id', $sub->id)->get();
                                ?>
                                @if(!empty($sub_sub))
                                @foreach($sub_sub as $sub_sub)
                                <li><a href="{{url('adlist/'.$sub_sub->category_slug)}}" class="site-nav">{{$sub_sub->category_name}}</a></li>
                                @endforeach
                                @endif
                            </ul>
                        </li>
                        @endforeach
                        @endif
                    </ul>
                </li>
                @endforeach
                <!-- <li class="lvl1 parent megamenu"><a href="#">Product <i class="an an-plus-l"></i></a>
                    <ul>
                        <li><a href="product-standard.html" class="site-nav">Product Types<i class="an an-plus-l"></i></a>
                            <ul>
                                <li><a href="product-standard.html" class="site-nav">Simple Product</a></li>
                                <li><a href="product-variable.html" class="site-nav">Variable Product</a></li>
                                <li><a href="product-grouped.html" class="site-nav">Grouped Product</a></li>
                                <li><a href="product-external-affiliate.html" class="site-nav">External / Affiliate Product</a></li>
                                <li><a href="product-outofstock.html" class="site-nav">Out Of Stock Product</a></li>
                                <li><a href="" class="site-nav">New Product</a></li>
                                <li><a href="product-layout2.html" class="site-nav">Sale Product</a></li>
                                <li><a href="" class="site-nav">Variable Image</a></li>
                                <li><a href="product-accordian.html" class="site-nav">Variable Select</a></li>
                                <li><a href="prodcut-360-degree-view.html" class="site-nav last">360 Degree view</a></li>
                            </ul>
                        </li>
                        <li><a href="" class="site-nav">Product Page Types <i class="an an-plus-l"></i></a>
                            <ul>
                                <li><a href="" class="site-nav">Product Layout1</a></li>
                                <li><a href="product-layout2.html" class="site-nav">Product Layout2</a></li>
                                <li><a href="product-layout3.html" class="site-nav">Product Layout3</a></li>
                                <li><a href="product-layout4.html" class="site-nav">Product Layout4</a></li>
                                <li><a href="product-layout5.html" class="site-nav">Product Layout5</a></li>
                                <li><a href="product-layout6.html" class="site-nav">Product Layout6</a></li>
                                <li><a href="product-layout7.html" class="site-nav">Product Layout7</a></li>
                                <li><a href="product-accordian.html" class="site-nav">Product Accordian</a></li>
                                <li><a href="product-tabs-left.html" class="site-nav">Product Tabs Left</a></li>
                                <li><a href="product-tabs-center.html" class="site-nav last">Product Tabs Center</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="lvl1 parent megamenu"><a href="#">Collections <i class="an an-plus-l"></i></a>
                    <ul>
                        <li><a href="#" class="site-nav">Bedding <i class="an an-plus-l"></i></a>
                            <ul>
                                <li><a href="#" class="site-nav">Bedsheets</a></li>
                                <li><a href="#" class="site-nav">Tablewear</a></li>
                                <li><a href="#" class="site-nav">Kitchenware</a></li>
                                <li><a href="#" class="site-nav last">Flooring</a></li>
                            </ul>
                        </li>
                        <li><a href="#" class="site-nav">Kids Furniture <i class="an an-plus-l"></i></a>
                            <ul>
                                <li><a href="#" class="site-nav">Table Decor</a></li>
                                <li><a href="#" class="site-nav">Cushion Fillers</a></li>
                                <li><a href="#" class="site-nav">Kitchen Linen</a></li>
                                <li><a href="#" class="site-nav last">Bedsheets</a></li>
                            </ul>
                        </li>
                        <li><a href="#" class="site-nav">Shoes Rack <i class="an an-plus-l"></i></a>
                            <ul>
                                <li><a href="#" class="site-nav">Bedsheets</a></li>
                                <li><a href="#" class="site-nav">Tablewear</a></li>
                                <li><a href="#" class="site-nav">Kitchenware</a></li>
                                <li><a href="#" class="site-nav last">Flooring</a></li>
                            </ul>
                        </li>
                        <li><a href="#" class="site-nav">Bathlinen <i class="an an-plus-l"></i></a>
                            <ul>
                                <li><a href="#" class="site-nav">Table Decor</a></li>
                                <li><a href="#" class="site-nav">Cushion Fillers</a></li>
                                <li><a href="#" class="site-nav">Kitchen Linen</a></li>
                                <li><a href="#" class="site-nav last">Bedsheets</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="lvl1 parent megamenu"><a href="#">Shop Offers <i class="an an-plus-l"></i></a>
                    <ul>
                        <li><a href="" class="site-nav">Black Flower Vase</a></li>
                        <li><a href="" class="site-nav">Wooden Baby Chair</a></li>
                        <li><a href="" class="site-nav">Round Wall Clock</a></li>
                        <li><a href="" class="site-nav">Cushioned Office Chair</a></li>
                    </ul>
                </li> -->

                <!-- <li class="lvl1 parent megamenu"><a href="blog-left-sidebar.html">Blog <i class="an an-plus-l"></i></a>
                    <ul>
                        <li><a href="blog-left-sidebar.html" class="site-nav">Left Sidebar</a></li>
                        <li><a href="blog-right-sidebar.html" class="site-nav">Right Sidebar</a></li>
                        <li><a href="blog-fullwidth.html" class="site-nav">Fullwidth</a></li>
                        <li><a href="blog-masonry.html" class="site-nav">Masonry Blog Style</a></li>
                        <li><a href="blog-2columns.html" class="site-nav">2 Columns</a></li>
                        <li><a href="blog-3columns.html" class="site-nav">3 Columns</a></li>
                        <li><a href="blog-4columns.html" class="site-nav">4 Columns</a></li>
                        <li><a href="blog-single-post.html" class="site-nav last">Article Page</a></li>
                    </ul>
                </li> -->
                <li class="acLink"></li>

                @if(isset(Auth::guard('webUser')->user()->id))
                <li class="lvl1 bottom-link"><a href="{{url('logoutWeb')}}">Logout</a></li>
                <li class="lvl1 bottom-link"><a href="{{url('userdashboard')}}">Dashboard</a></li>
                @else
                <li class="lvl1 bottom-link"><a href="{{url('login')}}">Login</a></li>
                <li class="lvl1 bottom-link"><a href="{{url('register')}}">Signup</a></li>
                @endif

                <li class="lvl1 parent megamenu"><a href="#">Pages <i class="an an-plus-l"></i></a>
                    <ul>
                        @foreach($footer as $foots)
                        <li class="lvl1 parent megamenu"><a href="#">{{$foots->name}} <i class="an an-plus-l"></i></a>
                            <ul>
                                <?php
                                $subFoot = Cpr_footer_category::where('parent_id', $foots->id)->get();
                                ?>
                                @if(!empty($subFoot))
                                @foreach($subFoot as $subFoot)
                                <li><a href="{{$subFoot->link}}" class="site-nav">{{$subFoot->name}}</a></li>
                                @endforeach
                                @endif
                            </ul>
                        </li>
                        @endforeach
                        <li><a href="https://e2od.com/page/coming-soon" class="site-nav">Help & Contact</a></li>◘
                        <li><a href="https://e2od.com/page/coming-soon" class="site-nav">Daily Deals</a></li>
                       
                    </ul>
                </li>
                <!-- <li class="lvl1 bottom-link"><a href="compare-style1.html">Compare</a></li> -->
            </ul>
        </div>
        <!--End Mobile Menu-->
        @yield('body')
        <!--Footer-->
        <div class="footer footer-1">
            <div class="footer-top clearfix">
                <div class="container">
                    <div class="row">
                        <!-- @foreach($foot as $foot)
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 footer-links text-center">

                            <ul>
                                <?php
                                $subFoot = Cpr_footer_category::where('parent_id', $foot->id)->get();
                                ?>
                                @foreach($subFoot as $subFoot)
                                <li><a href="{{$subFoot->link}}">{{$subFoot->name}}</a></li>
                                @endforeach

                            </ul>
                        </div>
                        @endforeach -->
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 footer-links text-center">

                            <ul>
                               
                               
                                <li><a href="{{url('terms-conditions')}}">Terms of Use</a></li>
                                <li><a href="{{url('privacy-policy')}}">Privacy Policy</a></li>
                                <li><a href="{{url('faq')}}">Faq</a></li>
                                <li><a href="{{url('about')}}">About</a></li>
                                <li><a href="{{url('contact')}}">Contact</a></li>
                                

                            </ul>
                        </div>
                        <!--div class="col-12 col-sm-12 col-md-12 col-lg-4 newsletter-col text-right">
                            <div class="display-table pt-md-3 pt-lg-0">
                                <div class="display-table-cell footer-newsletter">
                                    <a href="" style=" border: 1px solid #fff; color: #fff; padding: 10px 20px;border-radius: 100px; margin-bottom:40px">Get the app</a>
                                </div>
                            </div>
                            <ul class="list-inline social-icons mt-3 pt-1">
                                <li class="list-inline-item"><a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Facebook"><i class="an an-facebook" aria-hidden="true"></i></a></li>
                                <li class="list-inline-item"><a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Twitter"><i class="an an-twitter" aria-hidden="true"></i></a></li>
                                <li class="list-inline-item"><a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Instagram"><i class="an an-instagram" aria-hidden="true"></i></a></li>
                            </ul>
                        </div-->
                    </div>

                </div>
            </div>
            <!--div class="footer-bottom clearfix">
                <div class="container">
                    <div class="d-flex-center flex-column justify-content-md-between flex-md-row-reverse">
                        <img src="{{asset('webassets/images/payment.png')}}" alt="Paypal Visa Payments" />
                        <div class="copytext text-uppercase">&copy; 2022 Optimal. All Rights Reserved.</div>
                    </div>
                </div>
            </div-->
        </div>
        <!--End Footer-->

        <!--Scoll Top-->
        <span id="site-scroll"><i class="icon an an-chevron-up"></i></span>
        <!--End Scoll Top-->

        <!--MiniCart Drawer-->
        <div class="minicart-right-drawer modal right fade" id="minicart-drawer">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div id="cart-drawer" class="block block-cart">
                        <div class="minicart-header">
                            <a href="javascript:void(0);" class="close-cart" data-bs-dismiss="modal" aria-label="Close"><i class="an an-times-r" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="left" title="Close"></i></a>
                            <h4 class="fs-6">Your cart (2 Items)</h4>
                        </div>
                        <div class="minicart-content">
                            <ul class="m-0 clearfix">
                                <li class="item d-flex justify-content-center align-items-center">
                                    <a class="product-image" href="">
                                        <img class="blur-up lazyload" src="{{asset('webassets/images/products/furniture-product1.jpg')}}" data-src="{{asset('webassets/images/products/furniture-product1.jpg')}}" alt="image" title="" />
                                    </a>
                                    <div class="product-details">
                                        <a class="product-title" href="">Black Flower Vase</a>
                                        <div class="variant-cart my-1">Black / XL</div>
                                        <div class="priceRow">
                                            <div class="product-price">
                                                <span class="money">$59.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="qtyDetail text-center">
                                        <div class="wrapQtyBtn">
                                            <div class="qtyField">
                                                <a class="qtyBtn minus" href="javascript:void(0);"><i class="icon an an-minus-r" aria-hidden="true"></i></a>
                                                <input type="text" name="quantity" value="1" class="qty rounded-0">
                                                <a class="qtyBtn plus" href="javascript:void(0);"><i class="icon an an-plus-l" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <a href="#" class="edit-i remove"><i class="icon an an-edit-l" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i></a>
                                        <a href="#" class="remove"><i class="an an-times-r" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove"></i></a>
                                    </div>
                                </li>
                                <li class="item d-flex justify-content-center align-items-center">
                                    <a class="product-image" href="">
                                        <img class="blur-up lazyload" src="{{asset('webassets/images/products/furniture-product4.jpg')}}" data-src="{{asset('webassets/images/products/furniture-product4.jpg')}}" alt="image" title="" />
                                    </a>
                                    <div class="product-details">
                                        <a class="product-title" href="">Cushioned Office Chair</a>
                                        <div class="variant-cart my-1">Blue / XL</div>
                                        <div class="priceRow">
                                            <div class="product-price">
                                                <span class="money">$199.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="qtyDetail text-center">
                                        <div class="wrapQtyBtn">
                                            <div class="qtyField">
                                                <a class="qtyBtn minus" href="javascript:void(0);"><i class="icon an an-minus-r" aria-hidden="true"></i></a>
                                                <input type="text" name="quantity" value="1" class="qty rounded-0">
                                                <a class="qtyBtn plus" href="javascript:void(0);"><i class="icon an an-plus-l" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <a href="#" class="edit-i remove"><i class="icon an an-edit-l" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i></a>
                                        <a href="#" class="remove"><i class="an an-times-r" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove"></i></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="minicart-bottom">
                            <div class="shipinfo text-center mb-3 text-uppercase">
                                <p class="freeShipMsg"><i class="an an-truck fs-5 me-2 align-middle"></i>SPENT <b>$99.00</b> MORE FOR FREE SHIPPING</p>
                            </div>
                            <div class="subtotal">
                                <span>Total:</span>
                                <span class="product-price">$258.00</span>
                            </div>
                            <a href="checkout-style2.html" class="w-100 px-2 py-2 lh-base my-2 my-2 btn btn-outline-primary proceed-to-checkout">Proceed to Checkout</a>
                            <a href="cart-style2.html" class="w-100 btn btn-primary py-2 lh-base cart-btn">View Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End MiniCart Drawer-->
        <div class="modalOverly"></div>

        <!--Quickview Popup-->
        <div class="loadingBox">
            <div class="an-spin"><i class="icon an an-spinner4"></i></div>
        </div>
        <div id="quickView-modal" class="mfp-with-anim mfp-hide">
            <button title="Close (Esc)" type="button" class="mfp-close">×</button>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 mb-3 mb-md-0">
                    <!--Model thumbnail -->
                    <div id="quickView" class="carousel slide">
                        <!-- Image Slide carousel items -->
                        <div class="carousel-inner">
                            <div class="item carousel-item active" data-bs-slide-number="0">
                                <img class="blur-up lazyload" data-src="{{asset('webassets/images/products/furniture-product1.jpg')}}" src="{{asset('webassets/images/products/furniture-product1.jpg')}}" alt="image" title="" />
                            </div>
                            <div class="item carousel-item" data-bs-slide-number="1">
                                <img class="blur-up lazyload" data-src="{{asset('webassets/images/products/furniture-product2.jpg')}}" src="{{asset('webassets/images/products/furniture-product2.jpg')}}" alt="image" title="" />
                            </div>
                            <div class="item carousel-item" data-bs-slide-number="2">
                                <img class="blur-up lazyload" data-src="{{asset('webassets/images/products/furniture-product3.jpg')}}" src="{{asset('webassets/images/products/furniture-product3.jpg')}}" alt="image" title="" />
                            </div>
                            <div class="item carousel-item" data-bs-slide-number="3">
                                <img class="blur-up lazyload" data-src="{{asset('webassets/images/products/furniture-product4.jpg')}}" src="{{asset('webassets/images/products/furniture-product4.jpg')}}" alt="image" title="" />
                            </div>
                            <div class="item carousel-item" data-bs-slide-number="4">
                                <img class="blur-up lazyload" data-src="{{asset('webassets/images/products/furniture-product5.jpg')}}" src="{{asset('webassets/images/products/furniture-product5.jpg')}}" alt="image" title="" />
                            </div>
                        </div>
                        <!-- End Image Slide carousel items -->
                        <!-- Thumbnail image -->
                        <div class="model-thumbnail-img">
                            <!-- Thumbnail slide -->
                            <div class="carousel-indicators list-inline">
                                <div class="list-inline-item active" id="carousel-selector-0" data-bs-slide-to="0" data-bs-target="#quickView">
                                    <img class="blur-up lazyload" data-src="{{asset('webassets/images/products/furniture-product1.jpg')}}" src="{{asset('webassets/images/products/furniture-product1.jpg')}}" alt="image" title="" />
                                </div>
                                <div class="list-inline-item" id="carousel-selector-1" data-bs-slide-to="1" data-bs-target="#quickView">
                                    <img class="blur-up lazyload" data-src="{{asset('webassets/images/products/furniture-product2.jpg')}}" src="{{asset('webassets/images/products/furniture-product2.jpg')}}" alt="image" title="" />
                                </div>
                                <div class="list-inline-item" id="carousel-selector-2" data-bs-slide-to="2" data-bs-target="#quickView">
                                    <img class="blur-up lazyload" data-src="{{asset('webassets/images/products/furniture-product3.jpg')}}" src="{{asset('webassets/images/products/furniture-product3.jpg')}}" alt="image" title="" />
                                </div>
                                <div class="list-inline-item" id="carousel-selector-3" data-bs-slide-to="3" data-bs-target="#quickView">
                                    <img class="blur-up lazyload" data-src="{{asset('webassets/images/products/furniture-product4.jpg')}}" src="{{asset('webassets/images/products/furniture-product4.jpg')}}" alt="image" title="" />
                                </div>
                                <div class="list-inline-item" id="carousel-selector-4" data-bs-slide-to="4" data-bs-target="#quickView">
                                    <img class="blur-up lazyload" data-src="{{asset('webassets/images/products/furniture-product5.jpg')}}" src="{{asset('webassets/images/products/furniture-product5.jpg')}}" alt="image" title="" />
                                </div>
                            </div>
                            <!-- End Thumbnail slide -->
                            <!-- Carousel arrow button -->
                            <a class="carousel-control-prev carousel-arrow" href="#quickView" data-bs-target="#quickView" data-bs-slide="prev"><i class="icon an-3x an an-angle-left"></i><span class="visually-hidden">Previous</span></a>
                            <a class="carousel-control-next carousel-arrow" href="#quickView" data-bs-target="#quickView" data-bs-slide="next"><i class="icon an-3x an an-angle-right"></i><span class="visually-hidden">Next</span></a>
                            <!-- End Carousel arrow button -->
                        </div>
                        <!-- End Thumbnail image -->
                    </div>
                    <!--End Model thumbnail -->
                    <div class="text-center mt-3"><a href="">VIEW MORE DETAILS</a></div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                    <h2 class="product-title">Product Quick View Popup</h2>
                    <div class="product-review d-flex-center mb-2">
                        <div class="rating"><i class="icon an an-star"></i><i class="icon an an-star"></i><i class="icon an an-star"></i><i class="icon an an-star"></i><i class="icon an an-star-o"></i></div>
                        <div class="reviews ms-2"><a href="#">5 Reviews</a></div>
                    </div>
                    <div class="product-info">
                        <p class="product-vendor">Vendor: <span class="fw-normal"><a href="#" class="fw-normal">Optimal</a></span></p>
                        <p class="product-type">Product Type: <span class="fw-normal">Tops</span></p>
                        <p class="product-sku">SKU: <span class="fw-normal">50-ABC</span></p>
                    </div>
                    <div class="pro-stockLbl my-2">
                        <span class="d-flex-center stockLbl instock"><i class="icon an an-check-cil"></i><span> In stock</span></span>
                        <span class="d-flex-center stockLbl preorder d-none"><i class="icon an an-clock-r"></i><span> Pre-order Now</span></span>
                        <span class="d-flex-center stockLbl outstock d-none"><i class="icon an an-times-cil"></i> <span>Sold out</span></span>
                        <span class="d-flex-center stockLbl lowstock d-none" data-qty="15"><i class="icon an an-exclamation-cir"></i><span> Order now, Only <span class="items">10</span> left!</span></span>
                    </div>
                    <div class="pricebox">
                        <span class="price old-price">$400.00</span><span class="price product-price__sale">$300.00</span>
                    </div>
                    <div class="sort-description">Optimal Multipurpose Bootstrap 5 Html Template that will give you and your customers a smooth shopping experience which can be used for various kinds of stores such as fashion.. </div>
                    <form method="post" action="#" id="product_form--option" class="product-form">
                        <div class="product-options d-flex-wrap">
                            <div class="swatch clearfix swatch-0 option1">
                                <div class="product-form__item">
                                    <label class="label d-flex">Color:<span class="required d-none">*</span> <span class="slVariant ms-1 fw-bold">Black</span></label>
                                    <ul class="swatches-image swatches d-flex-wrap list-unstyled clearfix">
                                        <li data-value="Black" class="swatch-element color available active">
                                            <label class="rounded-0 swatchLbl small color black" title="Black"></label>
                                            <span class="tooltip-label top">Black</span>
                                        </li>
                                        <li data-value="Green" class="swatch-element color available">
                                            <label class="rounded-0 swatchLbl small color green" title="Green"></label>
                                            <span class="tooltip-label top">Green</span>
                                        </li>
                                        <li data-value="Orange" class="swatch-element color available">
                                            <label class="rounded-0 swatchLbl small color orange" title="Orange"></label>
                                            <span class="tooltip-label top">Orange</span>
                                        </li>
                                        <li data-value="Blue" class="swatch-element color available">
                                            <label class="rounded-0 swatchLbl small color blue" title="Blue"></label>
                                            <span class="tooltip-label top">Blue</span>
                                        </li>
                                        <li data-value="Red" class="swatch-element color available">
                                            <label class="rounded-0 swatchLbl small color red" title="Red"></label>
                                            <span class="tooltip-label top">Red</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="swatch clearfix swatch-1 option2">
                                <div class="product-form__item">
                                    <label class="label">Size:<span class="required d-none">*</span> <span class="slVariant ms-1 fw-bold">XS</span></label>
                                    <ul class="swatches-size d-flex-center list-unstyled clearfix swatch-1 option2">
                                        <li data-value="XS" class="swatch-element xs available active">
                                            <label class="swatchLbl rounded-0 medium" title="XS">XS</label>
                                            <span class="tooltip-label">XS</span>
                                        </li>
                                        <li data-value="S" class="swatch-element s available">
                                            <label class="swatchLbl rounded-0 medium" title="S">S</label>
                                            <span class="tooltip-label">S</span>
                                        </li>
                                        <li data-value="M" class="swatch-element m available">
                                            <label class="swatchLbl rounded-0 medium" title="M">M</label>
                                            <span class="tooltip-label">M</span>
                                        </li>
                                        <li data-value="L" class="swatch-element l available">
                                            <label class="swatchLbl rounded-0 medium" title="L">L</label>
                                            <span class="tooltip-label">L</span>
                                        </li>
                                        <li data-value="XL" class="swatch-element xl available">
                                            <label class="swatchLbl rounded-0 medium" title="XL">XL</label>
                                            <span class="tooltip-label">XL</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-action d-flex-wrap w-100 mb-3 clearfix">
                                <div class="quantity">
                                    <div class="qtyField rounded">
                                        <a class="qtyBtn minus" href="javascript:void(0);"><i class="icon an an-minus-r" aria-hidden="true"></i></a>
                                        <input type="text" name="quantity" value="1" class="product-form__input qty rounded-0">
                                        <a class="qtyBtn plus" href="javascript:void(0);"><i class="icon an an-plus-l" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="add-to-cart ms-3 fl-1">
                                    <button type="button" class="btn button-cart rounded-0"><span>Add to cart</span></button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="wishlist-btn d-flex-center">
                        <a class="add-wishlist d-flex-center text-uppercase me-3" href="my-wishlist.html" title="Add to Wishlist"><i class="icon an an-heart-l me-1"></i> <span>Add to Wishlist</span></a>
                        <a class="add-compare d-flex-center text-uppercase" href="compare-style1.html" title="Add to Compare"><i class="icon an an-random-r me-2"></i> <span>Add to Compare</span></a>
                    </div>
                    <!-- Social Sharing -->
                    <div class="social-sharing share-icon d-flex-center mx-0 mt-3">
                        <span class="sharing-lbl me-2">Share :</span>
                        <a href="#" class="d-flex-center btn btn-link btn--share share-facebook" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Facebook"><i class="icon an an-facebook mx-1"></i><span class="share-title d-none">Facebook</span></a>
                        <a href="#" class="d-flex-center btn btn-link btn--share share-twitter" data-bs-toggle="tooltip" data-bs-placement="top" title="Tweet on Twitter"><i class="ICON AN An-twitter mx-1"></i><span class="share-title d-none">Tweet</span></a>
                        <a href="#" class="d-flex-center btn btn-link btn--share share-pinterest" data-bs-toggle="tooltip" data-bs-placement="top" title="Pin on Pinterest"><i class="icon an an-pinterest-p mx-1"></i> <span class="share-title d-none">Pin it</span></a>
                        <a href="#" class="d-flex-center btn btn-link btn--share share-linkedin" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Instagram"><i class="icon an an-instagram mx-1"></i><span class="share-title d-none">Instagram</span></a>
                        <a href="#" class="d-flex-center btn btn-link btn--share share-whatsapp" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on WhatsApp"><i class="icon an an-whatsapp mx-1"></i><span class="share-title d-none">WhatsApp</span></a>
                        <a href="#" class="d-flex-center btn btn-link btn--share share-email" data-bs-toggle="tooltip" data-bs-placement="top" title="Share by Email"><i class="icon an an-envelope-l mx-1"></i><span class="share-title d-none">Email</span></a>
                    </div>
                    <!-- End Social Sharing -->
                </div>
            </div>
        </div>
        <!--End Quickview Popup-->

        <!--Addtocart Added Popup-->
        <div id="pro-addtocart-popup" class="mfp-with-anim mfp-hide">
            <button title="Close (Esc)" type="button" class="mfp-close">×</button>
            <div class="addtocart-inner text-center clearfix">
                <h4 class="title mb-3 text-success">Added to your shopping cart successfully.</h4>
                <div class="pro-img mb-3">
                    <img class="img-fluid blur-up lazyload" src="{{asset('webassets/images/products/furniture-product4.jpg')}}" data-src="{{asset('webassets/images/products/furniture-product4.jpg')}}" alt="Added to your shopping cart successfully." title="Added to your shopping cart successfully." />
                </div>
                <div class="pro-details">
                    <h5 class="pro-name body-font mb-0">Cushioned Office Chair</h5>
                    <p class="sku my-2">Color: Gray</p>
                    <p class="mb-0 qty-total">1 X $113.88</p>
                    <div class="addcart-total bg-light mt-3 mb-3 p-2">
                        Total: <b class="price">$113.88</b>
                    </div>
                    <div class="button-action">
                        <a href=""></a>
                        <a href="checkout-style1.html" class="btn btn-primary view-cart mx-1 py-2 rounded-0">Go To Checkout</a>
                        <a href="index.html" class="btn btn-outline-primary py-2 rounded-0">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Addtocart Added Popup-->


        <!-- Including Jquery -->
        <script src="{{asset('webassets/js/vendor/jquery-min.js')}}"></script>
        <script src="{{asset('webassets/js/vendor/js.cookie.js')}}"></script>
        <!--Including Javascript-->
        <script src="{{asset('webassets/js/plugins.js')}}"></script>
        <script src="{{asset('webassets/js/main.js')}}"></script>
        <script src="{{asset('assets/js/vendor/photoswipe.min.js')}}"></script>

        </script>
        <script type="text/javascript">
            function preSearch(val) {

                if (val == '') {
                    const myNode = document.getElementById("searchList");
                    while (myNode.lastElementChild) {
                        myNode.removeChild(myNode.lastElementChild);
                    }
                } else {
                    jQuery.ajax({
                        type: 'GET',
                        url: "{{url('autocomplete-search')}}?val=" + val,
                        dataType: 'JSON',
                        success: function(data) {
                            console.log(data.data);
                            const result = data.data.map(list => {
                                return `<li class="list-group-item"><a href="product_detail/${list.id}">${list.title}</a></li>`
                            }).join(' ');
                            document.querySelector('.my-search-result').innerHTML = result;
                            console.log(result);
                        }
                    }); //ajax close
                }

            }
        </script>

        <!--End Page Wrapper-->
</body>


</html>
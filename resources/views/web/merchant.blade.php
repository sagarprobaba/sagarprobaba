<?php

use App\Models\Cpr_ad_category;
use App\Models\Cpr_Add_images;
use App\Models\Cpr_follow;
use Illuminate\Support\Facades\Auth;

?>
@extends('web.layout.app')
@section('body')
<div id="page-content">
    <!--Collection Banner-->
    <div class="collection-header">
        <div class="collection-hero">
            @if(isset($cat->banner))
            <img src="{{asset('public/public/category/banner/'.$cat->banner)}}" style="width:100%">
            @else
            <img src="{{asset('webassets/images/home-img/ddd.jpeg')}}" style="width:100%">
            @endif
        </div>
    </div>
    <!--End Collection Banner-->
    <div class="flash-message">

        @if(Session::has('error'))

        <p class="alert alert-danger">{{ Session::get('error') }} <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
        @if(Session::has('success'))

        <p class="alert alert-success">{{ Session::get('success') }} <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">&times;</a></p>
        @endif

    </div>
    <div class="container">
        <div class="row">
            <!--Sidebar-->
            <div class="col-12 col-sm-12 col-md-12 col-lg-3 sidebar filterbar">

                <div class="mrchnt_lft">

                    @if(isset($user->companyLogo))
                    <img src="{{asset('public/user/'.$user->companyLogo)}}" style="width:100%">
                    @elseif(isset($user->image))

                    <img src="{{asset('public/user/'.$user->image)}}" style="width:100%">
                    @else
                    <img src="https://e2od.com/assets/images/users/avatar-3.jpg" style="width:100%">
                    @endif
                    <h5>
                        @if(isset($user->companyName))
                        {{$user->companyName}}({{$user->firstName}} {{$user->lastName}})
                        @else
                        {{$user->firstName}} {{$user->lastName}}
                        @endif

                    </h5>
                    <p> @if(isset($user->companyName))
                        Corporate User
                        @else
                        Individual User
                        @endif</p>
                    <a href="javascript:void(0)" class="btn btn-info ">Follower ({{$follower}})</a>
                    @if(isset(Auth::guard('webUser')->user()->id))
                        @if($user->id != Auth::guard('webUser')->user()->id)
                            <?php
                                $fl = Cpr_follow::where('follower_id',Auth::guard('webUser')->user()->id)->where('author_id',$user->id)->first();
                            ?>
                            @if(isset($fl))
                            <a href="{{url('unfollow/'.$user->id)}}" class="btn btn-outline-danger ">Unfollow</a>

                            @else
                            <a href="{{url('follow/'.$user->id)}}" class="btn btn-outline-primary ">Follow</a>
                            @endif
                        @endif
                    @else
                    <a href="{{url('login')}}" class="btn btn-outline-primary">Follow</a>
                    @endif

                </div>


            </div>
            <!--End Sidebar-->

            <!--Main Content-->
            <div class="col-12 col-sm-12 col-md-12 col-lg-9 main-col">
                <div class="page-title">
                    @if(isset($cat->category_name))
                    <h1>{{$cat->category_name}}</h1>
                    @endif
                </div>
                <!--Active Filters-->
                <ul class="active-filters d-flex flex-wrap align-items-center m-0 list-unstyled d-none">
                    <li><a href="#">Clear all</a></li>
                    <li><a href="#">Men <i class="an an-times-l"></i></a></li>
                    <li><a href="#">Neckalses <i class="an an-times-l"></i></a></li>
                    <li><a href="#">Accessories <i class="an an-times-l"></i></a></li>
                </ul>
                <!--End Active Filters-->
                <!--Toolbar-->
                <div class="toolbar">
                    <div class="filters-toolbar-wrapper">
                        <ul class="list-unstyled d-flex align-items-center">
                            <li class="product-count d-flex align-items-center">
                                <button type="button" class="btn btn-filter an an-slider-3 d-inline-flex d-lg-none me-2 me-sm-3"><span class="hidden">Filter</span></button>
                                <div class="filters-toolbar__item">
                                    <span class="filters-toolbar__product-count d-none d-sm-block">Showing:

                                        {{$cnt}} products
                                    </span>
                                </div>
                            </li>

                            <li class="filters-sort ms-auto ms-sm-auto">
                                <div class="filters-toolbar__item">
                                    <label for="SortBy" class="hidden">Sort by:</label>
                                    <select name="SortBy" id="SortBy" class="filters-toolbar__input filters-toolbar__input--sort">
                                        <option value="featured" selected="selected">Featured</option>
                                        <option value="best-selling">Best selling</option>
                                        <option value="title-ascending">Alphabetically, A-Z</option>
                                        <option value="title-descending">Alphabetically, Z-A</option>
                                        <option value="price-ascending">Price, low to high</option>
                                        <option value="price-descending">Price, high to low</option>
                                        <option value="created-ascending">Date, old to new</option>
                                        <option value="created-descending">Date, new to old</option>
                                    </select>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--End Toolbar-->

                <!--Product Grid-->
                <div class="grid-products grid--view-items prd-grid">
                    <div class="row">
                        @foreach($data as $data1)
                        <div class="col-6 col-sm-6 col-md-3 col-lg-3 item">
                            <!--Start Product Image-->
                            <div class="product-image">
                                <!--Start Product Image-->
                                <a href="{{url('product_detail/'.$data1->id)}}" class="product-img">
                                    <!-- image -->
                                    <?php
                                    $pic = Cpr_Add_images::where('ad_id', $data1->id)->orderBy('image_order','ASC')->first();
                                    ?>
                                    @if(isset($pic->image))
                                    <img class="primary blur-up lazyload" data-src="{{asset('public/ad/'.$pic->image)}}" src="{{asset('public/ad/'.$pic->image)}}" alt="image" title="" style="max-width: 210px;max-height: 130px;width:auto">
                                    <!-- End image -->
                                    <!-- Hover image -->
                                    <img class="hover blur-up lazyload" data-src="{{asset('public/ad/'.$pic->image)}}" src="{{asset('public/ad/'.$pic->image)}}" alt="image" title="" style="max-width: 210px;max-height: 130px;width:auto">
                                    <!-- End hover image -->
                                    @endif
                                </a>
                                <!--End Product Image-->
                                <!--<div class="product-labels"><span class="lbl on-sale">Sponsored</span></div>-->
                            </div>
                            <!--End Product Image-->
                            <!--Start Product Details-->
                            <div class="product-details text-center">
                                <!--Product Name-->
                                <div class="product-name " style="word-wrap: break-word;">
                                    <a href="javascript:void(0)">{{$data1->title}}</a>
                                </div>
                                <!--End Product Name-->
                                <!--Product Price-->
                                <div class="product-price">
                                    <span class="price">₹ &nbsp;{{$data1->price}}</span>
                                </div>
                                <!--End Product Price-->
                                <!--<div class="mrchant_wrap">-->
                                <!--    <img src="https://e2od.com/assets/images/users/avatar-3.jpg">-->
                                <!--    <div class="mrchant_info"><h5>Gajendra</h5></div>-->
                                <!--</div>-->
                            </div>
                            <!--End Product Details-->
                        </div>
                        @endforeach

                    </div>
                </div>
                <!--End Product Grid-->

                <!--Pagination Classic-->
                <hr class="clear">
                <!-- <div class="pagination">
                    <ul>
                        <li class="prev"><a href="#"><i class="icon align-middle an an-caret-left" aria-hidden="true"></i></a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">...</a></li>
                        <li><a href="#">5</a></li>
                        <li class="next"><a href="#"><i class="icon align-middle an an-caret-right" aria-hidden="true"></i></a></li>
                    </ul>
                </div> -->
                <!--End Pagination Classic-->

                <!--Collection Description-->
                <div class="collection-description mt-4 pt-2">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard reader dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen the book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                </div>
                <!--End Collection Description-->
            </div>
            <!--End Main Content-->
        </div>
    </div>
</div>
<script>
    function getAd() {
        alert();
    }
</script>
@endsection
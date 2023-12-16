<?php

use App\Models\Cpr_ad_category;
use App\Models\Cpr_ad_mapped_category;
use App\Models\Cpr_Add_images;
use App\Models\webUser;
?>
@extends('web.layout.app') @section('body')
<style>
    .btn-dark:hover {
        background-color: white !important;
        color: black !important;
    }

    .btn-success:hover {
        background-color: white !important;
        color: black !important;
    }

    .onh:hover {
        background-color: white !important;
        color: black !important;
    }

    .btn-warning:hover {
        background-color: white !important;
        color: black !important;
    }

    .video-play-btn {
        position: absolute;
        top: 87%;
        left: 40%;
        width: 40px;
        height: 40px;
        line-height: 54px;
        border: 2px solid #fff;
        text-align: center;
        margin: -25px;
        color: #fff;
        display: block;
        z-index: 10;
        font-size: 24px;
        -webkit-border-radius: 50%;
        border-radius: 50%;
    }

    .video-play-btn i {
        margin-right: -5px;
    }

    .slick-track {
        float: left !important;
    }

    .adDetails-Tab .tabs-listing ul {
        background: #eee;
        border-radius: 10px;
    }

    .adDetails-Tab .tabs-listing li a {
        margin: 0;
        padding: 7px 15px;
        font-weight: normal;
        border-radius: 10px;
        margin-right: 19px;
    }

    .adDetails-Tab .tabs-listing li.active a {
        background: #4285f4;
        color: #fff;
    }

    .adDetails-Tab .tab-content {
        border: 1px solid #eee;
        padding: 20px;
        border-top: 0;
        border-radius: 20px;
    }

    .adDetails-Tab #services .item {
        width: 100%;
        display: inline-block;
        border-radius: 20px;
        border: 1px solid #eee;
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: 2px 3px 15px #eee;
        background: #f9f9f9;
    }

    .blogpost-item {
        width: 100%;
        text-align: left;
        display: inline-block;
        border-radius: 20px;
        border: 1px solid #eee;
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: 2px 3px 15px #eee;
        background: #f9f9f9;
    }

    .text-blue {
        color: #4285f4 !important;
    }
</style>
<?php $use = webUser::find($data->user_id); ?>
<div id="page-content">
    <!--Breadcrumbs-->
    <div class="breadcrumbs-wrapper text-uppercase">
        <div class="container">
            <div class="breadcrumbs">
                <a href="{{url('/')}}" title="Back to the home page">Home</a>
                <?php
                $cats = Cpr_ad_mapped_category::where('ad_id',$data->id)->get();
        ?> @if(!empty($cats)) @foreach($cats as $cate)
                <?php
                      $catval =  Cpr_ad_category::find($cate->category_id); ?>
                @if(isset($catval)) <span>|</span><a href="{{url('adlist/'.$catval->category_slug)}}"
                    class="site-nav lvl-1 menu-title"><span class="fw-bold">{{$catval->category_name}}</span></a>
                @endif @endforeach @endif
            </div>
        </div>
    </div>
    <!--End Breadcrumbs-->

    <!--Main Content-->
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 sidebar filterbar">
                <div class="mrchnt_lft">
                    @if(isset($thumb->image))
                    <img src="{{asset('public/ad/'.$thumb?->image)}}" style="width: 100%" />
                    @else
                    <img src="https://profilebaba.com/webassets/images/merchnat-main-img.jpg" style="width: 100%" />
                    @endif
                    <h2 class="mt-2 mb-2">
                        <b>
                                            @if(isset($use->companyName)) 
                                            {{$use->companyName}}
                                            @else 
                                            {{$use->firstName}} {{$use->lastName}} 
                                            @endif
                        </b>
                    </h2>
                    <p class="mb-1">{{$data->title}}</p>
                    <div class="product-review mb-2">
                        <a class="reviewLink d-flex-center" href="#reviews">
                                        @if($revAveSeller == 5)
                                        <i class="icon an an-star"></i>
                                        <i class="icon an an-star mx-1"></i>
                                        <i class="icon an an-star"></i>
                                        <i class="icon an an-star mx-1"></i>
                                        <i class="icon an an-star"></i>
                                        @elseif($revAveSeller >= 4 && $revAveSeller < 5) <i class="icon an an-star"></i>
                                            <i class="icon an an-star mx-1"></i>
                                            <i class="icon an an-star"></i>
                                            <i class="icon an an-star mx-1"></i>
                                            <i class="icon an an-star-o"></i>
                                            @elseif($revAveSeller >= 3 && $revAveSeller < 4) <i class="icon an an-star">
                                                </i>
                                                <i class="icon an an-star mx-1"></i>
                                                <i class="icon an an-star"></i>
                                                <i class="icon an an-star-o mx-1"></i>
                                                <i class="icon an an-star-o"></i>
                                                @elseif($revAveSeller >= 2 && $revAveSeller < 3) <i
                                                    class="icon an an-star"></i>
                                                    <i class="icon an an-star mx-1"></i>
                                                    <i class="icon an an-star-o"></i>
                                                    <i class="icon an an-star-o mx-1"></i>
                                                    <i class="icon an an-star-o"></i>
                                                    @elseif($revAveSeller >= 1 && $revAveSeller < 2) <i
                                                        class="icon an an-star"></i>
                                                        <i class="icon an an-star-o mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        <i class="icon an an-star-o mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        @else
                                                        <i class="icon an an-star-o"></i>
                                                        <i class="icon an an-star-o mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        <i class="icon an an-star-o mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        @endif

                                                        <span class="spr-badge-caption ms-2">{{$revcntSeller}} Seller
                                                            Review</span></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-8 adDetails-Tab">
                <div class="tabs-listing">
                    <ul class="product-tabs list-unstyled d-flex-wrap border-bottom m-0 d-none d-md-flex">
                        <li rel="overview" class="active">
                            <a class="tablink">Overview</a>
                        </li>
                        <li rel="reviews"><a class="tablink">Reviews</a></li>
                        <li rel="services"><a class="tablink">Services</a></li>
                    </ul>
                    <div id="overview" class="tab-content">
                        <div class="product-description">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-4 mb-md-0">
                                    <h4 class="pt-2 text-uppercase mb-1">About Company</h4>
                                    <p>
                                        {{$use->about_company}}
                                    </p>
                                    <h4 class="pt-2 text-uppercase mb-1">Contact Person</h4>
                                    <p>Maruti Suzuki Arena</p>
                                    <h4 class="pt-2 text-uppercase mb-1">Type</h4>
                                    <p>Cars & Services</p>
                                    <h4 class="pt-2 text-uppercase mb-1">Address</h4>
                                    <p>
                                        {{$use->companyAddress}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="reviews" class="tab-content">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="spr-header clearfix d-flex-center justify-content-between">
                                    <div class="product-review d-flex-center me-auto">
                                       <a class="reviewLink" href="#">
                                            @if($revAveSeller == 5)
                                            <i class="icon an an-star"></i>
                                            <i class="icon an an-star mx-1"></i>
                                            <i class="icon an an-star"></i>
                                            <i class="icon an an-star mx-1"></i>
                                            <i class="icon an an-star"></i>
                                            @elseif($revAveSeller >= 4 && $revAveSeller < 5) <i class="icon an an-star">
                                                </i>
                                                <i class="icon an an-star mx-1"></i>
                                                <i class="icon an an-star"></i>
                                                <i class="icon an an-star mx-1"></i>
                                                <i class="icon an an-star-o"></i>
                                                @elseif($revAveSeller >= 3 && $revAveSeller < 4) <i
                                                    class="icon an an-star"></i>
                                                    <i class="icon an an-star mx-1"></i>
                                                    <i class="icon an an-star"></i>
                                                    <i class="icon an an-star-o mx-1"></i>
                                                    <i class="icon an an-star-o"></i>
                                                    @elseif($revAveSeller >= 2 && $revAveSeller < 3) <i
                                                        class="icon an an-star"></i>
                                                        <i class="icon an an-star mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        <i class="icon an an-star-o mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        @elseif($revAveSeller >= 1 && $revAveSeller < 2) <i
                                                            class="icon an an-star"></i>
                                                            <i class="icon an an-star-o mx-1"></i>
                                                            <i class="icon an an-star-o"></i>
                                                            <i class="icon an an-star-o mx-1"></i>
                                                            <i class="icon an an-star-o"></i>
                                                            @else
                                                            <i class="icon an an-star-o"></i>
                                                            <i class="icon an an-star-o mx-1"></i>
                                                            <i class="icon an an-star-o"></i>
                                                            <i class="icon an an-star-o mx-1"></i>
                                                            <i class="icon an an-star-o"></i>
                                                            @endif
                                        </a>
                                        <span class="spr-summary-actions-togglereviews ms-2">Based on {{$revcntSeller}}
                                            reviews</span>
                                    </div>
                                    <div class="spr-summary-actions mt-3 mt-sm-0">
                                        @if(isset(Auth::guard('webUser')->user()->id))
                                        @if(Auth::guard('webUser')->user()->id != $data->user_id)
                                        <a href="#"
                                            class="spr-summary-actions-newreview write-review-btn btn rounded" onclick="getUserDataReviewSeller({{$data->id}});"><i
                                                class="icon an-1x an an-pencil-alt me-2"></i>Write a
                                            review</a>
                                         @endif
                                         @endif
                                         
                                    </div>
                                </div>
                                <!--<form method="post" action="#" class="product-review-form new-review-form mb-4">-->
                                <!--    <h4 class="spr-form-title text-uppercase">Write A Review</h4>-->
                                <!--    <fieldset class="spr-form-contact">-->
                                <!--        <div class="spr-form-contact-name form-group">-->
                                <!--            <label class="spr-form-label" for="nickname">Name <span-->
                                <!--                    class="required">*</span></label>-->
                                <!--            <input class="spr-form-input spr-form-input-text" id="nickname" type="text"-->
                                <!--                name="name" placeholder="John smith" required />-->
                                <!--        </div>-->
                                <!--        <div class="spr-form-contact-email form-group">-->
                                <!--            <label class="spr-form-label" for="email">Email <span-->
                                <!--                    class="required">*</span></label>-->
                                <!--            <input class="spr-form-input spr-form-input-email" id="email" type="email"-->
                                <!--                name="email" placeholder="info@example.com" required />-->
                                <!--        </div>-->
                                <!--        <div class="spr-form-review-rating form-group">-->
                                <!--            <label class="spr-form-label">Rating</label>-->
                                <!--            <div class="product-review pt-1">-->
                                <!--                <div class="review-rating">-->
                                <!--                    <input type="radio" name="rating" id="rating-5" /><label-->
                                <!--                        for="rating-5"></label>-->
                                <!--                    <input type="radio" name="rating" id="rating-4" /><label-->
                                <!--                        for="rating-4"></label>-->
                                <!--                    <input type="radio" name="rating" id="rating-3" /><label-->
                                <!--                        for="rating-3"></label>-->
                                <!--                    <input type="radio" name="rating" id="rating-2" /><label-->
                                <!--                        for="rating-2"></label>-->
                                <!--                    <input type="radio" name="rating" id="rating-1" /><label-->
                                <!--                        for="rating-1"></label>-->
                                <!--                </div>-->
                                <!--                <a class="reviewLink d-none" href="#"><i-->
                                <!--                        class="icon an an-star-o"></i><i-->
                                <!--                        class="icon an an-star-o mx-1"></i><i-->
                                <!--                        class="icon an an-star-o"></i><i-->
                                <!--                        class="icon an an-star-o mx-1"></i><i-->
                                <!--                        class="icon an an-star-o"></i></a>-->
                                <!--            </div>-->
                                <!--        </div>-->
                                <!--        <div class="spr-form-review-title form-group">-->
                                <!--            <label class="spr-form-label" for="review">Review Title-->
                                <!--            </label>-->
                                <!--            <input class="spr-form-input spr-form-input-text" id="review" type="text"-->
                                <!--                name="review" placeholder="Give your review a title" />-->
                                <!--        </div>-->
                                <!--        <div class="spr-form-review-body form-group">-->
                                <!--            <label class="spr-form-label" for="message">Body of Review-->
                                <!--                <span class="spr-form-review-body-charactersremaining">(1500) characters-->
                                <!--                    remaining</span></label>-->
                                <!--            <div class="spr-form-input">-->
                                <!--                <textarea class="spr-form-input spr-form-input-textarea" id="message"-->
                                <!--                    name="message" rows="5"-->
                                <!--                    placeholder="Write your comments here"></textarea>-->
                                <!--            </div>-->
                                <!--        </div>-->
                                <!--    </fieldset>-->
                                <!--    <div class="spr-form-actions clearfix">-->
                                <!--        <input type="submit"-->
                                <!--            class="btn btn-primary rounded spr-button spr-button-primary"-->
                                <!--            value="Submit Review" />-->
                                <!--    </div>-->
                                <!--</form>-->
                                <form method="post" action="{{url('sellerreview')}}" class="product-review-form new-review-form mb-4">
                                    @csrf
                                    <h4 class="spr-form-title text-uppercase">Write A Review</h4>
                                    <fieldset class="spr-form-contact">
                                        <div class="spr-form-contact-name form-group">
                                            <label class="spr-form-label" for="nickname">Name <span
                                                    class="required">*</span></label>
                                            <input class="spr-form-input spr-form-input-text" id="nickname_seller"
                                                type="text" name="name" placeholder="John smith" required />

                                            <input type="hidden" id="review_user_id_seller" name="user_id" />
                                            <input type="hidden" name="seller_id" value="{{$data->user_id}}" />
                                        </div>
                                        <div class="spr-form-contact-email form-group">
                                            <label class="spr-form-label" for="email">Email <span
                                                    class="required">*</span></label>
                                            <input class="spr-form-input spr-form-input-email" id="reviewemail_seller"
                                                type="email" name="email" placeholder="info@example.com" required />
                                        </div>
                                        <div class="spr-form-review-rating form-group">
                                            <label class="spr-form-label">Rating</label>
                                            <div class="product-review pt-1">
                                                <div class="review-rating">
                                                    <input type="checkbox" name="rating" id="rating-seller-5"
                                                        value="5" /><label for="rating-seller-5"></label>
                                                    <input type="checkbox" name="rating" id="rating-seller-4"
                                                        value="4" /><label for="rating-seller-4"></label>
                                                    <input type="checkbox" name="rating" id="rating-seller-3"
                                                        value="3" /><label for="rating-seller-3"></label>
                                                    <input type="checkbox" name="rating" id="rating-seller-2"
                                                        value="2" /><label for="rating-seller-2"></label>
                                                    <input type="checkbox" name="rating" id="rating-seller-1"
                                                        value="1" /><label for="rating-seller-1"></label>
                                                </div>
                                                <a class="reviewLink d-none" href="#"><i
                                                        class="icon an an-star-o"></i><i
                                                        class="icon an an-star-o mx-1"></i><i
                                                        class="icon an an-star-o"></i><i
                                                        class="icon an an-star-o mx-1"></i><i
                                                        class="icon an an-star-o"></i></a>
                                            </div>
                                        </div>
                                        <div class="spr-form-review-title form-group">
                                            <label class="spr-form-label" for="review">Review Title
                                            </label>
                                            <input class="spr-form-input spr-form-input-text" id="review_seller"
                                                type="text" name="review_title"
                                                placeholder="Give your review a title" />
                                        </div>
                                        <div class="spr-form-review-body form-group">
                                            <label class="spr-form-label" for="message">Body of Review
                                                <span class="spr-form-review-body-charactersremaining">(1500) characters
                                                    remaining</span></label>
                                            <div class="spr-form-input">
                                                <textarea class="spr-form-input spr-form-input-textarea"
                                                    maxlength="1500" id="message_seller" name="review" rows="5"
                                                    placeholder="Write your comments here" required></textarea>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="spr-form-actions clearfix">
                                        <input type="submit"
                                            class="btn btn-primary rounded spr-button spr-button-primary"
                                            value="Submit Review" />
                                    </div>
                                </form>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="spr-reviews">
                                    <h4 class="spr-form-title text-uppercase mb-3">
                                        Customer Reviews
                                    </h4>
                                    <div class="review-inner">
                                        @foreach($reviewSeller as $rev)
                                        <div class="spr-review">
                                            <div class="spr-review-header">
                                                <span class="product-review spr-starratings"><span class="reviewLink">
                                                        @if($rev->rating == 5)
                                                        <i class="icon an an-star"></i>
                                                        <i class="icon an an-star mx-1"></i>
                                                        <i class="icon an an-star"></i>
                                                        <i class="icon an an-star mx-1"></i>
                                                        <i class="icon an an-star"></i>
                                                        @elseif($rev->rating == 4)
                                                        <i class="icon an an-star"></i>
                                                        <i class="icon an an-star mx-1"></i>
                                                        <i class="icon an an-star"></i>
                                                        <i class="icon an an-star mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        @elseif($rev->rating == 3)
                                                        <i class="icon an an-star"></i>
                                                        <i class="icon an an-star mx-1"></i>
                                                        <i class="icon an an-star"></i>
                                                        <i class="icon an an-star-o mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        @elseif($rev->rating == 2)
                                                        <i class="icon an an-star"></i>
                                                        <i class="icon an an-star mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        <i class="icon an an-star-o mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        @elseif($rev->rating == 1)
                                                        <i class="icon an an-star"></i>
                                                        <i class="icon an an-star-o mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        <i class="icon an an-star-o mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        @else
                                                        <i class="icon an an-star-o"></i>
                                                        <i class="icon an an-star-o mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        <i class="icon an an-star-o mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        @endif
                                                    </span></span>
                                                <h5 class="spr-review-header-title mt-1">
                                                    {{$rev->review_title}}
                                                </h5>
                                                <span class="spr-review-header-byline"><strong>{{$rev->name}}</strong>
                                                    on
                                                    <strong>{{date('M d Y H:i
                                                        A',strtotime($rev->created_at))}}</strong></span>
                                            </div>
                                            <div class="spr-review-content">
                                                <p class="spr-review-content-body">{{$rev->review}}.</p>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="services" class="tab-content">
                        <div class="grid-products grid--view-items prd-list">
                            <div class="row">
                                <div class="col-6 col-sm-6 col-md-4 col-lg-4">
                                    <div class="item">
                                        <!--Start Product Image-->
                                        <div class="product-image">
                                            <!--Start Product Image-->
                                            <a href="product-layout1.html" class="product-img">
                                                <!-- image -->
                                                <img class="primary blur-up lazyload"
                                                    data-src="https://profilebaba.com/webassets/images/car-dealer-img.jpg"
                                                    src="https://profilebaba.com/webassets/images/car-dealer-img.jpg"
                                                    alt="image" title="" />
                                                <!-- End image -->
                                            </a>
                                        </div>
                                        <!--End Product Image-->
                                        <div class="clearfix"></div>
                                        <!--Start Product Details-->
                                        <div class="product-details text-center">
                                            <!--Product Name-->
                                            <h4 class="text-uppercase mt-2">
                                                <a href="#">Car Dealer</a>
                                            </h4>
                                            <!--End Product Name-->
                                            <!--Product Price-->
                                            <div class="product-price mb-0">
                                                <span class="price">0</span>
                                            </div>
                                            <!--End Product Price-->
                                            <p class="hidden sort-desc mb-0">Car Dealer</p>
                                        </div>
                                        <!--End Product Details-->
                                    </div>
                                </div>
                                <div class="col-6 col-sm-6 col-md-4 col-lg-4">
                                    <div class="item">
                                        <!--Start Product Image-->
                                        <div class="product-image">
                                            <!--Start Product Image-->
                                            <a href="product-layout1.html" class="product-img">
                                                <!-- image -->
                                                <img class="primary blur-up lazyload"
                                                    data-src="https://profilebaba.com/webassets/images/car-dealer-img.jpg"
                                                    src="https://profilebaba.com/webassets/images/car-dealer-img.jpg"
                                                    alt="image" title="" />
                                                <!-- End image -->
                                            </a>
                                        </div>
                                        <!--End Product Image-->
                                        <div class="clearfix"></div>
                                        <!--Start Product Details-->
                                        <div class="product-details text-center">
                                            <!--Product Name-->
                                            <h4 class="text-uppercase mt-2">
                                                <a href="#">Car Dealer</a>
                                            </h4>
                                            <!--End Product Name-->
                                            <!--Product Price-->
                                            <div class="product-price mb-0">
                                                <span class="price">0</span>
                                            </div>
                                            <!--End Product Price-->
                                            <p class="hidden sort-desc mb-0">Car Dealer</p>
                                        </div>
                                        <!--End Product Details-->
                                    </div>
                                </div>
                                <div class="col-6 col-sm-6 col-md-4 col-lg-4">
                                    <div class="item">
                                        <!--Start Product Image-->
                                        <div class="product-image">
                                            <!--Start Product Image-->
                                            <a href="product-layout1.html" class="product-img">
                                                <!-- image -->
                                                <img class="primary blur-up lazyload"
                                                    data-src="https://profilebaba.com/webassets/images/car-dealer-img.jpg"
                                                    src="https://profilebaba.com/webassets/images/car-dealer-img.jpg"
                                                    alt="image" title="" />
                                                <!-- End image -->
                                            </a>
                                        </div>
                                        <!--End Product Image-->
                                        <div class="clearfix"></div>
                                        <!--Start Product Details-->
                                        <div class="product-details text-center">
                                            <!--Product Name-->
                                            <h4 class="text-uppercase mt-2">
                                                <a href="#">Car Dealer</a>
                                            </h4>
                                            <!--End Product Name-->
                                            <!--Product Price-->
                                            <div class="product-price mb-0">
                                                <span class="price">0</span>
                                            </div>
                                            <!--End Product Price-->
                                            <p class="hidden sort-desc mb-0">Car Dealer</p>
                                        </div>
                                        <!--End Product Details-->
                                    </div>
                                </div>
                                <div class="col-6 col-sm-6 col-md-4 col-lg-4">
                                    <div class="item">
                                        <!--Start Product Image-->
                                        <div class="product-image">
                                            <!--Start Product Image-->
                                            <a href="product-layout1.html" class="product-img">
                                                <!-- image -->
                                                <img class="primary blur-up lazyload"
                                                    data-src="https://profilebaba.com/webassets/images/car-dealer-img.jpg"
                                                    src="https://profilebaba.com/webassets/images/car-dealer-img.jpg"
                                                    alt="image" title="" />
                                                <!-- End image -->
                                            </a>
                                        </div>
                                        <!--End Product Image-->
                                        <div class="clearfix"></div>
                                        <!--Start Product Details-->
                                        <div class="product-details text-center">
                                            <!--Product Name-->
                                            <h4 class="text-uppercase mt-2">
                                                <a href="#">Car Dealer</a>
                                            </h4>
                                            <!--End Product Name-->
                                            <!--Product Price-->
                                            <div class="product-price mb-0">
                                                <span class="price">0</span>
                                            </div>
                                            <!--End Product Price-->
                                            <p class="hidden sort-desc mb-0">Car Dealer</p>
                                        </div>
                                        <!--End Product Details-->
                                    </div>
                                </div>
                                <div class="col-6 col-sm-6 col-md-4 col-lg-4">
                                    <div class="item">
                                        <!--Start Product Image-->
                                        <div class="product-image">
                                            <!--Start Product Image-->
                                            <a href="product-layout1.html" class="product-img">
                                                <!-- image -->
                                                <img class="primary blur-up lazyload"
                                                    data-src="https://profilebaba.com/webassets/images/car-dealer-img.jpg"
                                                    src="https://profilebaba.com/webassets/images/car-dealer-img.jpg"
                                                    alt="image" title="" />
                                                <!-- End image -->
                                            </a>
                                        </div>
                                        <!--End Product Image-->
                                        <div class="clearfix"></div>
                                        <!--Start Product Details-->
                                        <div class="product-details text-center">
                                            <!--Product Name-->
                                            <h4 class="text-uppercase mt-2">
                                                <a href="#">Car Dealer</a>
                                            </h4>
                                            <!--End Product Name-->
                                            <!--Product Price-->
                                            <div class="product-price mb-0">
                                                <span class="price">0</span>
                                            </div>
                                            <!--End Product Price-->
                                            <p class="hidden sort-desc mb-0">Car Dealer</p>
                                        </div>
                                        <!--End Product Details-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Product Content-->
            <div class="product-single" style="display: none">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="product-details-img thumb-left clearfix d-flex-wrap mb-3 mb-md-0">
                            <div class="product-thumb">
                                <div id="gallery" class="product-dec-slider-2 product-tab-left">
                                    @foreach($pics as $key => $pics)
                                    <a data-image="{{asset('public/ad/'.$pics->image)}}"
                                        data-zoom-image="{{asset('public/ad/'.$pics->image)}}"
                                        class="slick-slide slick-cloned {{$key==0?'active':''}}">
                                        <img class="blur-up lazyload" data-src="{{asset('public/ad/'.$pics->image)}}"
                                            src="{{asset('public/ad/'.$pics->image)}}" alt="product"
                                            style="width: 70px" />
                                    </a>
                                    @endforeach 
                                    @if(isset($data->video_url))
                                    <div class="wt-thum-bx overlay-wraper">
                                        <img src="{{asset('public/ad/'.$thumb?->image)}}" style="width: 70px" alt="" />
                                        <a class="mfp-video video-play-btn" href="{{$data->video_url}}">
                                            <i class="fa fa-play" style="position: relative; top: -7px"></i>
                                        </a>
                                        <div class="overlay-main bg-black opacity-07"></div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="zoompro-wrap product-zoom-right">
                                <div class="zoompro-span" style="text-align: center">
                                    <img id="" class="zoompro" src="{{asset('public/ad/'.$thumb?->image)}}"
                                        data-zoom-image="{{asset('public/ad/'.$thumb?->image)}}" alt="product"
                                        style="width: auto; height: 350px" />
                                </div>
                                <!--<div class="product-labels"><span class="lbl on-sale">Sponsored</span></div>-->
                                @if(isset(Auth::guard('webUser')->user()->id))
                                    @if(Auth::guard('webUser')->user()->id != $data->user_id)
                                    <div class="product-wish">
                                        <a class="wishIcon wishlist rounded m-0"
                                            href="{{url('addwishList/'.Auth::guard('webUser')->user()->id).'/'.$data->id}}"><i
                                                class="icon an an-heart"></i><span class="tooltip-label left">Add To
                                                Wishlist</span></a>
                                    </div>
                                    @endif 
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <!-- Product Info -->
                        <div class="product-single__meta">
                            <h1 class="product-single__title">{{$data->title}}</h1>
                            <div class="product-single__subtitle">
                                From {{$data->country}},{{$state?->name}},{{$city?->name}} Lagos
                            </div>
                            <!-- Product Reviews -->
                            <div class="product-review mb-2">
                                <a class="reviewLink d-flex-center" href="#reviews">
                                    @if($revAve == 5)
                                    <i class="icon an an-star"></i>
                                    <i class="icon an an-star mx-1"></i>
                                    <i class="icon an an-star"></i>
                                    <i class="icon an an-star mx-1"></i>
                                    <i class="icon an an-star"></i>
                                    @elseif($revAve >= 4 && $revAve < 5) <i class="icon an an-star"></i>
                                        <i class="icon an an-star mx-1"></i>
                                        <i class="icon an an-star"></i>
                                        <i class="icon an an-star mx-1"></i>
                                        <i class="icon an an-star-o"></i>
                                        @elseif($revAve >= 3 && $revAve < 4) <i class="icon an an-star"></i>
                                            <i class="icon an an-star mx-1"></i>
                                            <i class="icon an an-star"></i>
                                            <i class="icon an an-star-o mx-1"></i>
                                            <i class="icon an an-star-o"></i>
                                            @elseif($revAve >= 2 && $revAve < 3) <i class="icon an an-star"></i>
                                                <i class="icon an an-star mx-1"></i>
                                                <i class="icon an an-star-o"></i>
                                                <i class="icon an an-star-o mx-1"></i>
                                                <i class="icon an an-star-o"></i>
                                                @elseif($revAve >= 1 && $revAve < 2) <i class="icon an an-star"></i>
                                                    <i class="icon an an-star-o mx-1"></i>
                                                    <i class="icon an an-star-o"></i>
                                                    <i class="icon an an-star-o mx-1"></i>
                                                    <i class="icon an an-star-o"></i>
                                                    @else
                                                    <i class="icon an an-star-o"></i>
                                                    <i class="icon an an-star-o mx-1"></i>
                                                    <i class="icon an an-star-o"></i>
                                                    <i class="icon an an-star-o mx-1"></i>
                                                    <i class="icon an an-star-o"></i>
                                                    @endif

                                                    <span class="spr-badge-caption ms-2">{{$revcnt}} Reviews</span></a>
                            </div>
                            <!-- End Product Reviews -->
                            <!-- Product Info -->
                            <div class="product-info">
                                <p class="product-type">
                                    Seller:
                                    <span>
                                        <a href="{{url('merchant-profile/'.$data->user_id)}}">
                                            
                                            @if(isset($use->companyLogo))
                                            <img src="{{asset('public/user/'.$use->companyLogo)}}"
                                                style="width: 35px; border-radius: 15px" />
                                            @elseif(isset($use->image))
                                            <img src="{{asset('public/user/'.$use->image)}}"
                                                style="width: 35px; border-radius: 15px" />
                                            @else
                                            <img src="{{asset('assets/images/users/avatar-3.jpg')}}"
                                                style="width: 35px; border-radius: 15px" />
                                            @endif @if(isset($use->companyName)) {{$use->companyName}}
                                            @else {{$use->firstName}} {{$use->lastName}} @endif
                                        </a>
                                    </span>
                                </p>
                                <div class="product-review mb-2">
                                    <a class="reviewLink d-flex-center" href="#reviews">
                                        @if($revAveSeller == 5)
                                        <i class="icon an an-star"></i>
                                        <i class="icon an an-star mx-1"></i>
                                        <i class="icon an an-star"></i>
                                        <i class="icon an an-star mx-1"></i>
                                        <i class="icon an an-star"></i>
                                        @elseif($revAveSeller >= 4 && $revAveSeller < 5) <i class="icon an an-star"></i>
                                            <i class="icon an an-star mx-1"></i>
                                            <i class="icon an an-star"></i>
                                            <i class="icon an an-star mx-1"></i>
                                            <i class="icon an an-star-o"></i>
                                            @elseif($revAveSeller >= 3 && $revAveSeller < 4) <i class="icon an an-star">
                                                </i>
                                                <i class="icon an an-star mx-1"></i>
                                                <i class="icon an an-star"></i>
                                                <i class="icon an an-star-o mx-1"></i>
                                                <i class="icon an an-star-o"></i>
                                                @elseif($revAveSeller >= 2 && $revAveSeller < 3) <i
                                                    class="icon an an-star"></i>
                                                    <i class="icon an an-star mx-1"></i>
                                                    <i class="icon an an-star-o"></i>
                                                    <i class="icon an an-star-o mx-1"></i>
                                                    <i class="icon an an-star-o"></i>
                                                    @elseif($revAveSeller >= 1 && $revAveSeller < 2) <i
                                                        class="icon an an-star"></i>
                                                        <i class="icon an an-star-o mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        <i class="icon an an-star-o mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        @else
                                                        <i class="icon an an-star-o"></i>
                                                        <i class="icon an an-star-o mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        <i class="icon an an-star-o mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        @endif

                                                        <span class="spr-badge-caption ms-2">{{$revcntSeller}} Seller
                                                            Review</span></a>
                                </div>
                            </div>
                            <!-- End Product Info -->
                            <!-- Product Price -->
                            <div class="product-single__price pb-1">
                                <span class="visually-hidden">Regular price</span>
                                <span class="product-price__sale--single">
                                    <span
                                        class="product-price__price product-price__sale">₹&nbsp;{{$data->price}}</span>
                                </span>
                                <br />
                                @if($data->negotiable == "on")
                                <span class="product-price__sale--single">
                                    <span class="" style="color: blue">Negotiable</span>
                                </span>
                                @endif
                            </div>
                            <!-- End Product Price -->
                            <!-- Countdown -->

                            <!-- End Countdown -->
                        </div>
                        <!-- End Product Info -->
                        <!-- Product Form -->
                        <form method="post" action="#" class="product-form hidedropdown">
                            <!-- Swatches Color -->
                            <div class="swatches-image swatch clearfix swatch-0 option1" data-option-index="0"
                                style="display: none">
                                <div class="product-form__item">
                                    <label class="label d-flex">Color:<span class="required d-none">*</span><span
                                            class="slVariant ms-1 fw-bold">Red</span></label>
                                    <ul class="swatches d-flex-wrap list-unstyled clearfix">
                                        <li data-value="Green" class="swatch-element color green available active">
                                            <label class="swatchLbl rounded color xlarge green" title="Green"></label>
                                            <span class="tooltip-label top">Green</span>
                                        </li>
                                        <li data-value="Peach" class="swatch-element color peach available">
                                            <label class="swatchLbl rounded color xlarge peach" title="Peach"></label>
                                            <span class="tooltip-label top">Peach</span>
                                        </li>
                                        <li data-value="White" class="swatch-element color white available">
                                            <label class="swatchLbl rounded color xlarge white" title="White"></label>
                                            <span class="tooltip-label top">White</span>
                                        </li>
                                        <li data-value="Yellow" class="swatch-element color yellow soldout">
                                            <label class="swatchLbl rounded color xlarge yellow" title="Yellow"></label>
                                            <span class="tooltip-label top">Yellow</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- End Swatches Color -->
                            <!-- Swatches Size -->
                            <!-- <div class="swatch clearfix swatch-1 option2" data-option-index="1">
                            <div class="product-form__item">
                                <label class="label d-flex">Size:<span class="required d-none">*</span><span class="slVariant ms-1 fw-bold">S</span></label>
                                <ul class="swatches-size d-flex-center list-unstyled clearfix">
                                    <li data-value="S" class="swatch-element s available active">
                                        <label class="swatchLbl rounded medium" title="S">S</label><span class="tooltip-label">S</span>
                                    </li>
                                    <li data-value="M" class="swatch-element m available">
                                        <label class="swatchLbl rounded medium" title="M">M</label><span class="tooltip-label">M</span>
                                    </li>
                                    <li data-value="L" class="swatch-element l available">
                                        <label class="swatchLbl rounded medium" title="L">L</label><span class="tooltip-label">L</span>
                                    </li>
                                    <li data-value="XL" class="swatch-element xl available">
                                        <label class="swatchLbl rounded medium" title="XL">XL</label><span class="tooltip-label">XL</span>
                                    </li>
                                    <li data-value="XS" class="swatch-element xs soldout">
                                        <label class="swatchLbl rounded medium" title="XS">XS</label><span class="tooltip-label">XS</span>
                                    </li>

                                </ul>
                            </div>
                        </div> -->
                            <!-- End Swatches Size -->
                            <!-- Product Action -->
                            <div class="product-action w-100 clearfix">
                                <div class="product-form__item--quantity d-flex-center mb-3">
                                    <div class="qtyField d-none">
                                        <a class="qtyBtn minus" href="javascript:void(0);"><i class="icon an an-minus-r"
                                                aria-hidden="true"></i></a>
                                        <input type="text" name="quantity" value="1" class="product-form__input qty" />
                                        <a class="qtyBtn plus" href="javascript:void(0);"><i class="icon an an-plus-r"
                                                aria-hidden="true"></i></a>
                                    </div>
                                    <div class="pro-stockLbl ms-3">
                                        <span class="d-flex-center stockLbl instock"><i
                                                class="icon an an-check-cil"></i><span> In stock</span></span>
                                        <span class="d-flex-center stockLbl preorder d-none"><i
                                                class="icon an an-clock-r"></i><span> Pre-order Now</span></span>
                                        <span class="d-flex-center stockLbl outstock d-none"><i
                                                class="icon an an-times-cil"></i>
                                            <span>Sold out</span></span>
                                        <span class="d-flex-center stockLbl lowstock d-none" data-qty="15"><i
                                                class="icon an an-exclamation-cir"></i><span>
                                                Order now, Only
                                                <span class="items">10</span> left!</span></span>
                                    </div>
                                </div>
                                <div class="product-form__item--submit">
                                    <!--a href="my-account.html" name="add" class="btn rounded product-form__cart-submit"><span>Add to cart</span></a>
                                            <a href="my-account.html" name="add" class="btn rounded product-form__sold-out d-none" disabled="disabled">Sold out</a-->
                                </div>
                                <div class="product-form__item--buyit clearfix">
                                    @if(isset(Auth::guard('webUser')->user()->id))
                                    @if(Auth::guard('webUser')->user()->id != $data->user_id)

                                    <a href="javascript:void(0)" class="text-uppercase btn rounded btn-dark"
                                        id="hcontact" style="width: 30% !important" onclick="showContact()"><i
                                            class="icon an an-ruler d-none"></i>Show Contact</a>
                                    <a href="javascript:void(0)" class="text-uppercase btn rounded btn-dark d-none"
                                        id="scontact" style="width: 30% !important" onclick="hideContact()"><i
                                            class="icon an an-ruler d-none"></i>+2348033074023</a>
                                    <a href="#sizechart" class="sizelink text-uppercase btn rounded btn-dark"
                                        style="width: 31% !important" onclick="getUserData({{$data->id}});"><i
                                            class="icon an an-ruler d-none"></i>Send Your Offer</a>
                                    <a href="https://api.whatsapp.com/send?l=en&amp;text=Hi!%20I%27m%20interested%20in%20your%20Ad%20On%20IE%20Marketplace&amp;phone=2348033074023"
                                        target="_blank" class="text-uppercase btn rounded btn-dark"
                                        style="width: 35% !important"><i class="fa fa-whatsapp onh"
                                            style="color: #fff; font-size: 25px"></i>Chat With Seller</a>

                                    @endif @else
                                    <a href="#requestLogin" class="sizelink text-uppercase btn rounded btn-dark"
                                        style="width: 30% !important"><i class="icon an an-ruler d-none"></i>Show
                                        Contact</a>
                                    <a href="#requestLogin" class="sizelink text-uppercase btn rounded btn-dark"
                                        style="width: 31% !important"><i class="icon an an-ruler d-none"></i>Send Your
                                        Offer</a>
                                    <a href="#requestLogin" class="sizelink text-uppercase btn rounded btn-dark"
                                        style="width: 34% !important"><i class="fa fa-whatsapp"
                                            style="color: #fff; font-size: 25px"></i>Chat With Seller</a>
                                    @endif
                                </div>
                                <div class="agree-check customCheckbox clearfix d-none">
                                    <input id="prTearm" name="tearm" type="checkbox" value="tearm" required />
                                    <label for="prTearm">I agree with the terms and conditions</label>
                                </div>
                            </div>
                            <!-- End Product Action -->
                        </form>
                        <!-- End Product Form -->
                        <!-- Social Sharing -->
                        <div class="social-sharing d-flex-center mb-3">
                            <span class="sharing-lbl me-2">Share :</span>
                            <a href="#" class="d-flex-center btn btn-link btn--share share-facebook"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Facebook"><i
                                    class="icon an an-facebook mx-1"></i><span
                                    class="share-title d-none">Facebook</span></a>
                            <a href="#" class="d-flex-center btn btn-link btn--share share-twitter"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Tweet on Twitter"><i
                                    class="icon an an-twitter mx-1"></i><span
                                    class="share-title d-none">Tweet</span></a>
                            <a href="#" class="d-flex-center btn btn-link btn--share share-pinterest"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Pin on Pinterest"><i
                                    class="icon an an-pinterest-p mx-1"></i>
                                <span class="share-title d-none">Pin it</span></a>
                            <a href="#" class="d-flex-center btn btn-link btn--share share-linkedin"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Linkedin"><i
                                    class="icon an an-linkedin mx-1"></i><span
                                    class="share-title d-none">Linkedin</span></a>
                            <a href="#" class="d-flex-center btn btn-link btn--share share-email"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Share by Email"><i
                                    class="icon an an-envelope-l mx-1"></i><span
                                    class="share-title d-none">Email</span></a>
                        </div>
                        <!-- End Social Sharing -->
                        <div class="flash-message">
                            @if(Session::has('error'))

                            <p class="alert alert-danger">
                                {{ Session::get('error') }}
                                <a href="javascript:void(0)" class="close" data-bs-dismiss="alert"
                                    aria-label="close">&times;</a>
                            </p>
                            @endif @if(Session::has('success'))

                            <p class="alert alert-success">
                                {{ Session::get('success') }}
                                <a href="javascript:void(0)" class="close" data-bs-dismiss="alert"
                                    aria-label="close">&times;</a>
                            </p>
                            @endif
                        </div>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <!--Product Content-->
            <!--Product Tabs-->
            <div class="tabs-listing mt-2 mt-md-5" style="display: none">
                <ul class="product-tabs list-unstyled d-flex-wrap border-bottom m-0 d-none d-md-flex">
                    <li rel="description" class="active">
                        <a class="tablink">Description</a>
                    </li>
                    <li rel="reviews"><a class="tablink">Reviews</a></li>
                    <li rel="seller-reviews"><a class="tablink">Seller Reviews</a></li>
                </ul>
                <div class="tab-container">
                    <h3 class="tabs-ac-style d-md-none active" rel="description">
                        Description
                    </h3>
                    <div id="description" class="tab-content">
                        <div class="product-description">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-8 col-lg-8 mb-4 mb-md-0">
                                    <p>{{$data->description}}</p>
                                    <h4 class="pt-2 text-uppercase">Features</h4>

                                    <ul>
                                        @foreach($fill as $fill)
                                        <li>{{$fill->filter_value}}</li>
                                        @endforeach
                                    </ul>

                                    <!-- <h4 class="pt-2 text-uppercase">Delivery</h4>
                                <ul>
                                    <li>Dispatch: Within 24 Hours</li>
                                    <li>Free shipping across all products on a minimum purchase of NS50.</li>
                                    <li>International delivery time - 7-10 business days</li>
                                    <li>Cash on delivery might be available</li>
                                    <li>Easy 30 days returns and exchanges</li>
                                </ul>
                                <h4 class="pt-2 text-uppercase">Returns</h4>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                                <h4 class="pt-2 text-uppercase">Shipping</h4>
                                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage.</p> -->
                                </div>
                                <!--<div class="col-12 col-sm-12 col-md-4 col-lg-4">-->
                                <!--    <img data-src="{{asset('webassets/images/about/about-info-s3.jpg')}}" src="{{asset('webassets/images/about/about-info-s3.jpg')}}" alt="image" />-->
                                <!--</div>-->
                            </div>
                        </div>
                    </div>

                    <h3 class="tabs-ac-style d-md-none" rel="reviews">Review</h3>
                    <div id="reviews" class="tab-content">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="spr-header clearfix d-flex-center justify-content-between">
                                    <div class="product-review d-flex-center me-auto">
                                        <a class="reviewLink" href="#">
                                            @if($revAve == 5)
                                            <i class="icon an an-star"></i>
                                            <i class="icon an an-star mx-1"></i>
                                            <i class="icon an an-star"></i>
                                            <i class="icon an an-star mx-1"></i>
                                            <i class="icon an an-star"></i>
                                            @elseif($revAve >= 4 && $revAve < 5) <i class="icon an an-star"></i>
                                                <i class="icon an an-star mx-1"></i>
                                                <i class="icon an an-star"></i>
                                                <i class="icon an an-star mx-1"></i>
                                                <i class="icon an an-star-o"></i>
                                                @elseif($revAve >= 3 && $revAve < 4) <i class="icon an an-star"></i>
                                                    <i class="icon an an-star mx-1"></i>
                                                    <i class="icon an an-star"></i>
                                                    <i class="icon an an-star-o mx-1"></i>
                                                    <i class="icon an an-star-o"></i>
                                                    @elseif($revAve >= 2 && $revAve < 3) <i class="icon an an-star"></i>
                                                        <i class="icon an an-star mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        <i class="icon an an-star-o mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        @elseif($revAve >= 1 && $revAve < 2) <i class="icon an an-star">
                                                            </i>
                                                            <i class="icon an an-star-o mx-1"></i>
                                                            <i class="icon an an-star-o"></i>
                                                            <i class="icon an an-star-o mx-1"></i>
                                                            <i class="icon an an-star-o"></i>
                                                            @else
                                                            <i class="icon an an-star-o"></i>
                                                            <i class="icon an an-star-o mx-1"></i>
                                                            <i class="icon an an-star-o"></i>
                                                            <i class="icon an an-star-o mx-1"></i>
                                                            <i class="icon an an-star-o"></i>
                                                            @endif
                                        </a>
                                        <span class="spr-summary-actions-togglereviews ms-2">Based on {{$revcnt}}
                                            reviews</span>
                                    </div>
                                    <div class="spr-summary-actions mt-3 mt-sm-0">
                                        @if(isset(Auth::guard('webUser')->user()->id))
                                        @if(Auth::guard('webUser')->user()->id != $data->user_id)
                                        <a href="#" class="spr-summary-actions-newreview write-review-btn btn rounded"
                                            onclick="getUserDataReview({{$data->id}});"><i
                                                class="icon an-1x an an-pencil-alt me-2"></i>Write a
                                            review</a>
                                        @endif @endif
                                    </div>
                                </div>

                                <form method="post" action="{{url('addreview')}}"
                                    class="product-review-form new-review-form mb-4">
                                    @csrf
                                    <h4 class="spr-form-title text-uppercase">Write A Review</h4>
                                    <fieldset class="spr-form-contact">
                                        <div class="spr-form-contact-name form-group">
                                            <label class="spr-form-label" for="nickname">Name <span
                                                    class="required">*</span></label>
                                            <input class="spr-form-input spr-form-input-text" id="nickname" type="text"
                                                name="name" placeholder="John smith" required />
                                            <input type="hidden" id="reviewAdId" name="ad_id" />

                                            <input type="hidden" id="review_user_id" name="User_id" />
                                            <input type="hidden" name="ad_User_id" value="{{$data->user_id}}" />
                                        </div>
                                        <div class="spr-form-contact-email form-group">
                                            <label class="spr-form-label" for="email">Email <span
                                                    class="required">*</span></label>
                                            <input class="spr-form-input spr-form-input-email" id="reviewemail"
                                                type="email" name="email" placeholder="info@example.com" required />
                                        </div>
                                        <div class="spr-form-review-rating form-group">
                                            <label class="spr-form-label">Rating</label>
                                            <div class="product-review pt-1">
                                                <div class="review-rating">
                                                    <input type="checkbox" name="rating" id="rating-5"
                                                        value="5" /><label for="rating-5"></label>
                                                    <input type="checkbox" name="rating" id="rating-4"
                                                        value="4" /><label for="rating-4"></label>
                                                    <input type="checkbox" name="rating" id="rating-3"
                                                        value="3" /><label for="rating-3"></label>
                                                    <input type="checkbox" name="rating" id="rating-2"
                                                        value="2" /><label for="rating-2"></label>
                                                    <input type="checkbox" name="rating" id="rating-1"
                                                        value="1" /><label for="rating-1"></label>
                                                </div>
                                                <a class="reviewLink d-none" href="#"><i
                                                        class="icon an an-star-o"></i><i
                                                        class="icon an an-star-o mx-1"></i><i
                                                        class="icon an an-star-o"></i><i
                                                        class="icon an an-star-o mx-1"></i><i
                                                        class="icon an an-star-o"></i></a>
                                            </div>
                                        </div>
                                        <div class="spr-form-review-title form-group">
                                            <label class="spr-form-label" for="review">Review Title
                                            </label>
                                            <input class="spr-form-input spr-form-input-text" id="review" type="text"
                                                name="review" placeholder="Give your review a title" />
                                        </div>
                                        <div class="spr-form-review-body form-group">
                                            <label class="spr-form-label" for="message">Body of Review
                                                <span class="spr-form-review-body-charactersremaining">(1500) characters
                                                    remaining</span></label>
                                            <div class="spr-form-input">
                                                <textarea class="spr-form-input spr-form-input-textarea"
                                                    maxlength="1500" id="message" name="message" rows="5"
                                                    placeholder="Write your comments here" required></textarea>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="spr-form-actions clearfix">
                                        <input type="submit"
                                            class="btn btn-primary rounded spr-button spr-button-primary"
                                            value="Submit Review" />
                                    </div>
                                </form>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="spr-reviews">
                                    <h4 class="spr-form-title text-uppercase mb-3">
                                        Customer Reviews
                                    </h4>
                                    <div class="review-inner">
                                        @foreach($review as $rev)
                                        <div class="spr-review">
                                            <div class="spr-review-header">
                                                <span class="product-review spr-starratings"><span class="reviewLink">
                                                        @if($rev->rating == 5)
                                                        <i class="icon an an-star"></i>
                                                        <i class="icon an an-star mx-1"></i>
                                                        <i class="icon an an-star"></i>
                                                        <i class="icon an an-star mx-1"></i>
                                                        <i class="icon an an-star"></i>
                                                        @elseif($rev->rating == 4)
                                                        <i class="icon an an-star"></i>
                                                        <i class="icon an an-star mx-1"></i>
                                                        <i class="icon an an-star"></i>
                                                        <i class="icon an an-star mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        @elseif($rev->rating == 3)
                                                        <i class="icon an an-star"></i>
                                                        <i class="icon an an-star mx-1"></i>
                                                        <i class="icon an an-star"></i>
                                                        <i class="icon an an-star-o mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        @elseif($rev->rating == 2)
                                                        <i class="icon an an-star"></i>
                                                        <i class="icon an an-star mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        <i class="icon an an-star-o mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        @elseif($rev->rating == 1)
                                                        <i class="icon an an-star"></i>
                                                        <i class="icon an an-star-o mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        <i class="icon an an-star-o mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        @else
                                                        <i class="icon an an-star-o"></i>
                                                        <i class="icon an an-star-o mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        <i class="icon an an-star-o mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        @endif
                                                    </span></span>
                                                <h5 class="spr-review-header-title mt-1">
                                                    {{$rev->review_title}}
                                                </h5>
                                                <span class="spr-review-header-byline"><strong>{{$rev->name}}</strong>
                                                    on
                                                    <strong>{{date('M d Y H:i
                                                        A',strtotime($rev->created_at))}}</strong></span>
                                            </div>
                                            <div class="spr-review-content">
                                                <p class="spr-review-content-body">{{$rev->review}}.</p>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h3 class="tabs-ac-style d-md-none" rel="seller-reviews">
                        Seller-Review
                    </h3>
                    <div id="seller-reviews" class="tab-content">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="spr-header clearfix d-flex-center justify-content-between">
                                    <div class="product-review d-flex-center me-auto">
                                        <a class="reviewLink" href="#">
                                            @if($revAveSeller == 5)
                                            <i class="icon an an-star"></i>
                                            <i class="icon an an-star mx-1"></i>
                                            <i class="icon an an-star"></i>
                                            <i class="icon an an-star mx-1"></i>
                                            <i class="icon an an-star"></i>
                                            @elseif($revAveSeller >= 4 && $revAveSeller < 5) <i class="icon an an-star">
                                                </i>
                                                <i class="icon an an-star mx-1"></i>
                                                <i class="icon an an-star"></i>
                                                <i class="icon an an-star mx-1"></i>
                                                <i class="icon an an-star-o"></i>
                                                @elseif($revAveSeller >= 3 && $revAveSeller < 4) <i
                                                    class="icon an an-star"></i>
                                                    <i class="icon an an-star mx-1"></i>
                                                    <i class="icon an an-star"></i>
                                                    <i class="icon an an-star-o mx-1"></i>
                                                    <i class="icon an an-star-o"></i>
                                                    @elseif($revAveSeller >= 2 && $revAveSeller < 3) <i
                                                        class="icon an an-star"></i>
                                                        <i class="icon an an-star mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        <i class="icon an an-star-o mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        @elseif($revAveSeller >= 1 && $revAveSeller < 2) <i
                                                            class="icon an an-star"></i>
                                                            <i class="icon an an-star-o mx-1"></i>
                                                            <i class="icon an an-star-o"></i>
                                                            <i class="icon an an-star-o mx-1"></i>
                                                            <i class="icon an an-star-o"></i>
                                                            @else
                                                            <i class="icon an an-star-o"></i>
                                                            <i class="icon an an-star-o mx-1"></i>
                                                            <i class="icon an an-star-o"></i>
                                                            <i class="icon an an-star-o mx-1"></i>
                                                            <i class="icon an an-star-o"></i>
                                                            @endif
                                        </a>
                                        <span class="spr-summary-actions-togglereviews ms-2">Based on {{$revcntSeller}}
                                            reviews</span>
                                    </div>
                                    <div class="spr-summary-actions mt-3 mt-sm-0">
                                        @if(isset(Auth::guard('webUser')->user()->id))
                                        @if(Auth::guard('webUser')->user()->id != $data->user_id)
                                        <a href="#"
                                            class="spr-summary-actions-newreview write-review-btn-seller btn rounded"
                                            onclick="getUserDataReviewSeller({{$data->id}});"><i
                                                class="icon an-1x an an-pencil-alt me-2"></i>Write a
                                            review</a>
                                        @endif @endif
                                    </div>
                                </div>

                                <!--<form method="post" action="{{url('sellerreview')}}"-->
                                <!--    class="product-review-form-seller new-review-form mb-4">-->
                                <!--    @csrf-->
                                <!--    <h4 class="spr-form-title text-uppercase">Write A Review</h4>-->
                                <!--    <fieldset class="spr-form-contact">-->
                                <!--        <div class="spr-form-contact-name form-group">-->
                                <!--            <label class="spr-form-label" for="nickname">Name <span-->
                                <!--                    class="required">*</span></label>-->
                                <!--            <input class="spr-form-input spr-form-input-text" id="nickname_seller"-->
                                <!--                type="text" name="name" placeholder="John smith" required />-->

                                <!--            <input type="hidden" id="review_user_id_seller" name="user_id" />-->
                                <!--            <input type="hidden" name="seller_id" value="{{$data->user_id}}" />-->
                                <!--        </div>-->
                                <!--        <div class="spr-form-contact-email form-group">-->
                                <!--            <label class="spr-form-label" for="email">Email <span-->
                                <!--                    class="required">*</span></label>-->
                                <!--            <input class="spr-form-input spr-form-input-email" id="reviewemail_seller"-->
                                <!--                type="email" name="email" placeholder="info@example.com" required />-->
                                <!--        </div>-->
                                <!--        <div class="spr-form-review-rating form-group">-->
                                <!--            <label class="spr-form-label">Rating</label>-->
                                <!--            <div class="product-review pt-1">-->
                                <!--                <div class="review-rating">-->
                                <!--                    <input type="checkbox" name="rating" id="rating-seller-5"-->
                                <!--                        value="5" /><label for="rating-seller-5"></label>-->
                                <!--                    <input type="checkbox" name="rating" id="rating-seller-4"-->
                                <!--                        value="4" /><label for="rating-seller-4"></label>-->
                                <!--                    <input type="checkbox" name="rating" id="rating-seller-3"-->
                                <!--                        value="3" /><label for="rating-seller-3"></label>-->
                                <!--                    <input type="checkbox" name="rating" id="rating-seller-2"-->
                                <!--                        value="2" /><label for="rating-seller-2"></label>-->
                                <!--                    <input type="checkbox" name="rating" id="rating-seller-1"-->
                                <!--                        value="1" /><label for="rating-seller-1"></label>-->
                                <!--                </div>-->
                                <!--                <a class="reviewLink d-none" href="#"><i-->
                                <!--                        class="icon an an-star-o"></i><i-->
                                <!--                        class="icon an an-star-o mx-1"></i><i-->
                                <!--                        class="icon an an-star-o"></i><i-->
                                <!--                        class="icon an an-star-o mx-1"></i><i-->
                                <!--                        class="icon an an-star-o"></i></a>-->
                                <!--            </div>-->
                                <!--        </div>-->
                                <!--        <div class="spr-form-review-title form-group">-->
                                <!--            <label class="spr-form-label" for="review">Review Title-->
                                <!--            </label>-->
                                <!--            <input class="spr-form-input spr-form-input-text" id="review_seller"-->
                                <!--                type="text" name="review_title"-->
                                <!--                placeholder="Give your review a title" />-->
                                <!--        </div>-->
                                <!--        <div class="spr-form-review-body form-group">-->
                                <!--            <label class="spr-form-label" for="message">Body of Review-->
                                <!--                <span class="spr-form-review-body-charactersremaining">(1500) characters-->
                                <!--                    remaining</span></label>-->
                                <!--            <div class="spr-form-input">-->
                                <!--                <textarea class="spr-form-input spr-form-input-textarea"-->
                                <!--                    maxlength="1500" id="message_seller" name="review" rows="5"-->
                                <!--                    placeholder="Write your comments here" required></textarea>-->
                                <!--            </div>-->
                                <!--        </div>-->
                                <!--    </fieldset>-->
                                <!--    <div class="spr-form-actions clearfix">-->
                                <!--        <input type="submit"-->
                                <!--            class="btn btn-primary rounded spr-button spr-button-primary"-->
                                <!--            value="Submit Review" />-->
                                <!--    </div>-->
                                <!--</form>-->
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="spr-reviews">
                                    <h4 class="spr-form-title text-uppercase mb-3">
                                        Customer Reviews
                                    </h4>
                                    <div class="review-inner">
                                        @foreach($reviewSeller as $rev)
                                        <div class="spr-review">
                                            <div class="spr-review-header">
                                                <span class="product-review spr-starratings"><span class="reviewLink">
                                                        @if($rev->rating == 5)
                                                        <i class="icon an an-star"></i>
                                                        <i class="icon an an-star mx-1"></i>
                                                        <i class="icon an an-star"></i>
                                                        <i class="icon an an-star mx-1"></i>
                                                        <i class="icon an an-star"></i>
                                                        @elseif($rev->rating == 4)
                                                        <i class="icon an an-star"></i>
                                                        <i class="icon an an-star mx-1"></i>
                                                        <i class="icon an an-star"></i>
                                                        <i class="icon an an-star mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        @elseif($rev->rating == 3)
                                                        <i class="icon an an-star"></i>
                                                        <i class="icon an an-star mx-1"></i>
                                                        <i class="icon an an-star"></i>
                                                        <i class="icon an an-star-o mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        @elseif($rev->rating == 2)
                                                        <i class="icon an an-star"></i>
                                                        <i class="icon an an-star mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        <i class="icon an an-star-o mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        @elseif($rev->rating == 1)
                                                        <i class="icon an an-star"></i>
                                                        <i class="icon an an-star-o mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        <i class="icon an an-star-o mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        @else
                                                        <i class="icon an an-star-o"></i>
                                                        <i class="icon an an-star-o mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        <i class="icon an an-star-o mx-1"></i>
                                                        <i class="icon an an-star-o"></i>
                                                        @endif
                                                    </span></span>
                                                <h5 class="spr-review-header-title mt-1">
                                                    {{$rev->review_title}}
                                                </h5>
                                                <span class="spr-review-header-byline"><strong>{{$rev->name}}</strong>
                                                    on
                                                    <strong>{{date('M d Y H:i
                                                        A',strtotime($rev->created_at))}}</strong></span>
                                            </div>
                                            <div class="spr-review-content">
                                                <p class="spr-review-content-body">{{$rev->review}}.</p>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Product Tabs-->
        </div>
        <!--End Container-->
        <!--Product Slider-->
        <section class="section product-slider">
            <div class="container">
                <div class="section-header">
                    <h2>Similar</h2>
                </div>
                <div class="grid-products grid--view-items prd-grid">
                    <div class="productSlider grid-products">
                        <div class="item">
                            <div class="blogpost-item merchant_list">
                                <div class="post-detail">
                                    <h4 class="post-title mb-2">
                                        <a href="" tabindex="0">SHRI BALAJI MAYANK BIKE SERVICE SHOP</a>
                                    </h4>
                                    <ul class="publish-detail d-flex-center mb-0">
                                        <li class="d-flex align-items-center text-blue">
                                            Two Wheeler Repair Shop
                                        </li>
                                    </ul>
                                    <p class="exceprt">
                                        <i class="fa fa-map-marker"></i> Main Road, Near Wine Shop,
                                        Shahberi, Sec.4, Greater Noida West, Uttar Pradesh 201308
                                    </p>
                                    <a href="#" class="btn btn-primary" tabindex="0">
                                        <i class="fa fa-phone me-2"></i> Call</a>
                                    <a href="#" class="btn btn-success" tabindex="0">
                                        <i class="fa fa-whatsapp me-2"></i> Whatsapp</a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="blogpost-item merchant_list">
                                <div class="post-detail">
                                    <h4 class="post-title mb-2">
                                        <a href="" tabindex="0">SHRI BALAJI MAYANK BIKE SERVICE SHOP</a>
                                    </h4>
                                    <ul class="publish-detail d-flex-center mb-0">
                                        <li class="d-flex align-items-center text-blue">
                                            Two Wheeler Repair Shop
                                        </li>
                                    </ul>
                                    <p class="exceprt">
                                        <i class="fa fa-map-marker"></i> Main Road, Near Wine Shop,
                                        Shahberi, Sec.4, Greater Noida West, Uttar Pradesh 201308
                                    </p>
                                    <a href="#" class="btn btn-primary" tabindex="0">
                                        <i class="fa fa-phone me-2"></i> Call</a>
                                    <a href="#" class="btn btn-success" tabindex="0">
                                        <i class="fa fa-whatsapp me-2"></i> Whatsapp</a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="blogpost-item merchant_list">
                                <div class="post-detail">
                                    <h4 class="post-title mb-2">
                                        <a href="" tabindex="0">SHRI BALAJI MAYANK BIKE SERVICE SHOP</a>
                                    </h4>
                                    <ul class="publish-detail d-flex-center mb-0">
                                        <li class="d-flex align-items-center text-blue">
                                            Two Wheeler Repair Shop
                                        </li>
                                    </ul>
                                    <p class="exceprt">
                                        <i class="fa fa-map-marker"></i> Main Road, Near Wine Shop,
                                        Shahberi, Sec.4, Greater Noida West, Uttar Pradesh 201308
                                    </p>
                                    <a href="#" class="btn btn-primary" tabindex="0">
                                        <i class="fa fa-phone me-2"></i> Call</a>
                                    <a href="#" class="btn btn-success" tabindex="0">
                                        <i class="fa fa-whatsapp me-2"></i> Whatsapp</a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="blogpost-item merchant_list">
                                <div class="post-detail">
                                    <h4 class="post-title mb-2">
                                        <a href="" tabindex="0">SHRI BALAJI MAYANK BIKE SERVICE SHOP</a>
                                    </h4>
                                    <ul class="publish-detail d-flex-center mb-0">
                                        <li class="d-flex align-items-center text-blue">
                                            Two Wheeler Repair Shop
                                        </li>
                                    </ul>
                                    <p class="exceprt">
                                        <i class="fa fa-map-marker"></i> Main Road, Near Wine Shop,
                                        Shahberi, Sec.4, Greater Noida West, Uttar Pradesh 201308
                                    </p>
                                    <a href="#" class="btn btn-primary" tabindex="0">
                                        <i class="fa fa-phone me-2"></i> Call</a>
                                    <a href="#" class="btn btn-success" tabindex="0">
                                        <i class="fa fa-whatsapp me-2"></i> Whatsapp</a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="blogpost-item merchant_list">
                                <div class="post-detail">
                                    <h4 class="post-title mb-2">
                                        <a href="" tabindex="0">SHRI BALAJI MAYANK BIKE SERVICE SHOP</a>
                                    </h4>
                                    <ul class="publish-detail d-flex-center mb-0">
                                        <li class="d-flex align-items-center text-blue">
                                            Two Wheeler Repair Shop
                                        </li>
                                    </ul>
                                    <p class="exceprt">
                                        <i class="fa fa-map-marker"></i> Main Road, Near Wine Shop,
                                        Shahberi, Sec.4, Greater Noida West, Uttar Pradesh 201308
                                    </p>
                                    <a href="#" class="btn btn-primary" tabindex="0">
                                        <i class="fa fa-phone me-2"></i> Call</a>
                                    <a href="#" class="btn btn-success" tabindex="0">
                                        <i class="fa fa-whatsapp me-2"></i> Whatsapp</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Recently Viewed Products-->
        <section class="section product-slider" style="display: none">
            <div class="container">
                <div class="section-header">
                    <h2>Recently Viewed Products</h2>
                </div>
                <div class="productSlider grid-products">
                    @foreach($rece as $data2)
                    <div class="item">
                        <!--Start Product Image-->
                        <div class="product-image">
                            <!--Start Product Image-->
                            <a href="{{url('product_detail/'.$data2->id)}}" class="product-img">
                                <!--Image-->
                                <?php

                                        $pic = Cpr_Add_images::where('ad_id',$data2->id)->orderBy('image_order','ASC')->first();
                ?>
                                <img class="primary blur-up lazyload" data-src="{{asset('public/ad/'.$pic?->image)}}"
                                    src="{{asset('public/ad/'.$pic?->image)}}" alt="image" title=""
                                    style="max-width: 210px; max-height: 130px; width: auto" />
                                <!--End Image-->
                                <!--Hover Image-->
                                <img class="hover blur-up lazyload" data-src="{{asset('public/ad/'.$pic?->image)}}"
                                    src="{{asset('public/ad/'.$pic?->image)}}" alt="image" title=""
                                    style="max-width: 210px; max-height: 130px; width: auto" />
                                <!--End Hover Image-->
                            </a>
                            <!-- End Product Image -->
                        </div>
                        <!-- End Product Image -->
                        <!--Start Product Details-->
                        <div class="product-details text-left">
                            <!--Product Name-->
                            <div class="product-name product-name_fixh" style="word-wrap: break-word">
                                <h5>{{$data2->title}}</h5>
                                <a class="text-uppercase fw-normal" href="">₹&nbsp;{{$data2->price}}</a>
                            </div>
                            <?php
                                $use = webUser::find($data2->user_id); ?>
                            <div class="mrchant_wrap">
                                <a href="{{url('merchant-profile/'.$data2->user_id)}}">
                                    @if(isset($use->companyLogo))
                                    <img src="{{asset('public/user/'.$use->companyLogo)}}" />
                                    @elseif(isset($use->image))
                                    <img src="{{asset('public/user/'.$use->image)}}" />
                                    @else
                                    <img src="{{asset('assets/images/users/avatar-3.jpg')}}" />
                                    @endif
                                    <div class="mrchant_info">
                                        <h5>
                                            @if(isset($use->companyName)) {{$use->companyName}} @else
                                            {{$use->firstName}} {{$use->lastName}} @endif
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
    </div>
    <!--Size Chart-->
    <div id="sizechart" class="mfpbox mfp-with-anim mfp-hide">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <!-- Contact Form -->
                <div class="formFeilds contact-form form-vertical mt-2 mt-md-0">
                    <h1 class="text-center text-capitalize mb-4">Drop Us A Line</h1>
                    <form action="{{url('add_enquiry')}}" method="post" id="contact-form" class="contact-form">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input type="text" id="ContactFormName" name="name" class="form-control"
                                        placeholder="Name" required />
                                    <input type="hidden" id="ContactAdId" name="ad_id" />
                                    <input type="hidden" id="ContactUserId" name="User_id" />

                                    <span class="error_msg" id="name_error"></span>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input type="email" id="ContactFormEmail" name="email" class="form-control"
                                        placeholder="Email" required />
                                    <span class="error_msg" id="email_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" id="ContactFormPhone" minlength="10"
                                        maxlength="10" name="phone" pattern="[0-9\-]*" placeholder="Phone Number"
                                        required
                                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" />
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input type="text" id="ContactSubject" name="subject" class="form-control"
                                        placeholder="Your Offer" required
                                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" />
                                    <span class="error_msg" id="subject_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <textarea id="ContactFormMessage" name="message" class="form-control" rows="4"
                                        placeholder="Message"></textarea>
                                    <span class="error_msg" id="message_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group mailsendbtn mb-0 w-100">
                                    <input class="btn w-100 rounded" type="submit" name="contactus"
                                        value="Send Offer" />
                                    <div class="loading">
                                        <img class="img-fluid" src="assets/images/ajax-loader.gif" alt="loading" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="response-msg"></div>
                </div>
                <!-- End Contact Form -->
            </div>
        </div>

        <button title="Close (Esc)" type="button" class="mfp-close">×</button>
    </div>
    <div id="requestLogin" class="mfpbox mfp-with-anim mfp-hide">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <!-- Contact Form -->
                <div class="formFeilds contact-form form-vertical mt-2 mt-md-0">
                    <h1 class="text-center text-capitalize mb-4">
                        Please Login To your Account!
                    </h1>
                    <form action="{{url('add_enquiry')}}" method="post" id="contact-form" class="contact-form">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <span></span>
                            </div>
                        </div>
                    </form>
                    <div class="response-msg"></div>
                </div>
                <!-- End Contact Form -->
            </div>
        </div>

        <button title="Close (Esc)" type="button" class="mfp-close">×</button>
    </div>
    <!--End Size Chart-->
    <script>
        function getUserData(id) {
            // alert(id);
            document.getElementById("ContactAdId").value = id;
            jQuery.ajax({
                type: "GET",
                url: "{{url('getUserData')}}",
                dataType: "JSON",
                success: function (responce) {
                    document.getElementById("ContactFormName").value =
                        responce.firstName + " " + responce.lastName;
                    document.getElementById("ContactUserId").value = responce.id;
                    document.getElementById("ContactFormEmail").value = responce.email;
                    document.getElementById("ContactFormPhone").value = responce.phone;
                },
            }); //ajax close
        }
        function getUserDataReview(id) {
            document.getElementById("reviewAdId").value = id;
            jQuery.ajax({
                type: "GET",
                url: "{{url('getUserData')}}",
                dataType: "JSON",
                success: function (responce) {
                    document.getElementById("nickname").value =
                        responce.firstName + " " + responce.lastName;
                    document.getElementById("review_user_id").value = responce.id;
                    document.getElementById("reviewemail").value = responce.email;
                },
            }); //ajax close
        }
        function getUserDataReviewSeller() {
            jQuery.ajax({
                type: "GET",
                url: "{{url('getUserData')}}",
                dataType: "JSON",
                success: function (responce) {
                    document.getElementById("nickname_seller").value =
                        responce.firstName + " " + responce.lastName;
                    document.getElementById("review_user_id_seller").value = responce.id;
                    document.getElementById("reviewemail_seller").value = responce.email;
                },
            }); //ajax close
        }
        function showContact() {
            var element = document.getElementById("hcontact");
            element.classList.add("d-none");
            var element = document.getElementById("scontact");
            element.classList.remove("d-none");
        }
        function hideContact() {
            var element = document.getElementById("scontact");
            element.classList.add("d-none");
            var element = document.getElementById("hcontact");
            element.classList.remove("d-none");
        }
        window.onload = magnific_video;
        function magnific_video() {
            jQuery(".mfp-video").magnificPopup({
                type: "iframe",
            });
        }
    </script>
    @endsection
</div>
<?php

use App\Models\Cpr_ad_category;
use App\Models\Cpr_Add_images;
use App\Models\webUser;
?>
@extends('web.layout.app')
@section('body')<style>.blogpost-item {width: 100%;    display: inline-block;    border-radius: 20px;    border: 1px solid #eee;    padding: 20px;margin-bottom:30px;box-shadow: 2px 3px 15px #eee;    background: #f9f9f9;}	.text-blue{color: #4285f4 !important;}</style>
<div id="page-content ">
    <!--Collection Banner-->
   
    <!--End Collection Banner-->

    <div class="container mt-4">
        <div class="row">
            <!--Sidebar-->
            <div class="col-12 col-sm-12 col-md-12 col-lg-3 sidebar filterbar">
                <div class="closeFilter d-block d-lg-none"><i class="icon icon an an-times-r"></i></div>
                <div class="sidebar_tags">
                    <!--Categories-->
                    <div class="sidebar_widget categories filterBox filter-widget">
                        <div class="widget-title">
                            <h2 class="mb-0">Categories</h2>
                        </div>
                        <div class="widget-content filterDD">

                            <ul class="clearfix sidebar_categories mb-0">
                               @if(isset($cat->category_name))
                                <li class="lvl-1 sub-level"><a href="{{url('adlist/'.$cat->category_slug)}}">{{$cat->category_name}}</a><a href="javascript:void(0)" class="site-nav active" ></a>
                                    <ul class="sublinks" style="display: block;">
                                        <?php
                                        $sub = Cpr_ad_category::where('parent_id', $cat->id)->get();
                                        ?>
                                        @if(!empty($sub))
                                        @foreach($sub as $sub)
                                        <li class="level2 sub-level sub-sub-level"><a href="{{url('adlist/'.$sub->category_slug)}}">{{$sub->category_name}}</a><a href="javascript:void(0)" class="site-nav "></a>
                                            <ul class="sublinks mb-0">
                                                <?php
                                                $sub_sub = Cpr_ad_category::where('parent_id', $sub->id)->get();
                                                ?>
                                                @if(!empty($sub))
                                                @foreach($sub_sub as $sub_sub)
                                                <li class="level3"><a href="{{url('adlist/'.$sub_sub->category_slug)}}">{{$sub_sub->category_name}}</a><a href="javascript:void(0)" class="site-nav"></a></li>
                                                @endforeach
                                                @endif
                                            </ul>
                                        </li>
                                        @endforeach
                                        @endif

                                    </ul>
                                </li>
                                @endif

                            </ul>
                        </div>
                    </div>
                    <!--Categories-->
                    <!--Price Filter-->
                    <div class="sidebar_widget filterBox filter-widget">
                        <div class="widget-title">
                            <h2 class="mb-0">Price(₹)</h2>
                        </div>
                        <form action="#" method="post" class="price-filter filterDD">
                            <div id="slider-range" onclick="addfilter()" class="mt-2"></div>
                            <div class="row">
                                <div class="col-6">
                                    <p class="no-margin">
                                        <input id="amount" onkeyup="addfilter()" type="text" value="" style="width:160px;">
                                        <input id="catid" type="hidden" value="{{isset($cat->id)?$cat->id:''}}">
                                        <input id="maxRangeValue" type="hidden" value="{{isset($maxAmt)?$maxAmt:''}}">

                                    </p>
                                </div>

                            </div>
                        </form>
                    </div>
                    <!--End Price Filter-->

                    <!--Size Swatches-->
                    @if(isset($filter1))
                        @foreach($filter1 as $filter1)
                        <div class="sidebar_widget filterBox filter-widget size-swacthes">
                            <div class="widget-title">
                                <h2 class="mb-0">{{$filter1->filter_name}}</h2>
                            </div>
                            <div class="filterDD">
                                <ul class="clearfix">
                                    @foreach($filter1->filter_value as $val)
                                    <li><input type="checkbox" name="addfilter" onchange="addfilter();" value="{{$val->id}}" id="s{{$val->id}}"><label for="s{{$val->id}}"><span></span>{{$val->filter_value}}</label></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endforeach
                    @endif
                    <!--End Size Swatches-->

                    <!--Brand-->
                   
                    <!--End Brand-->
                    <!--Availability-->
                    <!-- <div class="sidebar_widget filterBox filter-widget size-swacthes availability">
                        <div class="widget-title">
                            <h2 class="mb-0">Availability</h2>
                        </div>
                        <div class="filterDD">
                            <ul class="clearfix">
                                <li><input type="checkbox" value="instock" id="instock"><label for="instock"><span></span>In stock</label></li>
                                <li><input type="checkbox" value="outofstock" id="outofstock"><label for="outofstock"><span></span>Out of stock</label></li>
                            </ul>
                        </div>
                    </div> -->
                    <!--End Availability-->
                    

                    <!--Banner-->
                    <div class="sidebar_widget static-banner">
                        <!-- <a href="shop-fullwidth.html"><img src="{{asset('webassets/images/shop-banner.jpg')}}" alt="image"></a> -->
                    </div>
                    <!--End Banner-->
                </div>
            </div>
            <!--End Sidebar-->

            <!--Main Content-->
            <div class="col-12 col-sm-12 col-md-12 col-lg-9 main-col">
                 <div class="collection-header">
        <div class="collection-hero">
            @if(isset($cat->banner))
            <img src="{{asset('public/public/category/banner/'.$cat->banner)}}" style="width:100%">
            @else
            <img src="{{asset('webassets/images/home-img/ddd.jpeg')}}" style="width:100%">
            @endif
        </div>
    </div>
                
                
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
                                    <span class="filters-toolbar__product-count d-none d-sm-block">Showing: <span id="count">{{$cnt}}</span> products</span>
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
                    <div class="row" id="adlist">
                 @foreach($data as $data)										
                    <div class="col-6 col-sm-6">					
                        <div class="blogpost-item merchant_list">                                                                               
                            <div class="post-detail">                                            
                                <h4 class="post-title mb-2">
                                    <a href="{{url('product_detail/'.$data->id)}}" tabindex="0">
                                                     @if(isset($data->companyName))
                                                     {{$data->companyName}}
                                                     @else
                                                     {{$data->firstName}} {{$data->lastName}}
                                                     @endif
                                    </a>
                                </h4>
                                <ul class="publish-detail d-flex-center mb-0">   
                                <li class="d-flex align-items-center text-blue">{{$data->title}}</li>  
                                </ul>                            
                                <p class="exceprt">		
                                <i class="fa fa-map-marker"></i>
                                {{$data->location}}
                                </p>                                     
                                <a href="#" class=" btn btn-primary" tabindex="0"> 
                                <i class="fa fa-phone me-2"></i> Call</a>		
                                <a href="#" class=" btn btn-success" tabindex="0"> <i class="fa fa-whatsapp me-2"></i> Whatsapp</a> 
                                <!--<a href="https://wa.me/{{$data->phone}}" class=" btn btn-success" tabindex="0" target="_blank"> <i class="fa fa-whatsapp me-2"></i> Whatsapp</a> -->
                                </div>                    
                            </div>			
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
                <div class="collection-description" style="padding-top:0px !important">
                    
                    <h4>Category Description</h4>
                        @if(isset($cat->description))
                      <p>
                        {{$cat->description}}
                     </p>
                     @endif
                     
                </div>
                <!--End Collection Description-->
            </div>
            <!--End Main Content-->
        </div>
    </div>
</div>
<script>
    function getAd()
    {
        alert();
    }
    function addfilter() {
       
      
        var checkboxes = document.getElementsByName('addfilter');
        var catid = document.getElementById('catid').value;
        var amountRange = document.getElementById('amount').value;
        var value = amountRange.split("-");

        var minRate = value[0]
        var maxRate = value[1]
        var checkboxesChecked = [];

        for (var i = 0; i < checkboxes.length; i++) {

            if (checkboxes[i].checked) {
                checkboxesChecked.push(checkboxes[i].value);
            }
        }
        console.log(checkboxesChecked);

        jQuery.ajax({

            type: 'GET',

            url: "{{url('addfilter')}}?ids=" + checkboxesChecked+"&catid="+catid+"&min="+minRate+"&max="+maxRate,

            dataType: 'JSON',

            success: function(response) {
                document.getElementById('count').innerHTML=response.cnt

                console.log(response.data);
                

                document.getElementById('adlist').innerHTML=response.data

            }

        });

    
}
</script>
@endsection
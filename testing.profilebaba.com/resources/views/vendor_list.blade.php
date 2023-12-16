@extends('layout.master')

@section('page_heading', $category->meta_title ?? '')

@section('page_title', $category->meta_title ?? '')

@section('head')

<meta name="keywords" content="{{ $category->meta_keyword ?? '' }}" />
<meta  name="description" content="{{ $category->meta_description ?? '' }}" />

@endsection
@section('container')

<main>
    </article>
    <section class="catds">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    
                    <div class="col-lg-12 col-sm-9 col-xs-9">
                        <h3 class="search_title" style="text-transform: capitalize;">{{$title}}</h3>
                        
                    </div>
                    <div class="col-sm-3 col-xs-3 filsec2">
                        <button class="filbtn2">Filter</button>
                    </div>

                    <div class="col-md-3">
                        
                        <div class="sidebar-list fxsidebar">
                            <button class="filcut2">x</button>

                            <form class="" id="filter" action="">

                                <div class="category-heading">
                                    <h2>Business category</h2>

                                    <ul>
                                        @if ($category)
                                        
                                        @php
                                        $parent_category = $category->parent ?? '';
                                        @endphp

                                        <li>
                                            <a href="{{ route('vendor_filter') }}">
                                                <i class="fa fa-angle-left" aria-hidden="true"></i> All category
                                            </a>
                                        </li>
                                        @if (!empty($parent_category))
                                            <li>
                                                <a href="{{ route('vendor_filter_type', $parent_category->slug) }}">
                                                    <i class="fa fa-angle-left" aria-hidden="true"></i> {{$parent_category->title}}
                                                </a>
                                            </li>
                                        @endif

                                        <li>
                                            <a href="{{ route('vendor_filter_type', $category->slug) }}">
                                                <i class="fa fa-angle-down " aria-hidden="true"></i> {{$category->title}}
                                            </a>
                                        </li>
                                        @endif
    
                                        @foreach($categories_filter as $category_d)
                                            <li>
                                                <a href="{{ route('vendor_filter_type', $category_d->slug) }}" class="d-block category_title">
                                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                    {{$category_d->title}}
                                                </a>
                                            </li>
                                        @endforeach

                                        <a class="redmore" href="{{ route('all_category') }}">Read More <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                    </ul>
                                   
                                </div>
                                <br>

                                {{-- <button style="padding:5px 10px;" type="button" class="btn btn-info  btn-xs filter_keyword_btn">Filter</button> --}}

                                {{-- <button style="display:none; padding:5px 10px; background: #f44a4a;" class="btn btn-info  btn-xs reset-srch-btn"><i class="fas fa-sync-alt"></i> Reset</button> --}}

                            </form>

                        </div>
                    </div>
                    <div class="col-md-9">
  


                        <div class="rightside-cate">
                            
                            <ul class="breadcrumb">
                                
                                @if ($category)
                                    @php
                                    $parent_category = $category->parent ?? '';
                                    @endphp
                                    <li>
                                        <a href="{{ route('vendor_filter') }}">All category</a>
                                    </li>
                                    @if (!empty($parent_category))
                                        <li>
                                            <a href="{{ route('vendor_filter_type', $parent_category->slug) }}">{{$parent_category->title}}</a>
                                        </li>
                                    @endif

                                    <li>
                                        <a href="{{ route('vendor_filter_type', $category->slug) }}" class="current">{{$category->title}}</a>
                                    </li>
                                @endif
                            </ul>

                            <div id="add_prodect_ajax">
                                <div class="row">
                                    @include('includes.vendor_list_loop')
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                
                                <div class="justify-content-center row">
                					<div class="text-center" id="pagination_data"> 
                						<?php 
                						$pagination_data = $category_data;
                						?>
                						@include('includes.pagination')
                					</div>
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

<script type="text/javascript">
    $(document).ready(function() {

        $(document).on('change', '.filter', function() {
            filter_data();
        });

        $(document).on('click', '#pagination_data a', function(e) {
            e.preventDefault();

            var url = $(this).attr('href');

            $.ajax({
                headers: {
                    'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                },
                url: url,
                type: 'get',
                cache: false,
                beforeSend: function() {
                    newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + "?" + url;
                    ChangeUrl('page', url);
                },
                success: function(data) {
                    filter_sussce(data)
                },
                error: function(xhr, textStatus, thrownError) {}
            });
        });

        $('#filter').submit(function(e) {
            e.preventDefault();
            filter_data();
        });

        function filter_data() {

            var form_data,
                url,
                newurl;
            form_data = $('#filter').serialize();
            form_data = form_data.replace(/[^&]+=\.?(?:&|$)/g, '');

            url = $('#filter').attr('action');

            $.ajax({
                headers: {
                    'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                },
                url: url,
                type: 'get',
                data: form_data,
                cache: false,
                beforeSend: function() {
                    newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + "?" + form_data;
                    ChangeUrl('page', newurl);
                },

                success: function(data) {

                    filter_sussce(data);
                },

                error: function(xhr, textStatus, thrownError) {}
            });
        }

        function filter_sussce(data) {

            $('.reset-srch-btn').fadeIn();

            $('#pagination_data').html(data.pagination_html);
            // $('.category_title').html(data.category_title);

            $('#add_prodect_ajax').fadeOut('slow', function() {

                $('#add_prodect_ajax').html(data.data).fadeIn('fast');

            });
        }

        $('.reset-srch-btn').on('click', function() {

            $('#filter').trigger("reset");

            var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname;
            ChangeUrl('page', newurl);

            $(this).fadeOut();

            filter_data();

            return false;
        });

        $('.filter_keyword_btn').on('click', function() {
            filter_data();
            return false;
        });

        function ChangeUrl(page, url) {
            if (typeof(history.pushState) != "undefined") {
                var obj = {
                    Page: page,
                    Url: url
                };
                history.pushState(obj, obj.Page, obj.Url);
            } else {
                alert("Browser does not support HTML5.");
            }
        }
    });
</script>

@endsection

@extends('layout.master')

@section('page_title',(new \App\Setting)->get_setting('meta_title'))

@section('head')

<meta name="keywords" content="{{ (new \App\Setting)->get_setting('meta_keyword') }}" />
<meta  name="description" content="{{ (new \App\Setting)->get_setting('meta_description') }}" />

@endsection

@section('container')
    <main>
        </article>
        <section class="catds">
            <div class="container-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="filsec2">
                                <button class="filbtn2">Filter</button>
                            </div>
                            <div class="sidebar-list fxsidebar">
                                <button class="filcut2">x</button>
                                <div class="category-heading">
                                    <h2>Categories</h2>
                                </div>
                                <ul>
                                    @php
                                        $category = \App\Category::where('parent_id', 0)->orderby('title','ASC')->take(27)->get();
                                    @endphp
                                    @foreach ($category as $value)
                                        <li><a href="{{ route('vendor_filter_type', $value->slug) }}">{{ strtoupper($value->title) }}</a>
                                        </li>
                                    @endforeach

                                </ul>
                                <a class="redmore" href="{{ route('all_category') }}">Read More <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="rightside-cate">
                                <div class="row">
                                @foreach ($category as $value_a)
                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                        <div class="product-box">
                                            <div class="blog-imgblock"> <a
                                                    href="{{ route('vendor_filter_type', $value_a->slug) }}">
                                                
                                                    @if($value_a->category_image)
                                                    <img class="img-responsive"
                                                        src="{{ asset('uploads/category/' . $value_a->category_image) }}">
                                                    @endif

                                                </a> </div>
                                            <div class="profile_content">
                                                <h5><a class="category_title category_title_ww" href="{{ route('vendor_filter_type', $value_a->slug) }}">{{ $value_a->title }}
                                                    </a></h5>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            </div>


                        </div>
                    </div>
                </div>
        </section>
    </main>

@endsection

@extends('layout.master')
@section('page_title', $page->title)
@section('page_heading', $page->title)

@section('head')
    <meta name="keywords" content="{{ $page->meta_keywords }}" />
    <meta name="description" content="{{ $page->meta_description }}" />

    <style type="text/css">
        .panel-title>a:before {
            float: right !important;
            font-family: FontAwesome;
            content: "\f068";
            padding-right: 5px;
        }

        .panel-title>a.collapsed:before {
            float: right !important;
            content: "\f067";
        }

        .panel-title>a:hover,
        .panel-title>a:active,
        .panel-title>a:focus {
            text-decoration: none;
        }

        .panel-heading {
            padding: 20px 15px;
            border-bottom: 1px solid transparent;
            border-top-right-radius: 3px;
            border-top-left-radius: 3px;
        }

        .panel {
            margin-bottom: 20px !important;
            background-color: #ffffff;
            border: 1px solid transparent;
            -webkit-box-shadow: 12px 12px 0px 0px rgba(4, 4, 4, 0.05);
            box-shadow: 12px 12px 0px 0px rgba(4, 4, 4, 0.05);
        }

        .jumbotron {
            padding-top: 30px;
            padding-bottom: 30px;
            margin-bottom: 30px;
            color: inherit;
            background-color: #00bcd4;
            text-align: center;
            color: #fff;
        }

    </style>

@endsection

@section('container')

    <section class="catds">

       
        <div class="container about_wrapper">

            @if ($page->slug == 'about-us')

            <div class="container">
                <div class="row">
                    <div class="col-md-3 about_wrapper_left">
                    <img src="/uploads/media/1629118821_Kuldeep Lohchab 1.jpg" alt="Kuldeep Lohchab" title="Kuldeep Lohchab" />
                    </div>
                    <div class="col-md-9 about_wrapper_right">
                        <h2>Welcome to Our Company Profile Baba</h2>
                        <p>profilebaba.com is an endeavor to revolutionize the information search, exploration and navigation in India. It provides an extensive and comprehensive database of profiles of millions of individuals, companies and organizations. profilebaba.com is an ambitious effort in a way that it aims at bringing together a plethora of information, services, products, and many more facets of life under one umbrella, on one platform. The target is to make Internet and its resources available for all. For this purpose we have set up Local service hubs for those who have no direct access to Internet.
            The database is most comprehensive and protected by restricted entry, allowed only by user id and password. You can get detailed information on any and all topics such as job opportunities, travel, education, individuals, companies, organizations and more. Once you have enough information of the world around, now you’ll like to avail services like Astrology, job-hunting, matrimonial, discussion forums, and more. You can buy products ranging from anything to everything. profilebaba.com provide most refreshing data to our visitors.

            .</p>
                    </div>
                </div>
                <div class="row mt-50">
                    <div class="col-md-12 about_wrapper_right">
                        <h2>Our Mission</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type
                            specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                        <p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    </div>
                </div>
                <div class="row mt-50">
                    <div class="col-md-12 about_wrapper_right">
                        <h2>Our Vision</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type
                            specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                        <p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    </div>
                </div>
            </div>

            @elseif($page->slug == 'faq')

                @include('faq')

            @else
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 about_wrapper_right">
                            <h2>{{ $page->heading }}</h2>
                            {!! $page->content() !!}
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </section>

@endsection
{{-- add js section --}}
@section('javascript')

@endsection

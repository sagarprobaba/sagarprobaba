@extends('layout.master')


@section('page_title','Profile')
@section('page_heading','Profile')

@section('head')

@endsection

@section('container')

<section class="profile-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="tabbable tabs-left">
                    
                    @include('user.business.business_side_bar')

                    <div class="tab-content">

                        <div class="tab-pane active" id="prof4">
                            <div class="profile-data">
                                Business Keywords
                                For business keywords that you no longer wish to be listed in simply click on
                                cross next to the keyword and when you are done, Click "Save"
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
{{-- add js section  --}}
@section('javascript')

@endsection
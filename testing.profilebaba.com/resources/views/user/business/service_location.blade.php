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

                        <div class="tab-pane active" id="prof3">

                            @if(Session::has('message'))
                            <div class="alert alert-success">
                                {{ Session::get('message') }}
                            </div>
                            @endif

                            @if (Session::has('errors'))
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                {{ $error }}<br />
                                @endforeach
                            </div>
                            @endif
                            
                            {!! Form::model(['route' => ['user.service_location_save'],'method' => 'post', 'novalidate' => 'novalidate', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'id' => 'user_register']) !!}
                            @include('user.business.form.service_location')
                                
                            {!! Form::close() !!}

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
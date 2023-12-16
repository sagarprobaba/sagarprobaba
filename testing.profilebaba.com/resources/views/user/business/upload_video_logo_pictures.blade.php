@extends('layout.master')


@section('page_title','Profile')
@section('page_heading','Profile')

@section('head')
<link href="{{ asset('public/dropzone/css/dropzone.css') }}" rel="stylesheet"/>

@endsection

@section('container')

<section class="profile-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="tabbable tabs-left">

                    @include('user.business.business_side_bar')

                    <div class="tab-content">

                        <div class="tab-pane active" id="prof5">

                            <div class="profile-data">

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

                                <h4 class="bsheading mr0">Upload Files</h4>

                                {!! Form::model($data, ['route' => ['user.business_upload_video_save'],'method' => 'post', 'novalidate' => 'novalidate', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'id' => 'user_register']) !!}

                                @include('user.business.form.upload_video_logo_pictures')

                                {!! Form::close() !!}

                                <h4 class="bsheading mr0">Image upload</h4>
                                @php
                                    $upload_video_logopicture_size = \App\VendorImages::where('vendor_id',$vendor)->where('type','file')->sum('size');
                                    $upload_video_logopicture_size = number_format($upload_video_logopicture_size / 1048576,2);
                                @endphp
                                <p>
                                    Maximum file size allowed for upload: 5 MB
                                </p>
                                <p>Upload total file size: {{ $upload_video_logopicture_size }} MB</p>
                                <p>Total file size space: {{ 5-$upload_video_logopicture_size }} MB</p>
                                <div class="row">
                                    <div class="col-md-12">
                                    </div>
                                    <div class="col-md-12">

                                        @foreach (\App\VendorImages::where('vendor_id',$vendor)->where('type','file')->groupBy('file')->get(); as $file)
                                        <div style="width: 25%;padding: 5px;border: 1px solid #040404;border-radius: 5px;margin-top: 15px; display: inline-block;">
                                            @php
                                                $extension = pathinfo($file->file, PATHINFO_EXTENSION);
                                            @endphp

                                            @if (in_array($extension, ['MP4', 'mp4', 'MOV' ,'mov' ,'WMV' ,'wmv', 'FLV', 'flv', 'WebM', 'wedm']))
                                                <video width="320" height="240" controls style="width: 100%">
                                                    <source src="{{ CustomValue::filecheck($file->file ?? '','/uploads/users/')}}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            @else
                                                <img src="{{ CustomValue::filecheck($file->file,'/uploads/users/') }}" alt="img04" style="width: 100%; display: inline-block;">
                                            @endif

                                            <a style="text-align: center;display: block;background: #c14444;color: #fff;padding: 7px;" href="{{ route('user.upload_video_delete',$file->id) }}">Delete</a>
                                        </div>
                                        @endforeach

                                    </div>
                                </div>

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
<script src="{{ asset('public/dropzone/dropzone.js') }}"></script>
<script>
     Dropzone.options.myAwesomeDropzone = {
        init: function() {
            this.on("error", function(file, response) {
                // do stuff here.
                // alert(response);

            });
        }
    };
</script>
@endsection

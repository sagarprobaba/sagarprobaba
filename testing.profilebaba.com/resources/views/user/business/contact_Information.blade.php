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

                        <div class="tab-pane active" id="prof2">
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

                                {!! Form::open(['route' => ['user.business_contact_save'],'method' => 'post', 'novalidate' => 'novalidate', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'id' => 'user_register']) !!}

							    @include('user.business.form.contact_Information')

                                {!! Form::close() !!}

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
<script>

    $(document).ready(function() {
        var val = $('.select_state').attr('select_val')
        select_city(val);
    });
     // select_country
     $('.select_country').change(function() {

        var val = $(this).val();
        select_state(val);
    });
    // select_country end

    // select_state
    $('.select_state').change(function() {

        var val = $(this).val();
        select_city(val);
    });
    // select_state end

    function select_state(val) {
        $('.select_state').empty();
        if (val === "") {
            val = '';
        }
        var select_state = $('.select_state').attr('select_val');
        var qs = "country_id=" + val;
        $.ajax({
            url: "{{url('/getstate')}}",
            type: "GET",
            data: qs,
            success: function(output) {
                var options = "<option value=''>Select State</option>";
                output.forEach(function(val,i){
                    options+="<option value='"+val.id+"'>"+val.name+"</option>";
                })
                $('.select_state').html(options);
                $('.select_state option').each(function() {
                    if ($(this).val() == select_state) {
                        $(this).prop('selected', true);
                    }
                });
            }
        });
    }

    function select_city(val) {
        $('.select_city').empty();
        if (val === "") {
            val = null;
        }
        var select_city = $('.select_city').attr('select_val');
        var qc = "state_id=" + val;

        $.ajax({
            url: "{{url('/getcity')}}",
            type: "GET",
            data: qc,
            success: function(output) {
                var options = "<option value=''>Select City</option>";
                output.forEach(function(val,i){
                    options+="<option value='"+val.id+"'>"+val.name+"</option>";
                })
                $('.select_city').html(options);

                $('.select_city option').each(function() {
                    if ($(this).val() == select_city) {
                        $(this).prop('selected', true);
                    }
                });
            }
        });
    }
</script>
@endsection

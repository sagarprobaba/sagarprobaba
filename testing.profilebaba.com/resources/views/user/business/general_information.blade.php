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
                        <div class="tab-pane active" id="prof1">
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

                                {!! Form::open(['route' => ['user.general_information_save'],'method' => 'post', 'novalidate' => 'novalidate', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'id' => 'user_register']) !!}

							    @include('user.business.form.general_information')

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
        $('#all_category_child').select2({
            placeholder: "Select Sub Category",
            allowClear: true,
            tags: true,
            tokenSeparators: [',', ' ']
        });

        var cat_id =  $('#all_category_prant').val();
        var selected_id = $('#all_category_child').attr('selected_id');
        selected_id = JSON.parse(selected_id);
        get_subcategory(selected_id,cat_id);

        $('#all_category_prant').on('change',function(e){
            var cat_id = e.target.value;
            var selected_id = $('#all_category_child').attr('selected_id');
            selected_id = JSON.parse(selected_id);
            get_subcategory(selected_id,cat_id);
        });
    });

    function get_subcategory(selected_id, cat_id){
        $.ajax({
                url: "{{route('get_category')}}",
                type: "GET",
                data: {
                    'parent_id': cat_id,
                },
                success: function(output){
                    if(output){
                        var text = "<option value=''>Select Sub Category</option>";
                        output.forEach( function(item,i) {
                            var select = (selected_id != null) ? (selected_id.indexOf(item.id) > -1 ? 'selected' : '') : '';
                            text+="<option value='"+item.id+"' "+select+">"+item.title+"</option>";
                        })
                        $('#all_category_child').html(text);
                    }
                }
            });
    }

</script>
@endsection

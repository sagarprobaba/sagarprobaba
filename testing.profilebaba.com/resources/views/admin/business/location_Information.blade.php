@extends('admin.layout.master')
@section('page_title','Area')
@section('page_heading','Area')
@section('add_link',url('/admin/region/create'))
@section('container')
@if(Session::has('message'))
<div class="alert alert-success">
	{{ Session::get('message') }}
</div>
@endif

@if (Session::has('errors'))
<div class="alert alert-danger">
	@foreach ($errors->all() as $error)
	{{ $error }}<br/>
	@endforeach
</div>
@endif

@include('admin.business.business_side_bar')
                          
{!! Form::open(['route' => ['admin.user.business_location_save',['userid'=>$userid ?? $data->user_id,'id'=>$data->id??0]],'method' => 'post', 'novalidate' => 'novalidate', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'id' => 'user_register']) !!}

@include('user.business.form.general_information')
	
{!! Form::close() !!}
@endsection

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
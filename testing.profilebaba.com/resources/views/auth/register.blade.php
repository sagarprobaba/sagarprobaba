@extends('layout.master')

@section('page_title', 'Profile baba')
@section('page_heading', 'Profile baba')
@section('head')

@endsection
@section('container')
   
    <section class="free-list-form2">
        <div class="container">
            {!! Form::open(['route' => ['register_save'],'method' => 'post', 'novalidate' => 'novalidate', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'id' => 'user_register']) !!}
                <div class="list-form2-inner form-3">
                    <div class="heading mb--42">
                        <h2>Personal Detail</h2>
                        <hr class="delimeter">
                        <div class="user_register_msg"></div>
                    </div>

                    @include('auth.register_form')
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group sbtn5" style="text-align: center;">
                                <button type="submit" class="btn btn-shape-round form__submit">SAVE</button>
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </section>
@endsection
{{-- add js section --}}
@section('javascript')
<script>
    var frm = $('#user_register');
	frm.submit(function (e) {
		e.preventDefault();
		var formdata = $(this).serialize();
		var href = $(this).attr('action');
		$.ajax({
			headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
			url: href,
			type: 'POST',
			cache: false,
			data: formdata,
			datatype: 'Json',
			beforeSend: function() {
                $('#user_register').find('button').prop('disabled', true);
                $('.user_register_msg').html('<div class="alert alert-success">Processing...</div>');
			},
			success: function(data) {
				if(data.status==1){
					$('.user_register_msg').html('<div class="alert alert-success">'+data.msg+'</div>');
				}else if (data.status==2) {
					$('.user_register_msg').html('<div class="alert alert-danger">'+data.msg+'</div>');
				}else{
					$('.user_register_msg').text('Some error in registration !');
				}

                $('#user_register').find('button').prop('disabled', false);

                // Simulate a mouse click:
                window.location.href = "/verify-otp/"+data.user;
			},
			error: function(xhr,textStatus,thrownError) {
				$('.error').remove();
				$.each(xhr.responseJSON.errors, function( index, value ) {
					$('#user_register').find( "input[name="+index+"],select[name="+index+"],textarea[name="+index+"],select[name='"+index+"[]']").after( "<span id='' class='text-danger error'>"+ value +"</span>" );
				});
				if (xhr.status == 401){
				}
                $('#user_register').find('button').prop('disabled', false);
				$('.user_register_msg').html('');


			}
		});
	});
</script>
@endsection
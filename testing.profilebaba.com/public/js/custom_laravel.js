$(document).ready(function() {
    $.validate({
        ignore: [],
        form: '#login_pop',
        onSuccess: login_pop_submit,
        validateHiddenInputs: true,
    });
    function login_pop_submit() {
        var data = $('#login_pop').serialize();
        //$('.login_pop_submit_btn').prop('disabled',true);
        var action = $('#login_pop').attr('action');
        var redirect_after_login = $('#login_pop').attr('data-redirect_after_login');
        $.ajax({
            url: action,
            type: 'POST',
            data: data,
            success: function(output) {
                if (output == 1) {
                    $('.login_pop_msg').html('<div class="alert alert-success">Successfully Loggedin !</div>');
                    //$('.login_pop_submit_btn').prop('disabled',false);
                    //$('#talk_to_lawyer').fadeOut('slow');
                    // $('#login_pop').trigger("reset");

                    window.location.href = redirect_after_login;
                } else {
                    $('.login_pop_msg').html('<div class="alert alert-danger">Invalid login details !</div>');
                }

            }

        });
        return false;
    }

    $.validate({
        ignore: [],
        form: '#register_pop',
        onSuccess: register_pop_submit,
        validateHiddenInputs: true,
    });

    function register_pop_submit() {
        var data = $('#register_pop').serialize();
        var action = $('#register_pop').attr('action');
        var redirect_after_login = $('#register_pop').attr('data-redirect_after_register');
        $.ajax({
            headers: {
                'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
            },
            url: action,
            type: 'POST',
            data: data,
            success: function(output) {
                // $('.register_pop_submit_btn').prop('disabled',false);
                //alert(output);
                var status = output.status;
                var msg = output.msg;

                if (status == 1) {
                    $('.register_pop_msg').html('<div class="alert alert-success">' + msg + '</div>');
                    //$('#register_pop').fadeOut('slow');
                    $('#register_pop').trigger("reset");
                    window.location.href = redirect_after_login;
                } else if (status == 2) {
                    $.each(msg, function(key, value) {
                        $('.register_pop_msg').html('<div class="alert alert-danger">' + value + '</div>');
                    });
                } else {
                    $('.register_pop_msg').html('<div class="alert alert-danger">' + msg + '</div>');
                }
            }
        });
        return false;
    }

    $.validate({
        ignore: [],
        form: '#ari_register_pop',
        onSuccess: ari_register_pop_submit,
        validateHiddenInputs: true,
    });

    function ari_register_pop_submit() {
        var data = $('#ari_register_pop').serialize();
        var action = $('#ari_register_pop').attr('action');
        var redirect_after_login = $('#ari_register_pop').attr('data-redirect_after_register');
        $.ajax({
            headers: {
                'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
            },
            url: action,
            type: 'POST',
            data: data,
            success: function(output) {
                // $('.ari_register_pop_submit_btn').prop('disabled',false);
                //alert(output);
                var status = output.status;
                var msg = output.msg;

                if (status == 1) {
                    $('.ari_register_pop_msg').html('<div class="alert alert-success">' + msg + '</div>');
                    //$('#ari_register_pop').fadeOut('slow');
                    $('#ari_register_pop').trigger("reset");
                    window.location.href = redirect_after_login;
                } else if (status == 2) {
                    $.each(msg, function(key, value) {
                        $('.register_pop_msg').html('<div class="alert alert-danger">' + value + '</div>');
                    });
                } else {
                    $('.register_pop_msg').html('<div class="alert alert-danger">' + msg + '</div>');
                }
            }
        });
        return false;
    }

    $('.enquiry-btn').click(function(){
        $('#enquiry_now_vendor_id').val($(this).attr('vendor-id'))
        $('.enquiry-form-sec').fadeIn();
        $('body').addClass('open');
    });

    $('.close-btn').click(function(){
        $('.enquiry-form-sec').fadeOut();
        $('body').removeClass('open');
    });

    $.validate({
        ignore: [],
        form: '#enquiry_now_pop',
        onSuccess: enquiry_now_pop,
        validateHiddenInputs: true,
    });
    function enquiry_now_pop() {
        var data = $('#enquiry_now_pop').serialize();
        var action = $('#enquiry_now_pop').attr('action');

        $('#enquiry_now_pop').find('button').prop('disabled', true);
        $('.enquiry_now_pop_msg').html('<div class="alert alert-success">Processing...</div>');

        $.ajax({
            url: action,
            type: 'POST',
            data: data,
            success: function(output){
                if (output == 1) {
                    $('.enquiry_now_pop_msg').html('<div class="alert alert-success">Thanks for inquiring with us. Profilebaba team get in touch with you shortly.</div>');
                    $('#enquiry_now_pop').trigger("reset");
                } else {
                    $('.enquiry_now_pop_msg').html('<div class="alert alert-danger">Invalid Enquiry details !</div>');
                }

                $('#enquiry_now_pop').find('button').prop('disabled', false);

            },
            error: function(xhr,textStatus,thrownError) {
				$('.error').remove();
				$.each(xhr.responseJSON.errors, function( index, value ) {
					$('#enquiry_now_pop').find( "input[name="+index+"],select[name="+index+"],textarea[name="+index+"],select[name='"+index+"[]']").after( "<span class='text-danger error help-block form-error'>"+ value +"</span>" );
				});
				if (xhr.status == 401){
				}

                $('#enquiry_now_pop').find('button').prop('disabled', false);
                $('.enquiry_now_pop_msg').html('');

			}
        });
        return false;
    }

    $.validate({
        ignore: [],
        form: '#contact_us_pop',
        onSuccess: contact_us_pop,
        validateHiddenInputs: true,
    });
    function contact_us_pop() {
        var data = $('#contact_us_pop').serialize();
        var action = $('#contact_us_pop').attr('action');

        $('#contact_us_pop').find('button').prop('disabled', true);
        $('.contact_us_pop_msg').html('<div class="alert alert-success">Processing...</div>');

        $.ajax({
            url: action,
            type: 'POST',
            data: data,
            success: function(output){
                if (output == 1) {
                    $('.contact_us_pop_msg').html('<div class="alert alert-success">Send a  Contact us form done !</div>');
                    $('#contact_us_pop').trigger("reset");
                } else {
                    $('.contact_us_pop_msg').html('<div class="alert alert-danger">Invalid details !</div>');
                }
                
                $('#contact_us_pop').find('button').prop('disabled', false);

            },
            error: function(xhr,textStatus,thrownError) {
				$('.error').remove();
				$.each(xhr.responseJSON.errors, function( index, value ) {
					$('#contact_us_pop').find( "input[name="+index+"],select[name="+index+"],textarea[name="+index+"],select[name='"+index+"[]']").after( "<span class='text-danger error help-block form-error'>"+ value +"</span>" );
				});
				if (xhr.status == 401){
				}

                $('#contact_us_pop').find('button').prop('disabled', false);
                $('.contact_us_pop_msg').html('');


			}
        });
        return false;
    }

    $.validate({
        ignore: [],
        form: '#booking_now_pop',
        // onSuccess: booking_now_pop,
        validateHiddenInputs: true,
    });
    function booking_now_pop() {
        var data = $('#booking_now_pop').serialize();
        var action = $('#booking_now_pop').attr('action');
        var redirect_after_login = $('#booking_now_pop').attr('data-redirect_after_booking');

        $.ajax({
            url: action,
            type: 'POST',
            data: data,
            success: function(output){
                if (output == 1) {
                    $('.booking_now_pop_msg').html('<div class="alert alert-success">Send a  Contact us form done !</div>');
                    $('#booking_now_pop').trigger("reset");
                    window.location.href = redirect_after_login;
                } else {
                    $('.contact_us_pop_msg').html('<div class="alert alert-danger">Invalid details !</div>');
                }
            }
        });
        return false;
    }

    $.validate({
        ignore: [],
        form: '#review',
        onSuccess: review_submit,
        validateHiddenInputs: true,
    });

    function review_submit() {
        var data = $('#review').serialize();
        $('.submit_review').prop('disabled', true);
        var action = $('#review').attr('action');
        $.ajax({
            url: action,
            type: 'POST',
            data: data,
            success: function(output) {
                if(output == 1) {
                    $('.review_msg').html('<div class="alert alert-success">Thanks for your review.</div>');
                    $('.submit_review').prop('disabled', false);
                    $('#review').trigger("reset");
                    // $('#review').fadeOut('slow');
                }
                if (output == 2) {
                    $('.review_msg').html('<div class="alert alert-danger">Your review is already exist.</div>');
                    $('.submit_review').prop('disabled', false);
                }
            }
        });
        return false;
    }
});
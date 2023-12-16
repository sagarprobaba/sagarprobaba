@if ($message = Session::get('success'))
<input type="hidden" class='success-messages' value='{{ $message }}' />
  <script>
    $(document).ready(function() {
      let successMessages = $('.success-messages').val();
      $.toast({
        heading: 'Success',
        text: successMessages,
        position: 'top-right',
        loaderBg: '#3246D3',
        icon: 'success',
        hideAfter: 4000,
        stack: 6
      });
    });
  </script>
@endif
@if ($errors->any())
  <input type="hidden" class='error-messages' value='{{ implode(",\n", $errors->all()) }}' />
  <script>
    $(document).ready(function() {
      let errorMessages = $('.error-messages').val();
      $.toast({
        heading: 'Error',
        text: errorMessages,
        position: 'top-right',
        loaderBg: '#00D0FF',
        icon: 'info',
        hideAfter: 5000,
        stack: 6
      });
    });
  </script>
@endif

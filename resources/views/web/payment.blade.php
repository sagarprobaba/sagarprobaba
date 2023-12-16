@extends('web.layout.app')
@section('body')
<div id="page-content">
    <div class="container">
        <div class="login-register pt-2 pt-lg-5 ">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 mb-4 offset-md-2 offset-lg-2 mb-md-0">
                    <div class="inner">
                        <form id="paymentForm">

                            <div class="form-group">

                                <label for="email">Email Address</label>

                                <input type="email" id="email-address" required  value="{{$user->email}}"/>
                                <input type="hidden" id="plan" required  value="{{$plan}}"/>

                            </div>

                            <div class="form-group">

                                <label for="amount">Amount</label>

                                <input type="text" id="amounts" value="{{$amount}}" required  readonly/>

                            </div>

                            <div class="form-group">

                                <label for="first-name">First Name</label>

                                <input type="text" id="first-name" value="{{$user->firstName}}" />

                            </div>

                            <div class="form-group">

                                <label for="last-name">Last Name</label>

                                <input type="text" id="last-name" value="{{$user->lastName}}"/>

                            </div>

                            <div class="form-submit text-center">

                                <button type="submit" class="btn btn-dark " onclick="payWithPaystack(event)"> Pay </button>
                                <button type="button" class="btn btn-primary"> Cancel </button>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
    const paymentForm = document.getElementById('paymentForm');

    paymentForm.addEventListener("submit", payWithPaystack, false);

    function payWithPaystack(e) {
        console.log('form', e);
        e.preventDefault();


        let handler = PaystackPop.setup({

            key: 'pk_test_32a2a441c7cfab936537916b9fc3c427c4f921d7', // Replace with your public key

            email: document.getElementById("email-address").value,

            amount: document.getElementById("amounts").value * 100,

            ref: '' + Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you

            // label: "Optional string that replaces customer email"

            onClose: function() {

                alert('Window closed.');

            },

            callback: function(response) {

                console.log(response);
                let message = 'Payment complete! Reference: ' + response.reference;
                let plan =  document.getElementById("plan").value
                $.ajax({

                    url: "{{url('paymentVerify')}}?reference=" + response.reference + "&plan="+plan,

                    method: 'get',

                    success: function(res) {
                            console.log(res);
                            if(res[0].status == true)
                            {
                                alert('Payment Verify Successfully');
                                window.location = "{{route('userdashboard')}}";
                            }
                            else
                            {
                                alert('Payment Failed');
                            }
                        // the transaction status is in response.data.status

                    }

                });

            }

        });


        handler.openIframe();

    }
</script>
@endsection
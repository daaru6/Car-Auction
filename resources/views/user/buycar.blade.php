@include('user.header', ['title' => $data['title']])

@include('user.menu')
<style>
    .hide {
        display: none;
    }
</style>
<div class="main-content">

    <div class="page-content">

        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">

                <div class="col-12">

                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                        <h4 class="mb-sm-0 font-size-18">Payment</h4>

                        <div class="page-title-right">

                            <ol class="breadcrumb m-0">

                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>

                                <li class="breadcrumb-item active">Buy Car</li>

                            </ol>

                        </div>

                    </div>

                </div>

            </div>
            <!-- end page title -->




            <div class="alert alert-info alert-top-border alert-dismissible fade show mb-1" role="alert">

                <p><strong>Card No :</strong> 4242424242424242</p>

                <p><strong>Month :</strong> Any Future Month</p>

                <p><strong>Year :</strong> Any Future Year</p>

                <p><strong>CVC :</strong> 123</p>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>

            <div class="row">

                <div class="col-md-12 ">

                    @if (Session::has('success'))

                        <div class="alert alert-success text-center">

                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>

                            <p>{{ Session::get('success') }}</p>

                        </div>

                    @endif

                    <form role="form" action="" method="POST" class="require-validation"

                        data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">

                        @csrf

                        <div class="form-group">

                            <label for="fullname">Full Name</label>

                            <input type="text" class="form-control" readonly value="{{ auth()->user()->name }}"

                                id="fullname" placeholder="Enter full name">

                        </div>

                        <div class='form-row row'>

                            <div class='col-xs-12 form-group required'>

                                <label class='control-label'>Name on Card</label> <input class='form-control'

                                    size='4' type='text'>

                            </div>

                        </div>

                        <div class='form-row row'>

                            <div class='col-xs-12 form-group card required'>

                                <label class='control-label'>Card Number</label>

                                <input autocomplete='off' class='form-control card-number' size='20'

                                    type='tel'>

                            </div>

                        </div>

                        <div class='form-row row'>

                            <div class='col-xs-12 col-md-4 form-group cvc required'>

                                <label class='control-label'>CVC</label>

                                <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311'

                                    size='4' type='number' min='100' max='999'>


                            </div>

                            <div class='col-xs-12 col-md-4 form-group expiration required'>

                                <label class='control-label'>Expiration Month</label>

                                <input class='form-control card-expiry-month' placeholder='MM' size='2'

                                    type='number' min='1' max='12'>


                            </div>

                            <div class='col-xs-12 col-md-4 form-group expiration required'>

                                <label class='control-label'>Expiration Year</label>

                                <input class='form-control card-expiry-year' placeholder='YYYY' size='4'

                                    type='number' min='2023'>

                            </div>

                        </div>

                        <div class='form-row row'>

                            <div class='col-md-12 error form-group hide'>

                                <div class='alert-danger alert'>Please correct the errors and try

                                    again.</div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-xs-12">

                                <button class="btn btn-primary mt-2" type="submit">Place order</button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

            <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

            <script type="text/javascript">
                $(function() {

                    var $form = $(".require-validation");

                    $('form.require-validation').bind('submit', function(e) {

                        var $form = $(".require-validation"),

                            inputSelector = ['input[type=email]', 'input[type=password]',

                                'input[type=text]', 'input[type=file]',

                                'textarea'

                            ].join(', '),

                            $inputs = $form.find('.required').find(inputSelector),

                            $errorMessage = $form.find('div.error'),

                            valid = true;

                        $errorMessage.addClass('hide');

                        $('.has-error').removeClass('has-error');

                        $inputs.each(function(i, el) {

                            var $input = $(el);

                            if ($input.val() === '') {

                                $input.parent().addClass('has-error');

                                $errorMessage.removeClass('hide');

                                e.preventDefault();

                            }

                        });

                        if (!$form.data('cc-on-file')) {

                            e.preventDefault();

                            Stripe.setPublishableKey($form.data('stripe-publishable-key'));

                            Stripe.createToken({

                                number: $('.card-number').val(),

                                cvc: $('.card-cvc').val(),

                                exp_month: $('.card-expiry-month').val(),

                                exp_year: $('.card-expiry-year').val()

                            }, stripeResponseHandler);

                        }

                    });

                    function stripeResponseHandler(status, response) {

                        if (response.error) {

                            $('.error')

                                .removeClass('hide')

                                .find('.alert')

                                .text(response.error.message);

                        } else {

                            /* token contains id, last4, and card type */

                            var token = response['id'];

                            $form.find('input[type=text]').empty();

                            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");

                            $form.get(0).submit();

                        }

                    }

                });
            </script>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

</div>

@include('user.footer')

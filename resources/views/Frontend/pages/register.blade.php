@extends('Frontend.layouts.app', ['page_title' => $data['page_title']])

@section('content')
    <div class="sidebar-menu-container" id="sidebar-menu-container">

        <div class="sidebar-menu-push">

            <div class="sidebar-menu-overlay"></div>

            <div class="sidebar-menu-inner">



                @include('Frontend.layouts.nav')



                <div id="page-heading">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h1>Resgister</h1>
                                <div class="line"></div>
                                <span>Praesent volutpat nisi sed imperdiet facilisis felis turpis fermentum lectus</span>
                                <div class="page-active">
                                    <ul>
                                        <li><a href="index.html">Home</a></li>
                                        <li><i class="fa fa-dot-circle-o"></i></li>
                                        <li><a href="about.html">Register</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <section class="why-us">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="contact-form">

                                    <form id="contact_form" action="{{ route('register.front') }}" method="POST"
                                        class="require-validation" data-cc-on-file="false"
                                        data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" enctype="multipart/form-data">

                                        <div class="row">
                                            @csrf
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <input type="text" value="{{ old('name') }}" class="name"
                                                    name="name" placeholder="First name" value="">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <input type="text" value="{{ old('email') }}" class="email"
                                                    name="email" placeholder="Email address" value="">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <input type="password" value="{{ old('password') }}" class="email"
                                                    name="password" placeholder="Your password" value="">
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>


                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                {{-- <div class="advanced-button"> --}}
                                                <button class="btn btn-warning" type="submit">Register<i
                                                        class="fa fa-paper-plane"></i></button>
                                                @if (Session::has('success'))
                                                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">
                                                        {{ Session::get('success') }}</p>
                                                @endif
                                                {{-- </div> --}}
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="right-img">
                                    <img src="http://dummyimage.com/370x340/cccccc/fff.jpg" alt="">
                                    <div class="img-bg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>






            </div>

        </div>

        @include('Frontend.layouts.footer')
        @include('Frontend.layouts.mobile-nav')



    </div>

    {{-- <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

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
    </script> --}}
@endsection

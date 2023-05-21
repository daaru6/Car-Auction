<!DOCTYPE html>
<!--[if IE 9]>
<html class="ie ie9" lang="en-US">
<![endif]-->
<html lang="en-US">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <title>{{ $page_title }}</title>


    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>

    <!-- alertifyjs Css -->
    <link href="{{ URL::asset('assets/libs/alertifyjs/build/css/alertify.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- alertifyjs default themes  Css -->
    <link href="{{ URL::asset('assets/libs/alertifyjs/build/css/themes/default.min.css') }}" rel="stylesheet"
        type="text/css" />

    <link rel="stylesheet" href="{{ URL::asset('frontassets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('frontassets/css/animate.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('frontassets/css/flexslider.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('frontassets/css/jquery-ui.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('frontassets/css/simple-line-icons.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('frontassets/css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('frontassets/css/icon-font.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('frontassets/css/auction.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('frontassets/rs-plugin/css/settings.css') }}">

    <!--[if lt IE 9]>
 <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
 <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
 <![endif]-->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>

    @yield('content')

    @include('Frontend.layouts.mobile-nav')

    <script src="{{ URL::asset('assets/libs/alertifyjs/build/alertify.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('frontassets/js/jquery-1.11.1.min.js') }}"></script>

    <script type="text/javascript" src="{{ URL::asset('frontassets/js/bootstrap.min.js') }}"></script>

    <!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
    <script src="{{ URL::asset('frontassets/rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script>

    <script src="{{ URL::asset('frontassets/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>

    <script type="text/javascript" src="{{ URL::asset('frontassets/js/plugins.js') }}"></script>

    <script type="text/javascript" src="{{ URL::asset('frontassets/js/custom.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/alertifyjs/build/alertify.min.js') }}"></script>


    <script>
        $(document).ready(function() {
            // Add to cart button click event
            $(document).on('click', '.add-to-cart-btn', function(e) {
                e.preventDefault();

                var product_id = $(this).data("product-id");
                var quantity = $('#quantity').val();
                var count;

                // Check if quantity is null or empty
                if (!quantity) {
                    quantity = 1; // Set default value to 1
                }

                // Make the AJAX request
                $.ajax({
                    url: '{{ route('add_to_cart.front') }}',
                    method: "GET",
                    data: {
                        id: product_id,
                        quantity: quantity,

                    },
                    success: function(response) {

                        count = response.cart.items.length;
                        // Update cart display
                        $(".header-mini-cart").text(count);

                        alertify.success(response.message)
                    },
                    error: function(xhr) {
                        // Show error message
                        alert(xhr.responseJSON.message);
                    }
                });
            });

            $(document).on('click', '.remove-from-cart', function(e) {

                e.preventDefault();

                var product_id = $(this).data("product-id");

                // Remove the cart item from the UI
                $(this).parent('.item').remove();

                var count;

                // Make the AJAX request
                $.ajax({
                    url: '{{ route('remove_from_cart.front') }}',
                    method: "GET",
                    data: {
                        id: product_id,
                    },
                    success: function(response) {
                        if (response.status === 1) {

                            count = response.cart.items.length;

                            // Update cart display

                            count = response.cart.items.length;
                            // Update cart display
                            $(".header-mini-cart").text(count);

                            alertify.success(response.message)

                            // Reload the page
                            window.location.reload();
                        } else {
                            // Show error message
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        // Show error message
                        alert(xhr.responseJSON.message);
                    }
                });
            });
        });
    </script>

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

</body>

</html>

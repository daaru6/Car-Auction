<!DOCTYPE html>
<!--[if IE 9]>
<html class="ie ie9" lang="en-US">
<![endif]-->
<html lang="en-US">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<title>{{$page_title}}</title>


	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>

	        <!-- alertifyjs Css -->
			<link href="{{ URL::asset('assets/libs/alertifyjs/build/css/alertify.min.css') }}" rel="stylesheet" type="text/css" />

			<!-- alertifyjs default themes  Css -->
			<link href="{{ URL::asset('assets/libs/alertifyjs/build/css/themes/default.min.css') }}" rel="stylesheet"
				type="text/css" />

	<link rel="stylesheet" href="{{URL::asset("frontassets/css/bootstrap.css")}}">

	<link rel="stylesheet" href="{{URL::asset("frontassets/css/animate.css")}}">

	<link rel="stylesheet" href="{{URL::asset("frontassets/css/flexslider.css")}}">

	<link rel="stylesheet" href="{{URL::asset("frontassets/css/jquery-ui.css")}}">

	<link rel="stylesheet" href="{{URL::asset("frontassets/css/simple-line-icons.css")}}">

	<link rel="stylesheet" href="{{URL::asset("frontassets/css/font-awesome.min.css")}}">

	<link rel="stylesheet" href="{{URL::asset("frontassets/css/icon-font.css")}}">

	<link rel="stylesheet" href="{{URL::asset("frontassets/css/auction.css")}}">	

	<link rel="stylesheet" href="{{URL::asset("frontassets/rs-plugin/css/settings.css")}}">

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
	<script type="text/javascript" src="{{URL::asset("frontassets/js/jquery-1.11.1.min.js")}}"></script>

	<script type="text/javascript" src="{{URL::asset("frontassets/js/bootstrap.min.js")}}"></script>

	<!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
    <script src="{{URL::asset("frontassets/rs-plugin/js/jquery.themepunch.tools.min.js")}}"></script>

    <script src="{{URL::asset("frontassets/rs-plugin/js/jquery.themepunch.revolution.min.js")}}"></script>

	<script type="text/javascript" src="{{URL::asset("frontassets/js/plugins.js")}}"></script>
	
	<script type="text/javascript" src="{{URL::asset("frontassets/js/custom.js")}}"></script>
	<script src="{{ URL::asset('assets/libs/alertifyjs/build/alertify.min.js') }}"></script>

	
<script>
    $(document).ready(function() {
        // Add to cart button click event
        $(document).on('click', '.add-to-cart-btn', function(e) {
            e.preventDefault();

            var product_id = $(this).data("product-id");
            var city = $(this).data("city");
            var area = $(this).data("area");
            var quantity = 1; // default quantity is 1
            var count;

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
                    $(".shopping-cart-items").html(""); // clear previous cart items

                    // Append new cart items
                    $.each(response.cart.items, function(index, item) {
                        var cartItemHtml = `
                    <div class="item pull-left">
                        <img width="56px" height="70" style="object-fit:contain;" src="${item.image}" alt="${item.name}" class="pull-left">
                        <div class="pull-left">
                            <p>${item.name}</p>
                            <p>Rs${item.price} <strong>x ${item.quantity}</strong></p>
                        </div>
                        <a href="#" class="trash remove-from-cart" data-product-id="${item.id}"><i class="fa fa-trash-o pull-left"></i></a>
                    </div>
                `;
                        $(".shopping-cart-items").append(cartItemHtml);
                    });

                    // Update cart total
                    $(".total td:nth-child(2)").text("Rs" + response.cart.total_price);

                    // Update checkout and view cart links
                    // $(".total .btn-read").attr("href", response.cart.links.view_cart);

                    // Show success message
                    
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

                        $(".header-mini-cart span").text(count +
                            " item(s) - Rs" + response.cart.total_price);


                        // Update cart total
                        $(".total td:nth-child(2)").text("Rs" + response.cart.total_price
                            .toFixed(2));

                            alertify.success(response.message)
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

</body>
</html>    
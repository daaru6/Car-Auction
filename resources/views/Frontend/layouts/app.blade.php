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

    
	<script type="text/javascript" src="{{URL::asset("frontassets/js/jquery-1.11.1.min.js")}}"></script>

	<script type="text/javascript" src="{{URL::asset("frontassets/js/bootstrap.min.js")}}"></script>

	<!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
    <script src="{{URL::asset("frontassets/rs-plugin/js/jquery.themepunch.tools.min.js")}}"></script>

    <script src="{{URL::asset("frontassets/rs-plugin/js/jquery.themepunch.revolution.min.js")}}"></script>

	<script type="text/javascript" src="{{URL::asset("frontassets/js/plugins.js")}}"></script>
	
	<script type="text/javascript" src="{{URL::asset("frontassets/js/custom.js")}}"></script>

</body>
</html>    
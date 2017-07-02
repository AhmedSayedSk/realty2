<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('page_title')</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="csrf-token" content="{!! csrf_token() !!}">

	<link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/front/css/style.css">
	<script type="text/javascript" src="/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/front/js/script.js"></script>
	
</head>
<body>
	@include('front.add-ons.navbar')
	@yield('content')


	<footer class="container">
		Wish you have enjoyed our journey :D
	</footer>
</body>
</html>
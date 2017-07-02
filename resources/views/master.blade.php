<!DOCTYPE html>
<html lang="en">
<head>
	<base href='<?= URL::to('./'); ?>'>
    <script>var base = '<?= URL::to('./'); ?>';</script>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="csrf-token" content="{!! csrf_token() !!}">

	<title>@yield('page_title')</title>

	<link rel="stylesheet" type="text/css" href="./bootstrap/css/bootstrap.min.css">
	@yield('head-css')
	<link rel="stylesheet" type="text/css" href="./front/css/style.css">

	<script type="text/javascript" src="./jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="./bootstrap/js/bootstrap.min.js"></script>
	@yield('head-js')
	<script type="text/javascript" src="./front/js/script.js"></script>
</head>
<body>
	@include('front.add-ons.navbar')
	@include('front.searchbox')
	@yield('content')

	<footer class="container">
		Wish you have enjoyed our journey :D
	</footer>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>{{ $page_title }}</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="csrf-token" content="{!! csrf_token() !!}">

	<link rel="stylesheet" type="text/css" href="{{asset('bootstrap/css/bootstrap.min.css')}}">	
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="{{asset('front/css/style.css')}}">
	<script type="text/javascript" src="{{asset('jquery-1.11.3.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('front/js/script.js')}}"></script>
	
	</head>
<body>
	<div class="container">
		<ul class="nav nav-pills">
			<li role="presentation" class="active"><a href="/realty" id="home"> Home </a></li>
			@if(Auth::check())
				<li role="presentation" class="disabled">
					<a href="#"><b>Hello: {{ Auth::user()->name}}</b></a>
				</li>
				<li role="presentation"><a href="/realty">All Ads</a></li>
				<li role="presentation"><a href="/auth/logout">Logout</a></li>
			@else
          		<li role="presentation"><a href="/auth">Login / Register</a></li>
        	@endif
        	@include('front.add-ons.search')

		</ul>
	</div>

	@yield('content')


	<footer class="container">
		Wish you have enjoyed our journey :D
	</footer>
	
	

</body>
</html>
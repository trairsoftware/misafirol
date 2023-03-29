<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MİSAFİR OL</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<body>
<div id="app">
    <a href="https://api.whatsapp.com/send?phone=905414691919" class="float" target="_blank"
       style="	position:fixed;
	width:60px;
	height:60px;
	bottom:40px;
	right:40px;
	background-color:#25d366;
	color:#FFF;
	border-radius:50px;
	text-align:center;
  font-size:30px;
	box-shadow: 2px 2px 3px #999;
  z-index:100;"
    >
        <i class="fa fa-whatsapp my-float" style="	margin-top:16px;"></i>
    </a>
    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>

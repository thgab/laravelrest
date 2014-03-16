<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <title>Robots</title>
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta name="description" content="List of robots">
 <meta name="author" content="thgab">
 <link href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
 <link href="{{ asset('bower_components/bootstrap/dist/css/bootstrap-theme.min.css') }}" rel="stylesheet">
 <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="#">Robots</a>
		</div>
	</div>
</div>
@yield('content')

 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> <!-- use Google CDN for jQuery to hopefully get a cached copy -->
 <script src="{{ asset('bower_components/underscore/underscore.js') }}"></script>
 <script src="{{ asset('bower_components/backbone/backbone.js') }}"></script>
 <script src="{{ asset('bower_components/mustache/mustache.js') }}"></script>
 <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
 <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>


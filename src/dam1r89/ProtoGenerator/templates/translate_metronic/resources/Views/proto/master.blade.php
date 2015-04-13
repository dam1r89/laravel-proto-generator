<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Title</title>
		<meta charset="UTF-8">
		<meta name=description content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap CSS -->
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet" media="screen">
		@yield('header')
	</head>
	<body>

        <div class="container">
        	<div class="row">
        		<div class="col-md-12">

                    @include('proto.notifications')
        		    @yield('content')
        		</div>
        	</div>
        </div>
		<!-- jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
		@yield('footer')
        <script>
            // code for switching languages
            $('#btn-group-form-locales .btn').click(function(){
                $(this).parent().children('.active').removeClass('active');
                $(this).addClass('active');
            });
        </script>
	</body>
</html>
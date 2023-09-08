<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>@yield('title') | Reimbur App</title>

		<link rel="icon" href="{{ asset('assets/img/icon-app.png') }}">
		<link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
		
		<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
	</head>
	<body id="page-top">

		<div id="wrapper">
			 @include('template/sidebar')

			<div id="content-wrapper" class="d-flex flex-column">
				<div id="content">
					@include('template/header')
					@yield('container')
				</div>
      
				<footer class="sticky-footer bg-white">
					<div class="container my-auto">
						<div class="copyright text-center my-auto">
							<span>Copyright &copy; Rahardian</span>
						</div>
					</div>
				</footer>
			</div>
		</div>
  
		<!-- Scroll to Top Button-->
		<a class="scroll-to-top rounded" href="#page-top">
			<i class="fas fa-angle-up"></i>
		</a>

		<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
		<script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
		<script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
	</body>
</html>
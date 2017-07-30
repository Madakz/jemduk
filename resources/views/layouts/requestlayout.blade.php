<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>

	<!-- Meta Tags -->
	<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<meta name="description" content="YourHome - Property and Real Estate HTML Template">
	<meta name="keywords" content="home, house, apartment, agents, business, properties, real estate, real estate agent, residence, single house, single property, villa, rent, land, sell">
	

	<!-- Title -->
	<title>Jemduk</title>
	
	<!-- links included here -->
	@include('layouts.csslinks')
	

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	
	<div class="page-wrapper">

		
		<!-- Header Start -->
		<header>
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-3 logo">
						<h1>
							<a href="{{route('home')}}"><img src="{{ asset('/clientviews/img/jemduk.png')}}" alt="jemduk">
							Jemduk
							</a>
						</h1>
					</div>
					<div class="col-md-9 col-sm-9 nav-wrapper">

						<!-- Nav Start -->
						<nav>
							<ul class="sf-menu" id="menu">
								<li class="active"><a href="{{route('home')}}">Home <i class="menu-icon zmdi zmdi-home zmdi-hc"></i></a>									
								</li>
								<li>
									<a href="{{route('about')}}">About Us 
										<!-- <i class="zmdi zmdi-info"></i> -->
									</a>		
								</li>						
								<li><a href="#">Property <i class="fa fa-angle-down"></i></a>
									<ul>
										<li><a href="{{route('forsell')}}">For Sale Properties</a></li>
										<li><a href="{{route('forlease')}}">For Lease Properties</a></li>
										<li><a href="{{route('forrent')}}">For Rent Properties</a></li>
									</ul>
								</li>								
								<li>
									<a href="{{route('agents')}}">Agents 
										<!-- <i class="zmdi zmdi-male-female"></i> -->
									</a>
								</li>
								<li><a href="#">More <i class="fa fa-angle-down"></i></a>
									<ul>
										<li>
											<a href="{{route('gallery')}}">Gallery <i class="zmdi zmdi-image"></i></a>			
										</li>
										<li>
											<a href="#">FAQS <i class="zmdi zmdi-help"></i></a>
											<!-- <a href="{{route('faqs')}}">FAQS <i class="zmdi zmdi-help"></i></a> -->
										</li>
										<li>
											<!-- <a href="{{route('service')}}">Services <i class="fa fa-angle-down"></i></a> -->
											<a href="#">Services <i class="fa fa-angle-down"></i></a>
												<!-- <ul>
													<li><a href="service.html">Services</a></li>
													<li><a href="service-detail.html">Services Detail</a></li>
												</ul> -->
										</li>
									</ul>
								</li>															
								<li>
									<a href="{{ url('/login') }}">Login</i></a>		
								</li>								
								<li><a href="#contact">Contact Us</a></li>						
							</ul>
						</nav>
						<!-- Nav End -->

					</div>
				</div>
			</div>
		</header>
		<!-- Header End -->
		
		@yield('content')

		
		<!-- Footer Main Start -->
		<section class="footer-main">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-2 col-lg-2 socials"></div>
					<div class="col-sm-6 col-md-3 col-lg-3 socials">
						<h3>Jemduk Socials</h3>
						<div class="row">
							<div class="col-md-12">
								<ul>
									<li><a href="#"><i class="zmdi zmdi-facebook"></i> Facebook</a></li>
									<li><a href="#"><i class="zmdi zmdi-twitter"></i> Twitter</a></li>
									<li><a href="#"><i class="zmdi zmdi-instagram"></i> Instagram</a></li>
									<li><a href="#"><i class="zmdi zmdi-linkedin-box"></i> Linkedin</a></li>
									<li><a href="#"><i class="zmdi zmdi-pinterest-box"></i> Pinterest</a></li>
									<li><a href="#"><i class="zmdi zmdi-google-plus"></i> Google Plus</a></li>
									<li><a href="#"><i class="zmdi zmdi-youtube"></i> Youtube</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-3 col-lg-3 footer-col">
						<h3>Quick Links</h3>
						<div class="row">
							<div class="col-md-12">
								<ul>
									<li><a href="#">Properties</a></li>
									<li><a href="#">Rentals</a></li>
									<li><a href="#">Properties Sell</a></li>
									<li><a href="#">Agent</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-3 col-lg-3 footer-col">
						<h3>Services</h3>
						<div class="row">
							<div class="col-md-12">
								<ul>
									<li><a href="#">Property Rentals</a></li>
									<li><a href="#">Property Leasing</a></li>
									<li><a href="#">Property Sell</a></li>
									<li><a href="#">Agent</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-1 col-lg-1 socials"></div>
				</div>
			</div>
		</section>
		<!-- Footer Main End -->

		
		<!-- Footer Bottom Start -->
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<div class="col-md-12 copyright">
						Copyright &copy; 2017, &nbsp;<a href="http://www.Jemduk.com">Jemduk</a>. All Rights Reserved.
					</div>
				</div>
			</div>
		</div>
		<!-- Footer Bottom End -->



		<a href="#" class="scrollup">
			<i class="fa fa-angle-up"></i>
		</a>

	</div>

	<!-- scripts included here -->
	@include('layouts.scriptlinks')

	</body>
</html>
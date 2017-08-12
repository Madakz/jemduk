<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>

	<!-- Meta Tags -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
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
<style>
	div.col-md-10.search-property a div.row{
		background-color: #D4D4D4;
		font-size: 17px;
		font-weight: 30px;
		color:#188ae2;
	}

	div.col-md-10.search-property a:hover div.row{
		color: #fff;
		background-color:#878787;
		/*background-color:#3399FF;*/
	}
</style>
<body>
	
	<div id="preloader">
		<div id="status"></div>
	</div>
	
	<div class="page-wrapper">

		<!-- Top Bar Start -->
			<div class="top-bar">
				<div class="container">
					<div class="row">
						<div class="col-md-6 top-contact">
							<div class="list">
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Top Bar End -->

		<!-- Header Start -->
		<header>
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-3 logo">
						<h1>
							<a href="{{route('home')}}"><img src="{{ asset('/clientviews/img/jemduk.png')}}" alt="jemduk">
							Jemduk</a>
						</h1>
					</div>
					<div class="col-md-9 col-sm-9 nav-wrapper">

						<!-- Nav Start -->
						<nav>
							<ul class="sf-menu" id="menu">
								<li class="active"><a href="{{route('home')}}">Home <i class="menu-icon zmdi zmdi-home zmdi-hc"></i></a>									
								</li>
								<li>
									<a href="#about">About Us 
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
									<a href="{{ url('/agents') }}">Agents 
										<!-- <i class="zmdi zmdi-male-female"></i> -->
									</a>
								</li>
								<li><a href="#">More <i class="fa fa-angle-down"></i></a>
									<ul>
										<li>
											<a href="{{ url('/gallery')}}">Gallery <i class="zmdi zmdi-image"></i></a>			
										</li>
										<li>
											<a href="{{ url('/faqs')}}">FAQS <i class="zmdi zmdi-help"></i></a>
										</li>
										<li>
											<a href="{{ url('/service')}}">Services <i class="fa fa-angle-down"></i></a>
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


					
		<!-- Slider Start -->
		<section class="main-slider">
			<div class="slide-carousel owl-item">					
				<div class="item" style="background-image:url({{ asset('/clientviews/images/slide1.jpg') }});">
					<div class="overlay"></div>
					<div class="text">
						<div class="this-item">
							<h2>Welcome To Jemduk</h2>
						</div>
						<div class="this-item">
							<h3>Your Reliable Property Mangement Solution</h3>
						</div>
						<!-- <div class="this-item">
							<p><a href="#">Read More</a></p>
						</div> -->
					</div>
				</div>					
				<div class="item" style="background-image:url({{ asset('/clientviews/images/slide2.jpg') }});">
					<div class="overlay"></div>
					<div class="text">
						<div class="this-item">
							<h2>24/7 Hours Solution</h2>
						</div>
						<div class="this-item">
							<h3>All Emergency and Important Problem Are Handled</h3>
						</div>
						<!-- <div class="this-item">
							<p><a href="#">Read More</a></p>
						</div> -->
					</div>
				</div>
			</div>
		</section>
		<!-- Slider End -->


		<!-- properties Search Start -->
		<div class="properties bg-gray">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h2>Find Property</h2>
						<div class="border-shape"></div>	
						<!-- <h3>We Provide Almost All Kinds of Real Estate Services</h3> -->
					</div>
				</div>	
				<div class="row">
					<div class="col-md-12">
						{{Form::open(['route' => 'search_property', 'method' => 'POST'])}}
							<!-- <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div> -->
							{{ csrf_field() }}
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="row">
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
										<div class="mt-car-search">
											<select name="scope" id="scope" class="select-car-category form-control">
												<option value="">Select Scope:</option>
					                            <option value="Sale">For Sale</option>
					                            <option value="Lease"> For Lease</option>
					                            <option value="Rent">For Rent</option>
					                        </select>
					                    </div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
										<div class="mt-car-search">
											<select name="category" id="category" class="select-car-category form-control">
												<option value="">Search by:</option>
					                            <option value="type">Property Type</option>
					                            <option value="price">Price</option>
					                            <option value="location">Location</option>
					                        </select>
					                    </div>
									</div>				
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">				
										<div class="mt-car-search">
												<input type="text" id="search-box" name="search_item" value="" class="search-field form-control" placeholder="enter search item ..." autocomplete="off">
												<div id="suggesstion-box"></div>
										</div>																				
									</div>		
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">		
										<div class="mt-car-search">
											<div class="submit">
												<input type="submit" name="search" value="FIND NOW" class="search-field form-control btn btn-primary" />
											</div>									
										</div>														
									</div>
								</div>
							</div>
														
							<!-- <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>		 -->
						{{Form::close()}}						
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-10 search-property">
					<div class="col-md-12">@include('layouts.errors')</div>
						<!-- <div class="" style="background-color:#D4D4D4;"> -->
                        @if(isset($results))
                        	<h2>Search Results</h2>
                        	<div class="border-shape"></div>

                        	
                            @if ($results->isEmpty())
                            	Opps! No properties found
                            @else
                            	<!-- <div class="row">
                            		<div class="col-md-2">
                            			
                            		</div>
                            		<div class="col-md-2">
                            			Location
                            		</div>
                            		<div class="col-md-2">
                            			Scope
                            		</div>
                            		<div class="col-md-2">
                            			Price
                            		</div>
                            		<div class="col-md-2">
                            			Type
                            		</div>
                            		<div class="col-md-2">
                            			Description
                            		</div>
                            	</div> -->
                            	<hr/>                       	
                            	@foreach($results as $property)
                            		<a href="/show/{{$property->id}}">
                            			<div class="row">
	                            			<div class="col-md-2">
		                            			@if(isset($property->photo[0]))
													<img src="{!! url('photo/'.$property->photo[0]->photo_name) !!}" alt="" style="height:100px;">
		                            			@else
		                            				No image
		                            			@endif
	                            			</div>
		                            		<div class="col-md-2">
		                            			Location: {{$property->location}}
		                            		</div>
		                            		<div class="col-md-2">
		                            			For: {{$property->scope}}
		                            		</div>
		                            		<div class="col-md-2">
		                            			Price: N{{$property->price}}
		                            		</div>
		                            		<div class="col-md-2">
		                            			Type: {{$property->type}}
		                            		</div>
		                            		<!-- <div class="col-md-2">
		                            			Description: {{$property->description}}
		                            		</div>	 -->                            		
	                            		</div>
	                            	</a>
	                            	<hr/> 
                            	@endforeach                	
                            @endif

                            <!-- // dd($results); ?> -->
                        @endif
                    </div>
                    <div class="col-md-1"></div>
				</div>
			</div>
		</div>
		<!-- properties Search end -->



		<!-- Room Category Start -->
		<div class="room-category">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-sm-12">						
						<div class="single-category">	
							<div class="single-room">
								<img src="{{ asset('/clientviews/images/cat1.jpg') }}" alt=""/>
								<div class="room-overlay">
									<div class="roomdetails-overlay">
										<div class="room-details">
											<h2>Houses </h2>	
											<a href="#" class="readmore-button">View All</a>	
										</div>							
									</div>
								</div>
							</div>			
						</div>	

					</div>
					<div class="col-md-4 col-sm-6">
						<div class="single-category">	
							<div class="single-room">
								<img src="{{ asset('/clientviews/images/cat2.jpg') }}" alt=""/>
								<div class="room-overlay">
									<div class="roomdetails-overlay">
										<div class="room-details">
											<h2>Lands</h2>	
											<a href="#" class="readmore-button">View All</a>	
										</div>							
									</div>
								</div>
							</div>			
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="single-category">	
							<div class="single-room">
								<img src="{{ asset('/clientviews/images/cat3.jpg') }}" alt=""/>
								<div class="room-overlay">
									<div class="roomdetails-overlay">
										<div class="room-details">
											<h2>Shops</h2>	
											<a href="#" class="readmore-button">View All</a>	
										</div>							
									</div>
								</div>
							</div>			
						</div>
					</div>
				</div>
			</div>		
		</div>			
		<!-- Room Category End -->


		<!-- About Us Start -->
		<div class="about-us" id="about">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h2>About Us</h2>
						<div class="border-shape"></div>						
					</div>
				</div>			
				<div class="row">
					<div class="col-md-12 text">
						<h5>Jemduk is a startup from nHub Nigeria (a technology innovation hub in Jos Plateau). Four months ago after studying the way individuals, students, families, companies, cooperatives etc suffered to get property either to rent, lease, or buy. We took it upon ourselves as innovators to design and develop a computerized system called JEMDUK a Property Management System (PMS). This is to bring the clients closer to the agents managing all kinds of properties. To further buttress, Jemduk is also used in real estate, renting of property, leasing of property and also the sale of property. They are computerized systems that facilitate the management of properties, personal property, equipment, including maintenance, legalities and personnel all through a single piece of software. They replaced old-fashioned, paper-based methods that tended to be cumbersome, inefficient and most times dubious.</h5>
						<a href="{{route('about')}}" class="readmore-button">Read More</a>
					</div>
				</div>
			</div>
		</div>
		<!-- About Us End -->

		<!-- Service Start -->
		<div class="service">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h2>Services Offered</h2>
						<div class="border-shape"></div>	
						<h3>We Offer Almost All Kinds of Property Management Services</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="single-room">
							<img src="{{ asset('/clientviews/images/cat1.jpg') }}" alt=""/>
							<div class="room-overlay">
								<div class="roomdetails-overlay">
									<div class="room-details">
										<h2>Property Rentals</h2>	
										<a href="#" class="readmore-button">Read More</a>	
									</div>							
								</div>
							</div>
						</div>	
					</div>					
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="single-room">
							<img src="{{ asset('/clientviews/images/cat2.jpg') }}" alt=""/>
							<div class="room-overlay">
								<div class="roomdetails-overlay">
									<div class="room-details">
										<h2>Property Leasing</h2>	
										<a href="#" class="readmore-button">Read More</a>	
									</div>							
								</div>
							</div>
						</div>	
					</div>					
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="single-room">
							<img src="{{ asset('/clientviews/images/cat3.jpg') }}" alt=""/>
							<div class="room-overlay">
								<div class="roomdetails-overlay">
									<div class="room-details">
										<h2>Property Sell</h2>	
										<a href="#" class="readmore-button">Read More</a>	
									</div>							
								</div>
							</div>
						</div>	
					</div>					
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="single-room">
							<img src="{{ asset('/clientviews/images/cat4.jpg') }}" alt=""/>
							<div class="room-overlay">
								<div class="roomdetails-overlay">
									<div class="room-details">
										<h2>Find An Agent</h2>	
										<a href="#" class="readmore-button">Read More</a>	
									</div>							
								</div>
							</div>
						</div>	
					</div>								
				</div>
			</div>
		</div>
		<!-- Service End -->

		<!-- Testimonial Start -->
		<section class="testimonial-v1">
			<div class="overlay"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h2>Customer Testimonials</h2>
						<div class="border-shape"></div>						
					</div>
					<div class="col-md-12">
						
						<!-- Testimonial Carousel Start -->
						<div class="testimonial-carousel">
							<div class="item">
								<div class="testimonial-wrapper">								
									<div class="content">
										<div class="comment">
											<p>
												“Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.”
											</p>
											<div class="icon"></div>
										</div>
										<div class="author">
											<div class="photo">
												<img src="{{ asset('/clientviews/images/testimonial1.jpg') }}" alt="">
											</div>
											<div class="text">
												<h3>John Doe</h3>
												<h4>Managing Director <span>(ABC Inc.)</span></h4>
											</div>
										</div>										
									</div>
								</div>
							</div>
							<div class="item">
								<div class="testimonial-wrapper">								
									<div class="content">
										<div class="comment">
											<p>
												“Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.”
											</p>
											<div class="icon"></div>
										</div>
										<div class="author">
											<div class="photo">
												<img src="{{ asset('/clientviews/images/testimonial2.jpg') }}" alt="">
											</div>
											<div class="text">
												<h3>John Doe</h3>
												<h4>CEO <span>(XYZ Ltd.)</span></h4>
											</div>
										</div>										
									</div>
								</div>
							</div>
						</div>
						<!-- Testimonial Carousel End -->

					</div>
				</div>
			</div>
		</section>
		<!-- Testimonial End -->
		

		<!-- contact us starts-->
			<section class="team" id="contact">
				<div class="container">
					<div class="row">						
						<div class="col-md-12">
							<div class="heading">
								<h2>Get in Touch</h2>
								<div class="border-shape"></div>
							</div>
							@if(session('success'))
			                    <div class="alert alert-success alert-dismissible" role="alert">
			                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			                            <span aria-hidden="true">&times;</span>
			                        </button>
			                        <center>{{ session('success')}}</center>
			                    </div>
			                @elseif(session('error'))
			                    <div class="alert alert-danger alert-dismissible" role="alert">
			                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			                            <span aria-hidden="true">&times;</span>
			                        </button>
			                        {{ session('error')}}
			                    </div>
			                @endif
						</div>
						<div class="col-md-1 col-sm-1 col-xs-1"></div>
						<div class="col-md-4 col-sm-5 col-xs-12" style="margin-top:50px;">
							<aside>
					        	<div class="get-in-touch">
						        	<div class="contact-item">
            							<p><i class="zmdi zmdi-phone" aria-hidden="true"></i> Phone: (+234) 8032851135 <br/>&nbsp;&nbsp; (+234) 8136943343</p><br/>
            							<p><i class="zmdi zmdi-local-post-office" aria-hidden="true"></i> Email: jemdukonline@gmail.com</p><br/>
            							<p><i class="zmdi zmdi-pin" aria-hidden="true"></i> Address: nHub Nigeria , 3rd Floor Taen Business Complex, Opp. NITEL , Old Airport Road Jos Plateau State.</p>
        							</div>                        
								</div>
							</aside>
						</div>

						<div class="col-md-6 col-sm-5 col-xs-12">
							<div role="form" class="wpcf7" id="wpcf7-f7104-p869-o1" lang="en-US" dir="ltr">
								<div class="screen-reader-response">								
								</div>
									{{Form::open(['route' => 'store_get_intouch', 'method' => 'POST', 'class'=>'wpcf7-form'])}}						@include('layouts.errors')			
										<div class="col-md-6">
											<div class="first-name-input">
			        							<label>First Name</label><br />
			 									<span class="wpcf7-form-control-wrap first-name"><input type="text" name="first_name" value="{{old('first_name')}}" size="40" class="wpcf7-form-control wpcf7-text " aria-required="true" aria-invalid="false" /></span>
			  								</div>
											<div class="email-input">
			        							<label>Email Address</label><br />
			  									<span class="wpcf7-form-control-wrap your-email"><input type="email" name="email" value="{{old('email')}}" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email " aria-required="true" aria-invalid="false" /></span>
			  								</div>
										</div>
										<div class="col-md-6">
											<div class="last-name-input">
			        							<label>Last Name</label><br />
			  										<span class="wpcf7-form-control-wrap last-name">
			  											<input type="text" name="last_name" value="{{old('last_name')}}" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" />
			  										</span>
			  								</div>
											<div class="subject-input">
			        							<label>Subject</label><br />
												<span class="wpcf7-form-control-wrap your-subject">
													<input type="text" name="subject" value="{{old('subject')}}" size="40" class="wpcf7-form-control wpcf7-text " aria-required="true" aria-invalid="false" />
												</span>
			  								</div>
										</div>
										<div class="col-md-12">
											<div class="message-input">
			        							<label>Message</label><br />
												<span class="wpcf7-form-control-wrap your-message">
													<textarea name="message" value="{{old('message')}}" cols="3" rows="3" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false">											
													</textarea>
												</span>
			  								</div>
										</div>
										<div class="col-md-12">
			  								<input type="submit" value="Send Message &rarr;" class="wpcf7-form-control wpcf7-submit" />
										</div>
									{{Form::close()}}
							</div>
						</div>
						<div class="col-md-1 col-sm-1 col-xs-1"></div>
					</div>
					
				</div>
			</section>

		<!--contact us ends -->

		
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
@extends('layouts.clientviewlayout')

@section('content')	
	<!-- Page Banner Start -->
	<div class="slide-single slide-single-page">
		<div class="overlay"></div>
		<div class="text text-page">
			<div class="this-item">
				<h2>About Us</h2>
			</div>
		</div>			
	</div>
	<!-- Page Banner End -->
	<!-- About Start -->
	<section class="about">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-10 col-lg-10">
					<div class="item">
						<!-- <h2>About Us</h2>
						<h3>Our Experience</h3> -->
						<p>
							Jemduk is a startup from nHub Nigeria (a technology innovation hub in Jos Plateau). 
							Four months ago after studying the way individuals, students, families, companies, 
							cooperatives etc suffered to get property either to rent, lease, or buy. 
							We took it upon ourselves as innovators to design and develop a computerized system 
							called JEMDUK a Property Management System (PMS). This is to bring the clients closer 
							to the agents managing all kinds of properties. To further buttress, Jemduk is also 
							used in real estate, renting of property, leasing of property and also the sale of 
							property. They are computerized systems that facilitate the management of properties, 
							personal property, equipment, including maintenance, legalities and personnel all through 
							a single piece of software. They replaced old-fashioned, paper-based methods that tended 
							to be cumbersome, inefficient and most times dubious.
						</p>					

					</div>
				</div>
				<div class="col-sm-6 col-md-2 col-lg-2">
					<div class="item">
						<img src="{{ asset('/clientviews/img/jemduk.png')}}" alt="jemduk image">
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- About End -->

@stop

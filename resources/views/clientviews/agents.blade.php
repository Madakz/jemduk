@extends('layouts.clientviewlayout')

@section('content')

		<!-- Page Banner Start -->
		<div class="slide-single slide-single-page">
			<div class="overlay"></div>
			<div class="text text-page">
				<div class="this-item">
					<h2>Esteem Agents</h2>
				</div>
			</div>			
		</div>
		<!-- Page Banner End -->
		<!-- Team Start -->
		<section class="team">
			<div class="container">
				<div class="row">
					<!-- Team Container Start -->
					<div class="team-inner">
						@foreach($users as $user)
                            <div class="col-sm-6 col-md-3 item">
								<div class="inner">
									<div class="thumb">
										<a href="#"><img class="" src="{!! url('photo/'.$user->picture) !!}" alt="{{$user->picture}}" style="width:300px; height:300px;"></a>
										<!-- <div class="social-icons">
											<ul>
												<li><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
												<li><a href="#"><i class="zmdi zmdi-twitter"></i></a></li>
												<li><a href="#"><i class="zmdi zmdi-linkedin"></i></a></li>
												<li><a href="#"><i class="zmdi zmdi-pinterest"></i></a></li>
												<li><a href="#"><i class="zmdi zmdi-youtube"></i></a></li>
											</ul>
										</div> -->
									</div>
									<div class="text">
										<center><h3><a href="agent-detail.html">{{$user->last_name}} {{$user->first_name}}</a></h3></center>
										<ul>
											<!-- <li><i class="fa fa-phone"></i>Phone: {{$user->phone_number}}</li>
											<li><i class="fa fa-envelope-o"></i>Email: {{$user->email}}</li> -->
										</ul>
									</div>
								</div>
							</div>
                        @endforeach											
					</div>
					<!-- Team Container End -->
				</div>
			</div>
		</section>
		<!-- Team End -->	

@stop
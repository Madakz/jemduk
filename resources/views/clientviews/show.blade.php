@extends('layouts.clientviewlayout')

@section('content')

		<!-- Page Banner Start -->
		<div class="slide-single slide-single-page">
			<div class="overlay"></div>
			<div class="text text-page">
				<div class="this-item">
					<h2>{{$property->property_type}}</h2>
				</div>
			</div>			
		</div>
		<!-- Page Banner End -->
		<!-- Team Detail Start -->
		<section class="team-detail-1">
			
			<div class="container">
				<div class="row">
					@if(session('success'))
	                    <div class="alert alert-success alert-dismissible" role="alert">
	                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                            <span aria-hidden="true">&times;</span>
	                        </button>
	                        {{ session('success')}}
	                    </div>
	                @elseif(session('error'))
	                    <div class="alert alert-danger alert-dismissible" role="alert">
	                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                            <span aria-hidden="true">&times;</span>
	                        </button>
	                        {{ session('error')}}
	                    </div>
	                @endif
					<div class="col-md-12">

						<div class="header">
							<div class="row">
								<div class="col-md-5">
									<div class="left">
										<section class="main-slider">
											<div class="slide-carousel owl-item">
											<?php
												$picture_count = count($property->photo);
											?>
											@for($i=0; $i < $picture_count; $i++)					
												<div class="item" style="background-image:url({!! url('photo/'.$property->photo[$i]->photo_name) !!})" style="height:100px;">
													<div class="overlay"></div>
													<div class="text">
														<div class="this-item">
															<!-- <h2>{{$property->photo[$i]->photo_name}}</h2> -->
														</div>
														<div class="this-item">
															<!-- <h3>Your Reliable Property Mangement Solution</h3> -->
														</div>
													</div>
												</div>												
											@endfor
											</div>
										</section>
									</div>
								</div>
								<div class="col-md-7">
									<div class="right">
										<h2>Description: </h2>
										<p>
											{{$property->description}}
										</p>
										<hr/>
										<h2>{{$property->type}}</h2>
										<h4>Location: {{$property->location}}</h4>
										<h4>For {{$property->scope}}</h4>
										<hr/>
										<h4>Price: {{$property->price}}</h4>
										<hr/>
									</div>
									<div class="contact-area">
										<a href="{{route('request_prop', [$property->id])}}"><button class="btn btn-primary">Place Request</button></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</section>

@stop
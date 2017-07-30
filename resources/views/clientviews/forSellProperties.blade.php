@extends('layouts.clientviewlayout')

@section('content')
		<!-- Page Banner Start -->
		<div class="slide-single slide-single-page">
			<div class="overlay"></div>
			<div class="text text-page">
				<div class="this-item">
					<h2>Properties For Sale</h2>
				</div>
			</div>			
		</div>
		<!-- Page Banner End --> 

		<!-- Recent Properties Start -->
		<div class="properties">
			<div class="container">	
				<div class="row">
					@foreach($properties as $property)							
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">	
							<div class="single-room">
								<img src="{!! url('photo/'.$property->photo[0]->photo_name) !!}" alt="{{$property->photo[0]->photo_name}}" style="width:370px; height:250px ">
								<div class="room-overlay">
									<div class="roomdetails-overlay">
										<div class="room-details">
											<span class="room-price">N{{$property->price}}</span>
											<h2>{{$property->property_type}}</h2>	
											<a href="property-details.html" class="readmore-button">View Details</a>	
										</div>							
									</div>
								</div>
							</div>											
						</div>
					@endforeach					
				</div>				
			</div>	
		</div>	
		<!-- Recent Properties End -->	

@stop
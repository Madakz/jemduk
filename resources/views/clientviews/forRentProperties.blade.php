@extends('layouts.clientviewlayout')

@section('content')
		<!-- Page Banner Start -->
		<div class="slide-single slide-single-page">
			<div class="overlay"></div>
			<div class="text text-page">
				<div class="this-item">
					<h2>Properties For Rent</h2>
				</div>
			</div>			
		</div>
		<!-- Page Banner End -->   		
		<!-- Recent Properties Start -->
		<div class="properties">
			<div class="container">	
				<div class="row">
					@if ($properties->isEmpty())
	                    	<h3>Opps! No Properties found</h3>
	                @else			
						@foreach($properties as $property)			
							<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">	
								<div class="single-room">
									<!-- The below if statement returns true when the photo relation doesnt exist, dont know why but it works fine -->
									@if(isset($properties->photo))
										<h2>No Image for Property</h2>
									@else
										<img src="{!! url('photo/'.$property->photo[0]->photo_name) !!}" alt="{{$property->photo[0]->photo_name}}" style="width:370px; height:250px ">
									@endif
									<div class="room-overlay">
										<div class="roomdetails-overlay">
											<div class="room-details">
												<span class="room-price">N{{$property->price}}</span>
												<h2>{{$property->property_type}}</h2>	
												<a href="/show/{{$property->id}}" class="readmore-button">View Details</a>	
											</div>							
										</div>
									</div>
								</div>											
							</div>	
						@endforeach						
					@endif
				</div>				
			</div>	
		</div>	
		<!-- Recent Properties End -->	

@stop
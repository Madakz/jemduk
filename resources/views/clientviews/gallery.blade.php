@extends('layouts.clientviewlayout')
@section('content')
		
		<!-- Page Banner Start -->
		<div class="slide-single slide-single-page">
			<div class="overlay"></div>
			<div class="text text-page">
				<div class="this-item">
					<h2>Gallery</h2>
				</div>
			</div>			
		</div>
		<!-- Page Banner End -->

		
		<!-- Gallery Start -->
		<section class="gallery">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						
						<div class="gallery-grid">
							
							<div class="gallery-grid-item">
								<div class="item">
									@if($properties->isEmpty())
										<h3 style="color:black;">No photos yet!</h3>
									@endif
									@foreach($properties as $property)
										<div class="col-md-3">
											<div class="inner">
												<div class="photo">
													<img src="{!! url('photo/'.$property->photo_name) !!}" alt="{{$property->photo_name}}" style="width:218px; height:215px ">
												</div>
												<div class="desc">
													<h4>
														<a class="gallery-photo" href="{!! url('photo/'.$property->photo_name) !!}" alt="{{$property->photo_name}}"><i class="fa fa-search-plus"></i></a>
													</h4>
												</div>				
											</div>					
										</div>
									@endforeach									
								</div>
							</div>							
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Gallery End -->

@stop
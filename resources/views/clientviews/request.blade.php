@extends('layouts.requestlayout')

@section('content')
<section class="team" id="contact">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="heading">
								<h2>Request For Property</h2>
								<div class="border-shape"></div>
							</div>
						</div>
						<div class="col-md-3"></div>						
						<div class="col-md-6 col-sm-5 col-xs-12">
							<div role="form" class="wpcf7" id="wpcf7-f7104-p869-o1" lang="en-US" dir="ltr">
								<div class="screen-reader-response">								
								</div>
									<!-- <form action="#" method="post" class="wpcf7-form" novalidate="novalidate"> -->
									{{Form::open(['route' => 'store_request', 'method' => 'POST', 'class'=>'wpcf7-form'])}}
										@include('layouts.errors')
										<div class="col-md-6">
											<div class="first-name-input">
			        							<label>Full Name</label><br />
			 									<span class="wpcf7-form-control-wrap first-name"><input type="text" name="fullname" value="{{old('fullname')}}" size="40" class="wpcf7-form-control wpcf7-text " aria-required="true" aria-invalid="false" /></span>
			  								</div>
			  								<input type="hidden" name="property_id" value="{{$id}}">
											<div class="email-input">
			        							<label>city/state</label><br />
			  									<span class="wpcf7-form-control-wrap your-email"><input type="text" name="city_state" value="{{old('city_state')}}" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email " aria-required="true" aria-invalid="false" /></span>
			  								</div>
										</div>
										<div class="col-md-6">
											<div class="last-name-input">
			        							<label>Email Address</label><br />
			  										<span class="wpcf7-form-control-wrap last-name">
			  											<input type="email" name="email" value="{{old('email')}}" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" />
			  										</span>
			  								</div>
											<div class="subject-input">
			        							<label>Phone Number</label><br />
												<span class="wpcf7-form-control-wrap your-subject">
													<input type="text" name="phone_number" value="{{old('phone_number')}}" size="40" class="wpcf7-form-control wpcf7-text " aria-required="true" aria-invalid="false" />
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
			  								<input type="submit" value="Place Request &rarr;" class="wpcf7-form-control wpcf7-submit" />
										</div>
								<!-- </form> -->
										
					                {{Form::close()}}
							</div>
						</div>
						<div class="col-md-3 col-sm-1 col-xs-1"></div>
					</div>
					
				</div>
			</section>



@stop
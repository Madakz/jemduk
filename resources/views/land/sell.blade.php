@extends('layouts.main')

@section('header')
    @include('land.header')
@stop

@section('content')
    <div class="col-md-12">
        <div class="col-md-8">
            <div class="widget">
                <header class="widget-header">
                    <h4 class="widget-title">Land Sale Form</h4>
                </header>
                <hr class="widget-separator">
                <div class="widget-body">
                    {{Form::open(array('route' => 'save_land_sale', 'method' => 'POST', 'files'=>true))}}
                        <div class="form-group row">
                            <input type="hidden" name="user_id" value="{{ $hidden_details[1]->id }}">
                            <!-- <input type="hidden" name="draft_date" value="{{ date('m-d-Y') }}"> -->
                            <input type="hidden" name="property_id" value="{{ $hidden_details[0]->id }}">
                            <input type="hidden" name="collector_name" value="{{ $hidden_details[1]->first_name }} {{ $hidden_details[1]->last_name }}">
                            <div class="col-md-6">
                                <label for="surname">Buyer's Surname:</label>
                                <input type="text" class="form-control" placeholder="Surname" name="surname" value="{{ old('surname')}}">
                            </div>
                            <div class="col-md-6">
                                <label for="othername">Buyer's Other Name (s):</label>
                                <input type="text" class="form-control" placeholder="Other Name(s)" name="othernames" value="{{ old('othernames')}}">
                            </div>
                        </div>
                        <br/>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="phone-number">Buyer's Phone Number:</label>
                                <input type="text" class="form-control" placeholder="phone number" name="phone_number" value="{{ old('phone_number')}}">
                            </div>
                            <div class="col-md-6">
                                <label for="payment-method">Payment Method:</label><br/>
                                <input type="radio" name="payment_method" value="cash">  &nbsp;Cash<br/>
                                <input type="radio" name="payment_method" value="cheque">  &nbsp;Cheque<br/>
                                <input type="radio" name="payment_method" value="others"> &nbsp;Others
                            </div>  
                        </div>
                        <br/>
                        <div class="form-group row">
                        	<div class="col-md-6">
                                <label for="buyer-address">Buyer's Address:</label>
                                <textarea rows="4" cols="20" class="form-control" name="client_address" value="{{ old('client_address')}}">{{ old('client_address')}}</textarea>
                            </div> 
                            <div class="col-md-6">
                                <label for="description">House Description:</label>
                                <textarea rows="4" cols="20" class="form-control" name="description" value="{{ $hidden_details[0]->description }}">{{ $hidden_details[0]->description }}</textarea>
                            </div>                   
                        </div>
                        <br/>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="amount_paid">Amount Paid in Figures:</label>
                                <input type="text" class="form-control" placeholder="Amount Paid in Figures" name="amount_paid_figure" value="{{ old('amount_paid_figure')}}">
                            </div>
                            <div class="col-md-6">
                                <label for="amount_paid">Amount Paid in Words:</label>
                                <input type="text" class="form-control" placeholder="Amount Paid in Words" name="amount_paid_words" value="{{ old('amount_paid_words')}}">
                            </div>
                        </div>
                        <br/>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="Suppose_amount">Amount To Be Paid:</label>
                                <input type="text" class="form-control" name="supposed_amount" value="{{ $hidden_details[0]->price }}">
                            </div>
                            <div class="col-md-6">
                                <label for="Balance">Balance Due:</label>
                                <input type="text" class="form-control" placeholder="Balance Due" name="balance_due" value="{{ old('balance_due')}}">
                            </div>
                        </div>
                        <br/>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="Suppose_amount">Landlord's Full Name:</label>
                                <input type="text" class="form-control" name="landlord_name" value="{{ old('landlord_name') }}">
                            </div>                            
                        </div>
                        <br/>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="landlord-witness">Landlord's Witness Fullname:</label>
                                <input type="text" class="form-control" placeholder="witness full name" name="landlord_witness_name" value="{{ old('landlord_witness_name')}}">
                            </div>
                            <div class="col-md-6">
                                <label for="buyer-witness">Buyer's Witness Fullname:</label>
                                <input type="text" class="form-control" placeholder="witness full name" name="client_witness_name" value="{{ old('client_witness_name')}}">
                            </div>
                        </div>                         
                         <br/>
                         <div class="form-group row">                            
                            <div class="col-md-6">
                                <label for="landlord-witness">Landlord's Witness Phone Number:</label>
                                <input type="text" class="form-control" placeholder="witness phone number" name="landlord_witness_phone_number" value="{{ old('landlord_witness_phone_number')}}">
                            </div>
                            <div class="col-md-6">
                                <label for="buyer-witness">Buyer's Witness Phone Number:</label>
                                <input type="text" class="form-control" placeholder="witness phone number" name="client_witness_phone_number" value="{{ old('client_witness_phone_number')}}">
                            </div>
                        </div>                         
                         <br/>
                        <div class="form-group row">                                
                            <div class="col-md-6">
                                <label for="buyer-address">Landlord's Witness Address:</label>
                                <textarea rows="4" cols="20" class="form-control" name="landlord_witness_address" value="{{ old('landlord_witness_address')}}">{{ old('landlord_witness_address')}}</textarea>
                            </div>  
                            <div class="col-md-6">
                                <label for="description">Buyer's Witness Address:</label>
                                <textarea rows="4" cols="20" class="form-control" name="client_witness_address" value="{{ old('client_witness_address') }}">{{ old('client_witness_address') }}</textarea>
                            </div>                    
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary btn-md" style="margin-top:25px;">Submit</button>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @include('layouts.sessions')
            @include('layouts.errors')
        </div>
    </div>
                    
                   
@stop
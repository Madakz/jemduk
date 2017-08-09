@extends('layouts.sell_reciept_layout')
@section('content')
	<div class="col-md-12">
		<?php
			$date=explode(" ", $house[1]->created_at);
		?>
		<p>THIS AGREEMENT FOR SALE is made and executed on this date: {{ $date[0] }}</p>
	    <p><center><b>BETWEEN</b></center></p>
	</div>
    <div class="col-md-12">
	    <p><b>Mr/Mrs/Miss:</b> {{ $house[0]->surname}}  {{ $house[0]->othername }}</p>
	    <p><b>Residing at:</b>  {{ $house[0]->address}}. &nbsp;&nbsp;With</p>
	    <p><b>Phone Number:</b> {{ $house[0]->phone_number}} &nbsp;&nbsp;hereafter called the <b>"SELLER"</b> (which expression shall mean and include his/her legal heirs, successors, successors-in-interest, executors, administrators, legal representatives, attorneys and assigns) of <b>ONE PART</b>.</p>
	    <p><b>Sign: ............................................................</b></p><br/>

	    <p><center><b>AND</b></center></p>
	</div>

    <div class="col-md-12">
	    <p><b>Mr/Mrs/Miss:</b> {{ $house[1]->surname}}  {{ $house[1]->othernames }}</p>
	    <p><b>Residing at:</b>  {{ $house[1]->client_address}}. &nbsp;&nbsp;With</p>
	    <p><b>Phone Number:</b> {{ $house[1]->client_phone_number}} &nbsp;&nbsp;hereafter called the <b>"PURCHASER"</b> (represented by his/her power of attorney, which expression shall mean and include his/her legal heirs, successors, successors-in-interest, executors, administrators, legal representatives, attorneys and assigns) of the <b>OTHER PART</b>.</p>
	    <p><b>Sign: ............................................................</b></p><br/>
	</div>

	<div class="col-md-12">
		<p><b>WHEREAS THE SELLER</b> is the absolute owner in possession and enjoyment of the more fully described in the schedule hereunder and hereafter called the <b>"SCHEDULE PROPERTY"</b>.</p>

	    <p><b>WHEREAS</b> the property more fully described in the schedule hereunder is the self acquired property of the <b>SELLER</b> with <b>Certificate of Occupancy/Right of Occupancy: {{ $house[2]->coo_roo}} &nbsp;&nbsp;</b></p>

	    <p><b>WHEREAS</b> the <b>SELLER</b> is the absolute owner of the property and he has been enjoying the same with absolute right and he has clear and marketable title to the Schedule Property</p>

	    <p><b>WHEREAS</b> the <b>SELLER</b> being in need of funds for the purpose of has decided to sell the property more fully described in the Schedule hereunder and the <b>PURCHASER</b>  has offered to purchase the same.</p>

	    <p><b>WHEREAS</b> the <b>SELLER</b> offered to sell and transfer the schedule property to the <b>PURCHASER</b> for a sale consideration of    <b>N{{ $house[1]->supposed_amount}} &nbsp;&nbsp;</b>     and the <b>PURCHASER</b> herein has agreed to purchase the same for the aforesaid consideration on the following terms and conditions:</p><br/>
	</div>    

    <div class="col-md-12 listing">
	    <p><center><b>NOW THIS AGREEMENT WITNESSETH AS FOLLOWS:</b></center></p>
	    <ul>
	        <li type="i">
	             The Sale consideration of the Schedule Property is fixed at <b>N{{ $house[1]->supposed_amount}}. &nbsp;&nbsp;</b>
	        </li>
	        <li type="i">
	            <b>The PURCHASER</b> has paid  a sum of <b>N{{ $house[1]->amount_paid_figure}} &nbsp;&nbsp;</b>   (<b>N{{ $house[1]->amount_paid_words}} only&nbsp;&nbsp;</b>only) by cash/ cheque /others. bearing  
	            No: ............................................................................................................................
	            <br/> drawn on: ............................................................................................................................
	             <br/>  dated: ........................................................................................... ,<br/> the receipt of which sum the <b>SELLER hereby acknowledges</b>.
	        </li>
	        <li type="i">
	            The balance payment of <b>N{{ $house[1]->balance_due}}. &nbsp;&nbsp;</b> will be paid by the <b>PURCHASER</b> to the <b>SELLER</b> at the time of execution of the absolute Sale Deed and thus completing  the Sale transaction.
	        </li>
	        <li type="i">
	            The parties herein covenant to complete the Sale transaction and to execute the Absolute Sale Deed, dated for:............................................................................................
	        </li>
	        @include('layouts.conditions')    

        <!-- closing <ul> and <div> tag is in conditions.blade.php -->
        
    <div class="col-md-12"><p><center><b>WITNESSES:</b></center></p></div>

    <div class="col-md-12">
    	<p><b>PUCHASER</b></p>
    	<div class="row">
    		<div class="col-md-6">
	    		<p><b>Name: {{ $house[1]->client_witness_name}}. &nbsp;&nbsp;</b></p>   
	    	</div>
	    	<div class="col-md-6">
	    		<p><b>Phone Number: {{ $house[1]->client_witness_phone_number}}. &nbsp;&nbsp;</b></p>
	    	</div>
	    	<div class="col-md-6">
		    	<p><b>Address: {{ $house[1]->client_witness_address}}. &nbsp;&nbsp;</b></p>
		    </div>
		    <div class="col-md-6">
		    	<p><b>Sign: ............................................................</b></p><br/>
		    </div>
    	</div>    	
    </div>
   	<div class="col-md-12">
    	<p><b>SELLER</b></p>
    	<div class="row">
    		<div class="col-md-6">
	    		<p><b>Name: {{ $house[1]->landlord_witness_name}}. &nbsp;&nbsp;</b></p> 
	    	</div>
	    	<div class="col-md-6">
	    		<p><b>Phone Number: {{ $house[1]->landlord_witness_phone_number}}. &nbsp;&nbsp;</b></p>
	    	</div>
	    	<div class="col-md-6">
		    	<p><b>Address: {{ $house[1]->landlord_witness_address}}. &nbsp;&nbsp;</b></p>
		    </div>
		    <div class="col-md-6">
		    	<p><b>Sign: ............................................................</b></p>
		    </div>
    	</div>    	
    </div>
@stop
<?php
	// dd($house);
?>
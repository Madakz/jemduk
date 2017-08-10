@extends('layouts.rent_lease_reciept_layout')
@section('content')
	<div class="col-md-12">
		<?php
			$date=explode(" ", $house[1]->created_at);
			$reciept_no = $house[1]->id;
			$add_zero=strlen($house[1]->id);
			if($add_zero < '4'){			//checks if the id is less than 4
				$add_zero=4 - $add_zero;
				for ($i=0; $i < $add_zero; $i++) { 		//concatenate with zero based on the length of the id
					$reciept_no='0'.$reciept_no;
				}
			}
		?>

		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Date:</b> {{ $date[0] }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Receipt NO:</b> {{ $reciept_no }}</p>
	</div>
	<div class="col-md-12">
		<p><b>Recieved From:</b> {{ $house[1]->surname }} {{ $house[1]->othernames }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>the sum of</b> N{{ $house[1]->amount_paid_figure }}</p>
		<p>({{ $house[1]->amount_paid_words }} naira only)</p>
		<p><b>With Phone number: {{ $house[1]->phone_number }} </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>For Payment of </b> {{ $house[2]->scope }} </p>
		<p><b>From:</b> {{ $house[1]->from_date }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>To:</b> {{ $house[1]->to_date }} </p>
		<p><b>Payment Method:</b></p>
		@if($house[1]->payment_category == 'cash')
			<p><input type="checkbox" checked=""> Cash <input type="checkbox"> Cheque No.: .................................... <input type="checkbox"> Others</p>
		@elseif($house[1]->payment_category == 'cheque')
			<p><input type="checkbox"> Cash <input type="checkbox" checked=""> Cheque No.: .................................... <input type="checkbox"> Others</p>
		@elseif($house[1]->payment_category == 'others')
			<p><input type="checkbox"> Cash <input type="checkbox"> Cheque No.: .................................... <input type="checkbox" checked=""> Others</p>
		@endif
		<hr/>
		<table>
			<tr>
				<td>Total Amount To Be Recieved</td>
				<td>{{ $house[1]->supposed_amount }}</td>
			</tr>
			<tr>
				<td>Amount Recieved</td>
				<td>{{ $house[1]->amount_paid_figure }}</td>
			</tr>
			<tr>
				<td>Balance Due</td>
				<td>{{ $house[1]->balance_due }}</td>
			</tr>                    			
		</table>
		<hr/>
			<p><b>Recieved By:  </b>{{ $house[0]->surname }} {{ $house[0]->othername }}</p>
    		<p><b>Address: </b>{{ $house[0]->address }}</p>
    		<p><b>Phone Number:</b>  {{ $house[0]->phone_number }}</p>
    		<p><b>Signature:</b>.....................................................&nbsp;&nbsp;  <b>Tenant Signature:</b>..............................................</p>
		
	</div>
@stop
<?php
	// dd($house);
?>
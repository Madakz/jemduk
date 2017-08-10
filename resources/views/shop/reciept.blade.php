@extends('layouts.rent_lease_reciept_layout')
@section('content')
	<div class="col-md-12">
		<?php
			$date=explode(" ", $shop[1]->created_at);
			$reciept_no = $shop[1]->id;
			$add_zero=strlen($shop[1]->id);
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
		<p><b>Recieved From:</b> {{ $shop[1]->surname }} {{ $shop[1]->othernames }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>the sum of</b> N{{ $shop[1]->amount_paid_figure }}</p>
		<p>({{ $shop[1]->amount_paid_words }} naira only)</p>
		<p><b>With Phone number: {{ $shop[1]->phone_number }} </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>For Payment of </b> {{ $shop[2]->scope }} </p>
		<p><b>From:</b> {{ $shop[1]->from_date }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>To:</b> {{ $shop[1]->to_date }} </p>
		<p><b>Payment Method:</b></p>
		@if($shop[1]->payment_category == 'cash')
			<p><input type="checkbox" checked=""> Cash <input type="checkbox"> Cheque No.: .................................... <input type="checkbox"> Others</p>
		@elseif($shop[1]->payment_category == 'cheque')
			<p><input type="checkbox"> Cash <input type="checkbox" checked=""> Cheque No.: .................................... <input type="checkbox"> Others</p>
		@elseif($shop[1]->payment_category == 'others')
			<p><input type="checkbox"> Cash <input type="checkbox"> Cheque No.: .................................... <input type="checkbox" checked=""> Others</p>
		@endif
		<hr/>
		<table>
			<tr>
				<td>Total Amount To Be Recieved</td>
				<td>{{ $shop[1]->supposed_amount }}</td>
			</tr>
			<tr>
				<td>Amount Recieved</td>
				<td>{{ $shop[1]->amount_paid_figure }}</td>
			</tr>
			<tr>
				<td>Balance Due</td>
				<td>{{ $shop[1]->balance_due }}</td>
			</tr>                    			
		</table>
		<hr/>
			<p><b>Recieved By:  </b>{{ $shop[0]->surname }} {{ $shop[0]->othername }}</p>
    		<p><b>Address: </b>{{ $shop[0]->address }}</p>
    		<p><b>Phone Number:</b>  {{ $shop[0]->phone_number }}</p>
    		<p><b>Signature:</b>.....................................................&nbsp;&nbsp;  <b>Tenant Signature:</b>..............................................</p>
		
	</div>
@stop
<?php
	// dd($shop);
?>
<?php
	// dd($shop);
?>
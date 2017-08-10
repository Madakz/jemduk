@extends('layouts.rent_lease_reciept_layout')
@section('content')
    <div class="col-md-12">
        <?php
            $date=explode(" ", $land[1]->created_at);
            $reciept_no = $land[1]->id;
            $add_zero=strlen($land[1]->id);
            if($add_zero < '4'){            //checks if the id is less than 4
                $add_zero=4 - $add_zero;
                for ($i=0; $i < $add_zero; $i++) {      //concatenate with zero based on the length of the id
                    $reciept_no='0'.$reciept_no;
                }
            }
        ?>

        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Date:</b> {{ $date[0] }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Receipt NO:</b> {{ $reciept_no }}</p>
    </div>
    <div class="col-md-12">
        <p><b>Recieved From:</b> {{ $land[1]->surname }} {{ $land[1]->othernames }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>the sum of</b> N{{ $land[1]->amount_paid_figure }}</p>
        <p>({{ $land[1]->amount_paid_words }} naira only)</p>
        <p><b>With Phone number: {{ $land[1]->phone_number }} </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>For Payment of </b> {{ $land[2]->scope }} </p>
        <p><b>From:</b> {{ $land[1]->from_date }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>To:</b> {{ $land[1]->to_date }} </p>
        <p><b>Payment Method:</b></p>
        @if($land[1]->payment_category == 'cash')
            <p><input type="checkbox" checked=""> Cash <input type="checkbox"> Cheque No.: .................................... <input type="checkbox"> Others</p>
        @elseif($land[1]->payment_category == 'cheque')
            <p><input type="checkbox"> Cash <input type="checkbox" checked=""> Cheque No.: .................................... <input type="checkbox"> Others</p>
        @elseif($land[1]->payment_category == 'others')
            <p><input type="checkbox"> Cash <input type="checkbox"> Cheque No.: .................................... <input type="checkbox" checked=""> Others</p>
        @endif
        <hr/>
        <table>
            <tr>
                <td>Total Amount To Be Recieved</td>
                <td>{{ $land[1]->supposed_amount }}</td>
            </tr>
            <tr>
                <td>Amount Recieved</td>
                <td>{{ $land[1]->amount_paid_figure }}</td>
            </tr>
            <tr>
                <td>Balance Due</td>
                <td>{{ $land[1]->balance_due }}</td>
            </tr>                               
        </table>
        <hr/>
            <p><b>Recieved By:  </b>{{ $land[0]->surname }} {{ $land[0]->othername }}</p>
            <p><b>Address: </b>{{ $land[0]->address }}</p>
            <p><b>Phone Number:</b>  {{ $land[0]->phone_number }}</p>
            <p><b>Signature:</b>.....................................................&nbsp;&nbsp;  <b>Tenant Signature:</b>..............................................</p>
        
    </div>
@stop
<?php
    // dd($land);
?>
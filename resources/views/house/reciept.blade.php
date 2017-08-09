<?php
    $logged_user = Sentinel::getUser();
    $user_role = Sentinel::getUser()->roles->first();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">        
        <!-- Favicon -->
		<link rel="icon" type="image/png" href="{{{asset('/clientviews/img/jemduk.png')}}}">
        <title>Jemduk</title>        
        <link rel="stylesheet" href="{{{asset('/clientviews/css/bootstrap_reciept.min.css')}}}">
		<link rel="stylesheet" href="{{{asset('/clientviews/css/bootstrap-datepicker.min.css')}}}">
		<link rel="stylesheet" href="{{{asset('/clientviews/css/superfish.css')}}}">
		<link rel="stylesheet" href="{{{asset('/clientviews/css/slicknav.css')}}}">
		<link rel="stylesheet" href="{{{asset('/clientviews/css/animate.css')}}}">
		<link rel="stylesheet" href="{{{asset('/clientviews/css/jquery.bxslider.css')}}}">
		<link rel="stylesheet" href="{{{asset('/clientviews/css/hover.css')}}}">
		<link rel="stylesheet" href="{{{asset('/clientviews/css/magnific-popup.css')}}}">
		<link href="{{{asset('/clientviews/font-awesome/css/font-awesome.min.css')}}}" rel="stylesheet" type="text/css">
		<link href="{{{asset('/clientviews/material-design-iconic-font/css/material-design-iconic-font.min.css')}}}" rel="stylesheet" type="text/css">
        <style>
            .logo{
                /*margin-left: 1px;*/
            }
            .doc-title {
                padding-top: 20px;
                font-size: 20px;
                font-weight: bold;
                margin-bottom: 10px;
            }
            table, th, td {
               border: 1px solid black;
               width: 100%;
            }
            .listing ul li{
                margin-left: 13px;
            }
            body{
            	background-color: #D6DBE0;
            }
        </style>
    </head>
    <body>
        <div class="col-md-row">
            <div class="col-md-3 side"></div>
                <div class="col-md-6" style="background-color:#ffffff;">
                    <div class="row">
                        <div class="col-md-2 logo">
                            <img src="{{ asset('/clientviews/img/jemduk.png')}}" alt="jemduk" style="width:80px; height:80px ">
                        </div>
                        @if(isset($house) && $house[2]->scope== 'Rent')
                            <div class="col-md-9 doc-title">
                                <center>HOUSE RENT RECIEPT</center>
                            </div>
                        <!-- @elseif(isset($land))
                            <div class="col-md-9 title_adjust">
                                PURCHASE AND SALE AGREEMENT FOR {{ strtoupper($land[2]->property_type) }}
                            </div>
                        @elseif(isset($shop))
                            <div class="col-md-9 title_adjust">
                                PURCHASE AND SALE AGREEMENT FOR {{ strtoupper($shop[2]->property_type) }}
                            </div> -->
                        @endif
                        <div class="col-md-1"></div>
                    </div>
                    <div class="row content">
                    	<!-- @yield('content') -->
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
                        <!-- @yield('content') -->
                    </div> 
                    <br/>
                    <div class="row">
                    	<div class="col-md-4"></div>
                        <div class="col-md-4">
                            <button class="form-control btn btn-primary" onclick="print()"><i class="menu-icon zmdi zmdi-print zmdi-hc"></i> Print</button>
                        </div>
                        <div class="col-md-4"></div>
                        <br/>
                        <br/>
                    </div> 
                    <br/>                                       
                </div>
                <?php
					// dd($house);
				?>
            <div class="col-md-3 side"></div>
        </div>       
    </body>
    @include('layouts.scriptlinks')
</html>
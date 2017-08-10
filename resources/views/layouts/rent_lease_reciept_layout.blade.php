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
                        @elseif(isset($house) && $house[2]->scope== 'Lease')
                        	<div class="col-md-9 doc-title">
                                <center>HOUSE LEASE RECIEPT</center>
                            </div>
                        @elseif(isset($land) && $land[2]->scope == 'Rent')
                            <div class="col-md-9 doc-title">
                                <center>LAND RENT RECIEPT</center>
                            </div>
                        @elseif(isset($land) && $land[2]->scope == 'Lease')
                            <div class="col-md-9 doc-title">
                                <center>LAND LEASE RECIEPT</center>
                            </div>
                        @elseif(isset($shop) && $shop[2]->scope == 'Rent')
                            <div class="col-md-9 doc-title">
                                <center>SHOP RENT RECIEPT</center>
                            </div>
                        @elseif(isset($shop) && $shop[2]->scope == 'Lease')
                            <div class="col-md-9 doc-title">
                                <center>SHOP LEASE RECIEPT</center>
                            </div>
                        @endif
                        <div class="col-md-1"></div>
                    </div>
                    <div class="row content">
                    	@yield('content')
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
            <div class="col-md-3 side"></div>
        </div>       
    </body>
    @include('layouts.scriptlinks')
</html>
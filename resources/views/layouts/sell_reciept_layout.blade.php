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
        <title>Jemduk</title>        
        @include('layouts.csslinks')
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
            .doc-title .title_adjust{
                /*padding-top: 60px;*/
                /*margin-left: 150px;*/
            }
            .listing ul li{
                margin-left: 13px;
            }
        </style>
    </head>
    <body>
        <div class="col-md-row">
            <div class="col-md-3"></div>
                <div class="col-md-6" style="background-color:#ffffff;">
                    <div class="row doc-title">
                        <div class="col-md-3 logo">
                            <img src="{{ asset('/clientviews/img/jemduk.png')}}" alt="jemduk" style="width:80px; height:80px ">
                        </div>
                        @if(isset($house))
                            <div class="col-md-9 title_adjust">
                                PURCHASE AND SALE AGREEMENT FOR {{ strtoupper($house[2]->property_type) }}
                            </div>
                        @elseif(isset($land))
                            <div class="col-md-9 title_adjust">
                                PURCHASE AND SALE AGREEMENT FOR {{ strtoupper($land[2]->property_type) }}
                            </div>
                        @elseif(isset($shop))
                            <div class="col-md-9 title_adjust">
                                PURCHASE AND SALE AGREEMENT FOR {{ strtoupper($shop[2]->property_type) }}
                            </div>
                        @endif
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
            <div class="col-md-3"></div>
        </div>       
    </body>
    @include('layouts.scriptlinks')
</html>
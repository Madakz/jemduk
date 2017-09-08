@extends('layouts.main')

@section('header')
    @include('property.header')
@stop

@section('content')
	<style>
    	div.panel.panel-primary {
    		border-color: #188ae2;
    		background-color: #188ae2;
		}
		div.panel.panel-ash {
    		border-color: #8594A3;
    		background-color: #8594A3;
		}
		div.panel.panel-green {
    		border-color: #78b83e;
    		background-color: #78b83e;
		}
		div .panel {
		    margin-bottom: 20px;
		    /*background-color: #fff;*/
		    border: 1px solid transparent;
		    border-radius: 4px;
		    -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
		    box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14),0 3px 1px -2px rgba(0,0,0,0.2),0 1px 5px 0 rgba(0,0,0,0.12);
		}
		div .panel .panel-heading {
			color: #fff;
		    padding: 10px 15px;
		    border-bottom: 1px solid transparent;
		    border-top-left-radius: 3px;
		    border-top-right-radius: 3px;
		}
		.text-right {
		    text-align: right;
		}
		div .huge {
		    font-size: 40px;
		}
		div .panel-footer {
		    padding: 10px 15px;
		    background-color: #f5f5f5;
		    border-top: 1px solid #ddd;
		    border-bottom-right-radius: 3px;
		    border-bottom-left-radius: 3px;
		}

	</style>
	<div class="col-md-12">
    	<h1>Agent Dashboard</h1>
    </div>

    <div class="col-lg-4 col-md-col-md-4 col-sm-6 col-xs-12">
        <div class="panel panel-ash">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{$dashboard[2]}}</div>
                        <div>Landlords</div>
                    </div>
                </div>
            </div>
            <a href="{{route('landlord_index')}}">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-fort-awesome fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{$dashboard[0]}}</div>
                        <div>Houses</div>
                    </div>
                </div>
            </div>
            <a href="{{ route('house_index') }}">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-square fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{$dashboard[1]}}</div>
                        <div>Lands</div>
                    </div>
                </div>
            </div>
            <a href="{{ route('land_index') }}">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="panel panel-ash">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="zmdi zmdi-city zmdi-hc-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{$dashboard[3]}}</div>
                        <div>Shops</div>
                    </div>
                </div>
            </div>
            <a href="{{ route('shop_index') }}">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-pdf-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">0</div>
                        <div>Uploaded Documents</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
@stop
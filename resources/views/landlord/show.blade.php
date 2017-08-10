@extends('layouts.main')

@section('header')
    @include('landlord.header')
@stop

@section('styles')
    <link rel="stylesheet" type="text/css" href="/infinity/assets/libs/misc/datatables/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="/infinity/assets/libs/bower/switchery/dist/switchery.min.css">
    <link rel="stylesheet" type="text/css" href="/infinity/assets/libs/bower/lightbox2/dist/css/lightbox.min.css">
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <a href="{{route('create_landlord')}}">
                <button type="button" class="btn btn-primary" >
                    <i class="menu-icon zmdi zmdi-account-add zmdi-hc-lg"></i>
                    <span>    Add landlords</span>
                </button>
            </a>
        </div>
    </div>
    <br/>


    <section class="app-content">
        <div class="row">
            <div class="col-md-12">
                <div class="widget">
                    <div class="col-md-4">
                        <header class="widget-header">                           
                            <h3 class="widget-title"><b>{{$landlords->surname}} &nbsp; {{$landlords->othername}} </b>Profile</h3>
                        </header>
                    </div>
                    <div class="col-md-8"></div>
                    <div class="col-md-12"><hr class="widget-separator"></div>
                    <div class="col-md-12" style="padding-left:0px;">
                        <div class="widget-body">
                            <div class="col-md-4">                                
                                <img class="img-thumbnail" src="{{ url('photo/'.$landlords->picture) }}" alt="{{ $landlords->picture}}" style="margin-top:13px; height:200px; width:200px;">
                                
                            </div>
                            <div class="col-md-4">
                                <h4><b>Contact Information</b></h4>                             
                                <h5><strong>Phone Number:</strong> {{$landlords->phone_number}}</h5>                    
                                <h5><strong>Email:</strong> {{$landlords->email}}</h5>
                                <br/>

                                <h4><b>General Information</b></h4>
                                <h5><strong>Gender:</strong> {{$landlords->gender}}</h5>
                                <h5><strong>State:</strong> {{$landlords->state}}</h5>
                                <h5><strong>Local Government:</strong> {{$landlords->local_govt}}</h5>
                                <h5><strong>Address:</strong> {{$landlords->address}}</h5>
                                <h5><strong>Account Number:</strong> {{$landlords->bank_account}}</h5>
                                <h5><strong>Bank Name:</strong> {{$landlords->bank_name}}</h5>
                            </div>                          
                            <div class="col-md-4">                                
                                <h4 style="padding-left:35px;"><b>Actions</b></h4>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <a data-toggle="modal" href="{{ route('edit_landlord', [$landlords->id])}}" id="edit-bu-btn" style="cursor:pointer;">
                                            <button type="submit" class="btn btn-primary btn-md"><i class="menu-icon zmdi zmdi-edit zmdi-hc"></i> Edit Profile</button>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <a data-toggle="modal" data-target="#modal_add_{{$landlords->id}}" id="delete-bu-btn" style="cursor:pointer;">
                                            <button type="submit" class="btn btn-success btn-md"><i class="menu-icon zmdi zmdi-plus-square zmdi-hc"></i> Add Property</button> 
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <a data-toggle="modal" data-target="#modal_delete_{{$landlords->id}}" id="delete-bu-btn" style="cursor:pointer;">
                                            <button type="submit" class="btn btn-danger btn-md"><i class="menu-icon zmdi zmdi-delete zmdi-hc"></i> Delete Profile</button> 
                                        </a>
                                    </div>
                                </div>   

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <a data-toggle="modal" href="{{ route('all_property', [$landlords->id])}}" style="cursor:pointer;">
                                            <button type="submit" class="btn btn-success btn-md"><i class="menu-icon zmdi zmdi-zoom-in zmdi-hc"></i> View All My Property</button> 
                                        </a>
                                    </div>
                                </div>                             
                            </div>
                        </div>
                    </div>
                    <div class="widget-body">
                        <div class="form-group">                            
                                @include('landlord.modals.delete')

                        </div>
                    </div>
                    <!-- modal for adding property -->
                    <div class="row">
                        <div class="modal fade m-medium" id="modal_add_{{$landlords->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-delete-house">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Add Property</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="modal-body">
                                            <a href="{{ route('create_house_from_landlord', $landlords->id)}}" class="btn btn-fill btn-success float-left"><i class="menu-icon zmdi zmdi-delete zmdi-hc"></i> Add House</a>
                                            <a href="{{ route('create_land_from_landlord', $landlords->id)}}" class="btn btn-fill btn-primary relative"><i class="menu-icon zmdi zmdi-delete zmdi-hc"></i> Add Land</a>
                                            <a href="{{ route('create_shop_from_landlord', $landlords->id)}}" class="btn btn-fill btn-success relative"><i class="menu-icon zmdi zmdi-delete zmdi-hc"></i> Add Shop</a>
                                            <!-- <p class="s-text">Remove Landlord from your list of Landlord? </br><span class="p-text">This cannot be undone.</span></p> -->
                                            <!-- <p class="s-text"><span><a href="{{ route('delete_landlord', $landlords->id)}}" class="btn btn-fill btn-danger relative"><i class="menu-icon zmdi zmdi-delete zmdi-hc"></i> Delete</a></span>&nbsp;<span><a href="{{ route('delete_landlord', $landlords->id)}}" class="btn btn-fill btn-danger pull-right"><i class="menu-icon zmdi zmdi-delete zmdi-hc"></i> Delete</a></span><span><a href="{{ route('delete_landlord', $landlords->id)}}" class="btn btn-fill btn-danger pull-right"><i class="menu-icon zmdi zmdi-delete zmdi-hc"></i> Delete</a></span></p> -->
                                    
                                        </div>
                                    
                                        <!-- <div class="col-md-4">
                                            <a href="{{ route('delete_landlord', $landlords->id)}}" class="btn btn-fill btn-danger pull-right"><i class="menu-icon zmdi zmdi-delete zmdi-hc"></i> Delete</a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="{{ route('delete_landlord', $landlords->id)}}" class="btn btn-fill btn-danger pull-right"><i class="menu-icon zmdi zmdi-delete zmdi-hc"></i> Delete</a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="{{ route('delete_landlord', $landlords->id)}}" class="btn btn-fill btn-danger pull-right"><i class="menu-icon zmdi zmdi-delete zmdi-hc"></i> Delete</a>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
@stop
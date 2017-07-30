@extends('layouts.main')

@section('header')
    @include('user.header')
@stop

@section('styles')
    <link rel="stylesheet" type="text/css" href="/infinity/assets/libs/misc/datatables/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="/infinity/assets/libs/bower/switchery/dist/switchery.min.css">
    <link rel="stylesheet" type="text/css" href="/infinity/assets/libs/bower/lightbox2/dist/css/lightbox.min.css">
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <a href="{{route('register')}}">
                <button type="button" class="btn btn-primary" >
                    <i class="menu-icon zmdi zmdi-account-add zmdi-hc-lg"></i>
                    <span>    Add Agent</span>
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
                            <h3 class="widget-title"><b>{{$users->first_name}}&nbsp; {{$users->last_name}} </b>Profile</h3>
                        </header>
                    </div>
                    <div class="col-md-8"></div>
                    <div class="col-md-12"><hr class="widget-separator"></div>
                    <div class="col-md-12" style="padding-left:0px;">
                        <div class="widget-body">
                            <div class="col-md-4">                                
                                <img class="thumbnail" src="{!! url('photo/'.$users->picture) !!}" alt="{{ $users->picture}}" style="margin-top:13px; height:200px; width:200px;">
                                <!-- <h3 style="margin-left:25px;"><strong>Role:</strong> {{$users->status}}</h3> -->
                            </div>
                            <div class="col-md-4">
                                <h4><b>Contact Information</b></h4>                             
                                <h5><strong>Phone Number:</strong> {{$users->phone_number}}</h5>                    
                                <h5><strong>Email:</strong> {{$users->email}}</h5>
                                <br/>

                                <h4><b>General Information</b></h4>
                                <h5><strong>User Role:</strong> {{$users->status}}</h5>
                                <h5><strong>Address:</strong> {{$users->address}}</h5>
                                <h5><strong>Agent Number:</strong> {{$users->agent_number}}</h5>
                            </div>
                           <!--  <div class="col-md-4">                                
                                <h4 style="border-color:yellow;"><b>Actions</b></h4>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <a data-toggle="modal" href="{{ route('edit_agent', [$users->id])}}" id="edit-bu-btn" style="cursor:pointer;">
                                            <button type="submit" class="btn btn-primary btn-md"><i class="menu-icon zmdi zmdi-edit zmdi-hc"></i> Edit Profile</button>
                                        </a>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <a data-toggle="modal" data-target="#modal_delete_{{$users->id}}" id="delete-bu-btn" style="cursor:pointer;margin-left:10px;">
                                            <button type="submit" class="btn btn-danger btn-md"><i class="menu-icon zmdi zmdi-delete zmdi-hc"></i> Delete Profile</button> 
                                        </a>
                                    </div>

                                </div>
                            </div> -->
                            <div class="col-md-4">                                
                                <h4 style="padding-left:35px;"><b>Actions</b></h4>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <a data-toggle="modal" href="{{ route('edit_agent', [$users->id])}}" id="edit-bu-btn" style="cursor:pointer;">
                                            <button type="submit" class="btn btn-primary btn-md"><i class="menu-icon zmdi zmdi-edit zmdi-hc"></i> Edit Profile</button>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <a data-toggle="modal" data-target="#modal_delete_{{$users->id}}" id="delete-bu-btn" style="cursor:pointer;">
                                            <button type="submit" class="btn btn-danger btn-md"><i class="menu-icon zmdi zmdi-delete zmdi-hc"></i> Delete Profile</button> 
                                        </a>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <div class="widget-body">
                        <div class="form-group">                            
                                @include('user.modals.delete')

                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
@stop
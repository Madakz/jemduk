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
        <!-- <div class="col-md-12">
            <a href="{{route('register')}}">
                <button type="button" class="btn btn-primary" >
                    <i class="menu-icon zmdi zmdi-account-add zmdi-hc-lg"></i>
                    <span>    Add Agent</span>
                </button>
            </a>
        </div> -->
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
                            <div>
                                @if(isset($success))
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        {{ $success }}
                                    </div>
                                @endif
                            </div>
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
                                <h5><strong>User Role:</strong><?php $status=ucfirst($users->status); ?> {{$status}}</h5>
                                <h5><strong>Address:</strong> {{$users->address}}</h5>
                                <h5><strong>Agent Number:</strong> {{$users->agent_number}}</h5>
                            </div>
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
                                <?php if(Sentinel::getUser()->id == $users->id){
                                    $id=Sentinel::getUser()->id;
                                ?>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <a data-toggle="modal" data-target="#modal_add_{{$id}}" id="delete-bu-btn" style="cursor:pointer;">
                                                <button type="submit" class="btn btn-success btn-md"><i class="menu-icon zmdi zmdi-edit zmdi-hc"></i> Change Password</button> 
                                            </a>
                                        </div>
                                    </div>   

                                    <!-- modal for changing password -->
                                    <div class="row">
                                        <div class="modal fade m-medium" id="modal_add_{{$id}}" tabindex="-1" role="dialog" aria-labelledby="modal-delete-house">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Change Password</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="modal-body">
                                                            {{Form::open(['route' => ['change_password', $id], 'method' => 'put'])}}
                                                                <input type="hidden" name="user_id" value="{{ $id }}">
                                                                <label>New Password:</label>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="password" value=""><br/>
                                                                <br/><label>Confirm Password:</label>
                                                                    <input type="password" name="confirmpassword" value=""><br/><br/>
                                                                    <input type="submit" name="submit" class="btn btn-success" value="submit">     
                                                            {{Form::close()}}
                                                                                       
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- modal for changing password -->
                                <?php } ?>                            
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
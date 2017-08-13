<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Jemduk</title>
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
        <meta name="description" content="Admin, Dashboard, Bootstrap">
        <link rel="shortcut icon" sizes="196x196" href="/infinity/assets/images/logo.png">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" />
        <link rel="stylesheet" href="/infinity/assets/libs/bower/animate.css/animate.min.css">
        <link rel="stylesheet" href="/infinity/assets/css/bootstrap.css">
        <link rel="stylesheet" href="/infinity/assets/css/core.css">
        <link rel="stylesheet" href="/infinity/assets/css/misc-pages.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
    </head>
    <body class="simple-page col-md-12">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="simple-page-wrap">
                    <div class="simple-page-logo animated swing row">
                        <div class="col-md-4">
                            <div class="row">
                                <a href="" class="btn btn-outline btn-default" onclick="back()">
                                    <i class="zmdi zmdi-arrow-left"></i>
                                </a>&nbsp;
                                @if (Sentinel::getUser()->roles->first()->slug == 'superadmin')
                                    <a href="{{route('superadmin_dash')}}" class="btn btn-outline btn-default">
                                        <i class="fa fa-home animated zoomIn"></i>
                                    </a>
                                @elseif(Sentinel::getUser()->roles->first()->slug == 'admin')
                                    <a href="{{route('admin_dash')}}" class="btn btn-outline btn-default">
                                        <i class="fa fa-home animated zoomIn"></i>
                                    </a>
                                @elseif(Sentinel::getUser()->roles->first()->slug == 'agent')
                                    <a href="{{route('agent_dash')}}" class="btn btn-outline btn-default">
                                        <i class="fa fa-home animated zoomIn"></i>
                                    </a>
                                @endif
                            </div>                            
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('home') }}">                                
                                <span>Jemduk</span>
                            </a>
                        </div>
                    </div>
                    <div class="simple-page-form animated flipInY" id="signup-form">
                        <h4 class="form-title m-b-xl text-center">Edit Agent</h4>
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissable" role="alert">
                                {{ session('success')}}
                            </div>
                        @elseif(session('error'))
                            <div class="alert alert-danger alert-dismissable" role="alert">
                                {{ session('error')}}
                            </div>
                        @endif                
                        {{Form::open(['route' => ['update_agent', $users->id], 'method' => 'PUT', 'files'=>true])}}
                            <!-- <div class="form-group">
                                <input type="file" name="picture" value="{{old('picture')}}" class="form-control">
                            </div> -->
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="form-group col-md-6 col-xs-12 col-lg-6">
                                    <label for="first_name">First Name:</label>
                                    <input id="first_name" name="first_name" type="text" class="form-control" placeholder="Firstame" value="{{$users->first_name}}">
                                </div>
                                <div class="form-group col-md-6 col-xs-12 col-lg-6">
                                    <label for="first_name">Last Name:</label>
                                    <input id="last_name" name="last_name" type="text" class="form-control" placeholder="Lastname" value="{{$users->last_name}}">
                                </div>
                            </div>                    
                            <div class="row">
                                <div class="form-group col-md-6 col-xs-12 col-lg-6">
                                    <label for="first_name">Email:</label>
                                    <input id="email" name="email" type="email" class="form-control" placeholder="Email Address" value="{{$users->email}}">
                                </div>
                                <div class="form-group col-md-6 col-xs-12 col-lg-6">
                                    <label for="first_name">Phone Number:</label>
                                    <input id="phone_number" name="phone_number" type="text" class="form-control" placeholder="Phone Number" value="{{$users->phone_number}}">
                                </div>
                            </div>

                            <div class="row">
                                <input type="hidden" name="status" value="agent">
                                <!-- <div class="form-group col-md-6 col-xs-6 col-lg-6">
                                    <label for="first_name">User Status:</label>
                                    <select name="status" class="form-control" value="{{$users->status}}">                              
                                        <option value="">User Status</option>
                                        <option value="landlord">Landlord</option>
                                        <option value="agent">Agent</option>
                                    </select>
                                </div>                        
                                <div class="form-group col-md-6 col-xs-6 col-lg-6">
                                    <label for="first_name">User Role:</label>
                                    <select name="user_role" class="form-control">
                                        <option value="">Select user role</option>
                                        <option value="admin">Admin</option>
                                        <option value="agent">Agent</option>
                                        <option value="landlord">Landlord</option>
                                    </select>
                                </div> -->
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12 col-xs-12 col-lg-12">
                                    <label for="first_name">Address:</label>
                                    <input id="address" name="address" type="text" class="form-control" placeholder="Address" value="{{$users->phone_number}}">
                                </div>                        
                            </div>              
                            <input type="submit" class="btn btn-primary" value="Update Agent">
                            <br/><br/>
                            @include('layouts.errors')
                        {{Form::close()}}
                    </div>
                </div>
                <!-- <div class="simple-page-footer">
                    <p>
                        <small>Do you have an account ?</small> <a href="{{ route('login') }}">SIGN IN</a>
                    </p>
                </div> -->
            </div>
            <div class="col-md-4"></div>            
        </div>
        @include('layouts.sessions')
    </body>
    <script>
        function back(){
            window.history.back(-1);
        }
    </script>
</html>
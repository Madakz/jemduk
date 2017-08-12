<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Jemduk</title>
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
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
                                <a href="{{ route('home') }}" class="btn btn-outline btn-default">
                                    <i class="fa fa-home animated zoomIn"></i>
                                </a>
                            </div>                            
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('home') }}">                                
                                <span>Jemduk</span>
                            </a>
                        </div>
                    </div>
                    <div class="simple-page-form animated flipInY" id="signup-form">
                        <h4 class="form-title m-b-xl text-center">Sign Up For a new Account</h4>
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ session('success')}}
                            </div>
                        @elseif(session('error'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ session('error')}}
                            </div>
                        @endif
                        {{Form::open(['route' => 'store_user', 'method' => 'POST', 'files'=>true])}}
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="file" name="picture" value="{{old('picture')}}" class="form-control">
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-xs-6 col-lg-6">
                                    <input id="first_name" name="first_name" type="text" class="form-control" placeholder="Firstame" value="{{old('first_name')}}">
                                </div>
                                <div class="form-group col-md-6 col-xs-6 col-lg-6">
                                    <input id="last_name" name="last_name" type="text" class="form-control" placeholder="Lastname" value="{{old('last_name')}}">
                                </div>
                            </div>                    
                            <div class="row">
                                <div class="form-group col-md-6 col-xs-6 col-lg-6">
                                    <input id="email" name="email" type="email" class="form-control" placeholder="Email Address" value="{{old('email')}}">
                                </div>
                                <div class="form-group col-md-6 col-xs-6 col-lg-6">
                                    <input id="phone_number" name="phone_number" type="text" class="form-control" placeholder="Phone Number" value="{{old('phone_number')}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6 col-xs-6 col-lg-6">
                                    <select name="status" class="form-control">
                                        <option value="">User Status</option>
                                        <option value="landlord">Landlord</option>
                                        <option value="agent">Agent</option>
                                    </select>
                                </div>                        
                                <div class="form-group col-md-6 col-xs-6 col-lg-6">
                                    <select name="user_role" class="form-control">
                                        <option value="">Select user role</option>
                                        <option value="admin">Admin</option>
                                        <option value="agent">Agent</option>
                                        <option value="landlord">Landlord</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6 col-xs-6 col-lg-6">
                                    <input id="address" name="address" type="text" class="form-control" placeholder="Address" value="{{old('phone_number')}}">
                                </div>                        
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-xs-6 col-lg-6">
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Password" value="{{old('password')}}">
                                </div>
                                <div class="form-group col-md-6 col-xs-6 col-lg-6">
                                    <input id="confirm_password" name="confirm_password" type="password" class="form-control" placeholder="Confirm Password" value="{{old('password')}}">
                                </div>
                            </div>
                            <input type="reset" class="btn btn-danger" value="RESET"><br/><br/>
                            <input type="submit" class="btn btn-primary" value="SIGN UP">
                            <br/><br/>
                            @include('layouts.errors')
                        {{Form::close()}}
                    </div>
                </div>
                <div class="simple-page-footer">
                <p>
                    <small>Do you have an account ?</small> <a href="{{ route('login') }}">SIGN IN</a>
                </p>
            </div>
            </div>
            <div class="col-md-4"></div>            
        </div>
        @include('layouts.sessions')
    </body>
</html>

<script>
    function back(){
        window.history.back(-1);
    }
</script>
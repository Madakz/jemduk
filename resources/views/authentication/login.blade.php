<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Jemduk</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1,use-scalable=0,minimal-ui">
        <meta name="description" content="Jemduk, Estate Management, Housing Agent">
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
                    <div class="simple-page-form animated flipInY" id="login-form">
                        <h4 class="form-title m-b-xl text-center">Sign In With Your Jemduk Account</h4>
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
                        {{Form::open(['route' => 'attemptLogin', 'method' => 'POST'])}}
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input id="sign-in-email" name="email" type="email" class="form-control" placeholder="Email" autofocus>
                            </div>
                            <div class="form-group">
                                <input id="sign-in-password" name="password" type="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group m-b-xl">
                                <div class="checkbox checkbox-primary">
                                    <input type="checkbox" id="keep_me_logged_in">
                                    <label for="keep_me_logged_in">Keep me signed in</label>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-primary" value="SIGN IN">
                            <br/><br/>
                            @include('layouts.errors')
                        {{Form::close()}}
                    </div>
                </div>
                <div class="simple-page-footer">
                    <p>
                        <a href="{{ route('forgot_password') }}">FORGOT YOUR PASSWORD ?</a>
                    </p>
                    <p>
                        <!-- <small>Don't have an account ?</small> <a href="{{ route('register') }}">CREATE AN ACCOUNT</a> -->
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
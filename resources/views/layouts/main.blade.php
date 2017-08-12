<?php
    $logged_user = Sentinel::getUser();
    $user_role = Sentinel::getUser()->roles->first();
   // dd($logged_user->id);
    // dd($user_role);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
        <meta name="description" content="Admin, Dashboard, Bootstrap">
        <link rel="shortcut icon" sizes="196x196" href="/infinity/assets/images/logo.png">
        
        <title>Jemduk</title>
        
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" />
        <link rel="stylesheet" href="/infinity/assets/css/app.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
        <script src="/infinity/assets/libs/bower/breakpoints.js/dist/breakpoints.min.js"></script>
        <script>Breakpoints();</script>
        
        @yield('styles')
    </head>
    <body class="menubar-left menubar-unfold menubar-light theme-primary">
        <nav id="app-navbar" class="navbar navbar-inverse navbar-fixed-top primary">
            @yield('header')
        </nav>
        <aside id="menubar" class="menubar light">
            <div class="app-user">
                <div class="media">
                    <div class="media-left">
                        <div class="avatar avatar-md avatar-circle">
                            <a href="{{ route('my_profile', [$logged_user->id])}}">
                                <img class="img-responsive" src="{!! url('photo/'.$logged_user->picture) !!}" alt="{{$logged_user->picture}}">
                            </a>
                        </div>
                    </div>
                    <div class="media-body">
                        <div class="foldable">
                            
                            <h5>
                                <a href="javascript:void(0)" class="username">{{$logged_user->first_name}} &nbsp;{{$logged_user->last_name}}</a>
                            </h5>
                            <ul>
                                <li class="dropdown">
                                    <a href="javascript:void(0)" class="dropdown-toggle usertitle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><small><?php $role = ucfirst($user_role->slug) ?>{{$role}}</small> <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu animated flipInY">
                                        @if (Sentinel::getUser()->roles->first()->slug == 'superadmin')
                                            <li>
                                                <a class="text-color" href="{{route('superadmin_dash')}}">
                                                    <span class="m-r-xs">
                                                        <i class="fa fa-home"></i>
                                                    </span>
                                                    <span>Home</span>
                                                </a>
                                            </li>
                                        @elseif(Sentinel::getUser()->roles->first()->slug == 'admin')
                                            <li>
                                                <a class="text-color" href="{{route('admin_dash')}}">
                                                    <span class="m-r-xs">
                                                        <i class="fa fa-home"></i>
                                                    </span>
                                                    <span>Home</span>
                                                </a>
                                            </li>
                                        @elseif(Sentinel::getUser()->roles->first()->slug == 'agent')
                                            <li>
                                                <a class="text-color" href="{{route('agent_dash')}}">
                                                    <span class="m-r-xs">
                                                        <i class="fa fa-home"></i>
                                                    </span>
                                                    <span>Home</span>
                                                </a>
                                            </li>
                                        @endif
                                        <li>                                            
                                            <a class="text-color" href="{{ route('my_profile', [$logged_user->id])}}">
                                                <span class="m-r-xs">
                                                    <i class="fa fa-user"></i>
                                                </span>
                                                <span>Profile</span>
                                            </a>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                        <li>
                                            <a class="text-color" href="{{ route('logout') }}">
                                                <span class="m-r-xs">
                                                    <i class="fa fa-sign-out"></i>
                                                </span> 
                                                <span>Sign Out</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @include('property.sidebar')
        </aside>
        <div id="navbar-search" class="navbar-search collapse">
            <div class="navbar-search-inner">
                <!-- <form action="#">
                    <span class="search-icon">
                        <i class="fa fa-search"></i>
                    </span> 
                    <input class="search-field" type="search" placeholder="search...">
                </form> -->
            <button type="button" class="search-close" data-toggle="collapse" data-target="#navbar-search" aria-expanded="false">
                <i class="fa fa-close"></i>
            </button>
        </div>
        <div class="navbar-search-backdrop" data-toggle="collapse" data-target="#navbar-search" aria-expanded="false"></div>
    </div>
    <main id="app-main" class="app-main">
        <div class="wrap">
            <section class="app-content">
    		    <div class="row">
    		        @yield('content')
    		    </div>
            </section>
    	</div>
    	<div class="wrap p-t-0">
            @include('layouts.footer')
    	</div>
    </main>
    	
    <div id="app-customizer" class="app-customizer">
	    <a href="javascript:void(0)" class="app-customizer-toggle theme-color" data-toggle="class" data-class="open" data-active="false" data-target="#app-customizer">
	        <i class="fa fa-gear"></i>
	    </a>
	    <div class="customizer-tabs">
	        <ul class="nav nav-tabs" role="tablist">
	            <li role="presentation" class="active">
	                <a href="#menubar-customizer" aria-controls="menubar-customizer" role="tab" data-toggle="tab">Menubar</a>
	            </li>
	            <li role="presentation">
	                <a href="#navbar-customizer" aria-controls="navbar-customizer" role="tab" data-toggle="tab">Navbar</a>
	            </li>
	        </ul>
	        <div class="tab-content">
	            <div role="tabpanel" class="tab-pane in active fade" id="menubar-customizer">
	                <div class="hidden-menubar-top hidden-float">
	                    <div class="m-b-0">
	                        <label for="menubar-fold-switch">Fold Menubar</label>
	                        <div class="pull-right">
	                            <input id="menubar-fold-switch" type="checkbox" data-switchery data-size="small">
	                        </div>
	                    </div>
	                    <hr class="m-h-md">
	                </div>
	                <div class="radio radio-default m-b-md">
	                    <input type="radio" id="menubar-light-theme" name="menubar-theme" data-toggle="menubar-theme" data-theme="light">
	                    <label for="menubar-light-theme">Light</label>
	                </div>
	                <div class="radio radio-inverse m-b-md">
	                    <input type="radio" id="menubar-dark-theme" name="menubar-theme" data-toggle="menubar-theme" data-theme="dark">
	                    <label for="menubar-dark-theme">Dark</label>
	                </div>
	            </div>
	            <div role="tabpanel" class="tab-pane fade" id="navbar-customizer"></div>
	        </div>
	    </div>
	    <hr class="m-0">
	    <div class="customizer-reset">
	        <button id="customizer-reset-btn" class="btn btn-block btn-outline btn-primary">Reset</button>
	    </div>
	</div>
	
	<script src="/infinity/assets/js/core.min.js"></script>
	<script src="/infinity/assets/js/app.min.js"></script>
	<script src="/infinity/assets/libs/bower/moment/moment.js"></script>
	<script src="/infinity/assets/libs/bower/fullcalendar/dist/fullcalendar.min.js"></script>
	<script src="/infinity/assets/js/fullcalendar.js"></script>
	<script src="/infinity/assets/libs/misc/datatables/datatables.min.js"></script>
    </body>
</html>
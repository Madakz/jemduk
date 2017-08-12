<?php
    $logged_user = Sentinel::getUser();
    $user_role = Sentinel::getUser()->roles->first();
   // dd($logged_user->id);
    // dd($user_role);
?>
<div class="navbar-header">
    <button type="button" id="menubar-toggle-btn" class="navbar-toggle visible-xs-inline-block navbar-toggle-left hamburger hamburger--collapse js-hamburger">
        <span class="sr-only">Toggle navigation</span>
        <span class="hamburger-box">
            <span class="hamburger-inner"></span>
        </span>
    </button>
    <button type="button" class="navbar-toggle navbar-toggle-right collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="zmdi zmdi-hc-lg zmdi-more"></span>
    </button>
    <a href="{{ route('my_profile', [$logged_user->id])}}" style="color:#fff; padding-top:0px; margin-bottom:0px;">
        <button type="button" class="navbar-toggle navbar-toggle-right collapsed" data-toggle="collapse" data-target="{{ route('my_profile', [$logged_user->id])}}" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span> 
            <span>
                <h5>
                    {{$logged_user->first_name}} &nbsp;{{$logged_user->last_name}}
                </h5>
            </span>
        </button>
    </a> 
    <a href="{{route('home')}}" class="navbar-brand">
        <center><span class="brand-name">Jemduk</span></center>
    </a>
</div>
<div class="navbar-container container-fluid">
    <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <ul class="nav navbar-toolbar navbar-toolbar-left navbar-left">
            <li class="hidden-float hidden-menubar-top">
                <a href="javascript:void(0)" role="button" id="menubar-fold-btn" class="hamburger hamburger--arrowalt is-active js-hamburger">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </a>
            </li>
            <li>
                <h5 class="page-title hidden-menubar-top hidden-float">Lands</h5>
            </li>
        </ul>
        <ul class="nav navbar-toolbar navbar-toolbar-right navbar-right">
            <!-- <li class="nav-item dropdown hidden-float">
                <a href="javascript:void(0)" data-toggle="collapse" data-target="#navbar-search" aria-expanded="false">
                    <i class="zmdi zmdi-hc-lg zmdi-search"></i>
                </a>
            </li> -->
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="zmdi zmdi-hc-lg zmdi-settings"></i>
                </a>
                <ul class="dropdown-menu animated flipInY">
                    <li>
                        <a href="{{ route('my_profile', [$logged_user->id])}}"><i class="zmdi m-r-md zmdi-hc-lg zmdi-account-box"></i>My Profile</a>
                    </li>
                    <li>
                        <a class="text-color" href="{{ route('logout') }}">
                            <span class="m-r-xs">
                                <i class="fa fa-sign-out"></i>
                            </span> 
                            <span>Sign Out</span>
                        </a>
                    </li>
                   <!--  <li>
                        <a href="javascript:void(0)"><i class="zmdi m-r-md zmdi-hc-lg zmdi-balance-wallet"></i>Balance</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><i class="zmdi m-r-md zmdi-hc-lg zmdi-phone-msg"></i>Connection<span class="label label-primary">3</span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><i class="zmdi m-r-md zmdi-hc-lg zmdi-info"></i>privacy</a>
                    </li> -->
                </ul>
            </li>
        </ul>
    </div>
</div>
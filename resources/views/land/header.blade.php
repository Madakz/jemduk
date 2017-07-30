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
    <button type="button" class="navbar-toggle navbar-toggle-right collapsed" data-toggle="collapse" data-target="#navbar-search" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span> 
        <span class="zmdi zmdi-hc-lg zmdi-search"></span>
    </button> 
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
            <li class="nav-item dropdown hidden-float">
                <a href="javascript:void(0)" data-toggle="collapse" data-target="#navbar-search" aria-expanded="false">
                    <i class="zmdi zmdi-hc-lg zmdi-search"></i>
                </a>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="zmdi zmdi-hc-lg zmdi-settings"></i>
                </a>
                <ul class="dropdown-menu animated flipInY">
                    <li>
                        <a href="javascript:void(0)"><i class="zmdi m-r-md zmdi-hc-lg zmdi-account-box"></i>My Profile</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><i class="zmdi m-r-md zmdi-hc-lg zmdi-balance-wallet"></i>Balance</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><i class="zmdi m-r-md zmdi-hc-lg zmdi-phone-msg"></i>Connection<span class="label label-primary">3</span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><i class="zmdi m-r-md zmdi-hc-lg zmdi-info"></i>privacy</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
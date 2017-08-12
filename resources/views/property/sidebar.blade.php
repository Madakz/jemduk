<div class="menubar-scroll">
    <div class="menubar-scroll-inner">
        <ul class="app-menu">
            @if (Sentinel::getUser()->roles->first()->slug == 'superadmin')
                <li class="has-submenu">
                    <a href="{{route('superadmin_dash')}}">
                        <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i> 
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>
            @elseif(Sentinel::getUser()->roles->first()->slug == 'admin')
                <li class="has-submenu">
                    <a href="{{route('admin_dash')}}">
                        <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i> 
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>
            @elseif(Sentinel::getUser()->roles->first()->slug == 'agent')
                <li class="has-submenu">
                    <a href="{{route('agent_dash')}}">
                        <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i> 
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>
            @endif
            
                @if (Sentinel::getUser()->roles->first()->slug == 'superadmin')             
                    <!-- for Agents -->
                    <hr>
                    <li class="has-submenu">
                        <a href="{{route('agent_index')}}">
                            <i class="menu-icon zmdi zmdi-account-circle zmdi-hc-lg"></i> 
                            <span class="menu-text">Agents</span>
                        </a>                
                    </li>
                @endif

            <!-- for Landlords -->
            <hr>
            <li class="has-submenu">
                <a href="{{route('landlord_index')}}">
                    <i class="menu-icon zmdi zmdi-account-box zmdi-hc-lg"></i> 
                    <span class="menu-text">Landlords</span>                   
                </a>               
            </li>

            <!-- for property -->
            <hr>
            <li class="has-submenu">
                <a href="javascript:void(0)" class="submenu-toggle">
                    <i class="menu-icon zmdi zmdi-balance zmdi-hc-lg"></i> 
                    <span class="menu-text">Properties</span>
                    <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{ route('house_index') }}">
                            <span class="menu-text">Houses</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('land_index') }}">
                            <span class="menu-text">Lands</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('shop_index') }}">
                            <span class="menu-text">Shops</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-separator"><hr></li>
            <li><a href="#"><i class="menu-icon zmdi zmdi-file-text zmdi-hc-lg"></i> <span class="menu-text">Documentation</span></a></li>
        </ul>
    </div>
</div>



		@if(session('currentUserRole') == 'admin')
			<ul class="nav">
                <li>
                    <a href="{{ route('invDetails_index') }}">
                        <i class="pe-7s-display1"></i>
                        <p>Inventory Detail</p>
                    </a>
                </li>
                <li>
                    <a href="{{route('inventory_index')}}">
                        <i class="pe-7s-graph1"></i>
                        <p>Inventory</p>
                    </a>
                </li>
            </ul>
		@endif
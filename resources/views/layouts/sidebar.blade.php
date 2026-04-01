<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show {{ request()->routeIs('app.pos.*') ? 'c-sidebar-minimized' : '' }}" id="sidebar">
    <div class="c-sidebar-brand d-md-down-none">
        <a href="{{ route('home') }}" style="text-decoration: none;">
            <div class="c-sidebar-brand-full">
                <span style="font-size: 20px; font-weight: bold; color: #fff; letter-spacing: 1px;">JOYLAND</span>
            </div>
            
            <div class="c-sidebar-brand-minimized">
                <span style="font-size: 18px; font-weight: bold; color: #fff;">J</span>
            </div>
        </a>
    </div>
    
    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('home') ? 'c-active' : '' }}" href="{{ route('home') }}">
                <i class="c-sidebar-nav-icon bi bi-speedometer2"></i> Dashboard
            </a>
        </li>
        <li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link {{ request()->is('projects*') ? 'c-active' : '' }}" href="{{ route('projects.index') }}">
        <i class="c-sidebar-nav-icon bi bi-kanban"></i> Projects
    </a>
</li>

        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->routeIs('departments.index') ? 'c-active' : '' }}" href="{{ route('departments.index') }}">
                <i class="c-sidebar-nav-icon bi bi-building"></i> Departments
            </a>
        </li>

        <hr style="border-top: 1px solid rgba(255, 255, 255, 0.1); margin: 5px 20px;">

        @include('layouts.menu')

        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 692px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 369px;"></div>
        </div>
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div>
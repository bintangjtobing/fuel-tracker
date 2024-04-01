<aside class="sidebar-wrapper">
    <div class="sidebar sidebar-collapse" id="sidebar">
        <div class="sidebar__menu-group">
            <ul class="sidebar_nav">
                <li class="menu-title">
                    <span>Main menu</span>
                </li>
                <li class="mb-4">
                    <a href="/dashboard" class="{{ request()->is('/') ? 'active' : '' }}">
                        <span data-feather="home" class="nav-icon"></span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>
                <li class="menu-title">
                    <span>Applications</span>
                </li>
                <li>
                    <a href="/fuel-track" class="{{ request()->is('fuel-track*') ? 'active' : '' }}">
                        <span data-feather="activity" class="nav-icon"></span>
                        <span class="menu-text">Fuel Track</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>

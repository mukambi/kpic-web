<nav class="bottom-navbar">
    <div class="container">
        <ul class="nav page-navigation">
            <li class="nav-item {{ Route::is(['home']) ? 'active' : null }}">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="link-icon" data-feather="home"></i>
                    <span class="menu-title">Home</span>
                </a>
            </li>
            <li class="nav-item {{ Route::is(['kpic.*']) ? 'active' : null }}">
                <a class="nav-link" href="{{ route('kpic.index') }}">
                    <i class="link-icon" data-feather="key"></i>
                    <span class="menu-title">KPIC Management</span>
                </a>
            </li>
            @can('view_system_users')
                <li class="nav-item {{ Route::is(['seps*', 'users*']) ? 'active' : null }}" >
                    <a class="nav-link" href="{{ route('seps.index') }}">
                        <i class="link-icon" data-feather="users"></i>
                        <span class="menu-title">User Management</span>
                    </a>
                </li>
            @endcan
            @can('view_kpic_list')
                <li class="nav-item {{ Route::is(['list.*']) ? 'active' : null }}">
                    <a class="nav-link" href="{{ route('list.index') }}">
                        <i class="link-icon" data-feather="list"></i>
                        <span class="menu-title">KPIC List</span>
                    </a>
                </li>
            @endcan
            @can('view_mobility_list')
                <li class="nav-item {{ Route::is(['mobility.*']) ? 'active' : null }}">
                    <a class="nav-link" href="{{ route('mobility.index') }}">
                        <i class="link-icon" data-feather="airplay"></i>
                        <span class="menu-title">Mobility</span>
                    </a>
                </li>
            @endcan
            @can('view_dedup_reports')
                <li class="nav-item {{ Route::is(['dedup.*']) ? 'active' : null }}">
                    <a class="nav-link" href="{{ route('dedup.index') }}">
                        <i class="link-icon" data-feather="copy"></i>
                        <span class="menu-title">Dedup reports</span>
                    </a>
                </li>
            @endcan
            @can('view_configurations')
                <li class="nav-item {{ Route::is(['configuration.*']) ? 'active' : null }}">
                    <a href="javascript:void(0);" class="nav-link">
                        <i class="link-icon" data-feather="settings"></i>
                        <span class="menu-title">Configurations</span>
                        <i class="link-arrow"></i>
                    </a>
                    <div class="submenu">
                        <ul class="submenu-item">
                            @can('view_sep_types')
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is(['configuration.sep-type.*']) ? 'active' : null }}" href="{{ route('configuration.sep-type.index') }}">
                                        Service Entry Point Type
                                    </a>
                                </li>
                            @endcan
                            @can('view_pcns')
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is(['configuration.pcn.*']) ? 'active' : null }}" href="{{ route('configuration.pcn.index') }}">
                                        Population Category Number
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcan
        </ul>
    </div>
</nav>

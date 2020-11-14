<nav class="bottom-navbar">
    <div class="container">
        <ul class="nav page-navigation">
            <li class="nav-item {{ Route::is(['home']) ? 'active' : null }}">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="link-icon" data-feather="home"></i>
                    <span class="menu-title">Home</span>
                </a>
            </li>
            @can('view_system_users')
                <li class="nav-item {{ Route::is(['users*']) ? 'active' : null }}">
                    <a class="nav-link" href="{{ route('users.index') }}">
                        <i class="link-icon" data-feather="users"></i>
                        <span class="menu-title">Users</span>
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
                <li class="nav-item {{ Route::is(['configuration.*', 'seps*']) ? 'active' : null }}">
                    <a href="javascript:void(0);" class="nav-link">
                        <i class="link-icon" data-feather="settings"></i>
                        <span class="menu-title">Configurations</span>
                        <i class="link-arrow"></i>
                    </a>
                    <div class="submenu">
                        <ul class="submenu-item">
                            @can('view_seps')
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is(['seps*']) ? 'active' : null }}"
                                       href="{{ route('seps.index') }}">
                                        Service Entry Points
                                    </a>
                                </li>
                            @endcan
                            @can('view_regions')
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is(['configuration.regions.*']) ? 'active' : null }}"
                                       href="{{ route('configuration.regions.index') }}">
                                        Regions
                                    </a>
                                </li>
                            @endcan
                            @can('view_sep_types')
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is(['configuration.sep-type.*']) ? 'active' : null }}"
                                       href="{{ route('configuration.sep-type.index') }}">
                                        Service Entry Point Type
                                    </a>
                                </li>
                            @endcan
                            @can('view_icons')
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is(['configuration.icons.*']) ? 'active' : null }}"
                                       href="{{ route('configuration.icons.index') }}">
                                        Icons
                                    </a>
                                </li>
                            @endcan
                            @can('view_api_tokens')
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is(['configuration.credentials.*']) ? 'active' : null }}"
                                       href="{{ route('configuration.credentials.index') }}">
                                        Api Credentials
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

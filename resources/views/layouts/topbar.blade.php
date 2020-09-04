<nav class="navbar top-navbar">
    <div class="container">
        <div class="navbar-content">
            <a href="#" class="navbar-brand">
                {{ config('app.name') }}
            </a>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="languageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="flag-icon flag-icon-us mt-1" title="us"></i> <span class="font-weight-medium ml-1 mr-1 d-none d-md-inline-block">English</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="languageDropdown">
                        <a href="javascript:void(0);" class="dropdown-item py-2">
                            <i class="flag-icon flag-icon-us" title="us" id="us"></i>
                            <span class="ml-1"> English </span>
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown nav-messages">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i data-feather="mail"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="messageDropdown">
                        <div class="dropdown-header d-flex align-items-center justify-content-between">
                            <p class="mb-0 font-weight-medium">0 New Messages</p>
                            <a href="javascript:void(0);" class="text-muted">Clear all</a>
                        </div>
                        <div class="dropdown-body">
                            <p class="text-center">No new messages</p>
                        </div>
                        <div class="dropdown-footer d-flex align-items-center justify-content-center">
                            <a href="javascript:void(0);">View all</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown nav-notifications">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i data-feather="bell"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="notificationDropdown">
                        <div class="dropdown-header d-flex align-items-center justify-content-between">
                            <p class="mb-0 font-weight-medium">0 New Notifications</p>
                            <a href="javascript:void(0);" class="text-muted">Clear all</a>
                        </div>
                        <div class="dropdown-body">
                            <p class="text-center">No new notifications</p>
                        </div>
                        <div class="dropdown-footer d-flex align-items-center justify-content-center">
                            <a href="javascript:void(0);">View all</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown nav-profile">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ auth()->user()->avatar }}" alt="profile">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="profileDropdown">
                        <div class="dropdown-header d-flex flex-column align-items-center">
                            <div class="figure mb-3">
                                <img src="{{ auth()->user()->avatar }}" alt="">
                            </div>
                            <div class="info text-center">
                                <p class="name font-weight-bold mb-0">{{ auth()->user()->name }}</p>
                                <p class="email text-muted mb-3">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                        <div class="dropdown-body">
                            <ul class="profile-nav p-0 pt-3">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i data-feather="edit"></i>
                                        <span>Edit Profile</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i data-feather="log-out"></i>
                                        <span>{{ __('Logout') }}</span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
                <i data-feather="menu"></i>
            </button>
        </div>
    </div>
</nav>

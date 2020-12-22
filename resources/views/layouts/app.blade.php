@include('layouts.header')
<div class="main-wrapper" id="app">
    @if (!Route::is(['register', 'login', 'password*', 'verification.*']))
        <div class="horizontal-menu">
            @include('layouts.topbar')
            @include('layouts.bottombar')
        </div>
        <div class="page-wrapper">
            <div class="page-content">
                @include('layouts.components.alerts')
                @yield('content')
            </div>
            @include('layouts.footer')
        </div>
    @else
        @include('layouts.components.alerts')
        @yield('content')
    @endif
</div>
@include('layouts.scripts')

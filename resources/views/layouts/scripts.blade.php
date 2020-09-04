<!-- Scripts -->
<script src="{{ asset('/js/app.js') }}" defer></script>
<!-- core:js -->
<script src="{{ asset('/assets/vendors/core/core.js') }}"></script>
<!-- endinject -->
<!-- inject:js -->
<script src="{{ asset('/assets/vendors/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('/assets/js/template.js') }}"></script>
<!-- endinject -->
@yield('js')
</body>
</html>

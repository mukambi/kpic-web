@php
    $name = config('app.name', 'Health');
    $path = request()->path();
    $url = request()->fullUrl();
    $app_url = url('/');
@endphp
@section('title') {{ isset($title) ? $name.' - '.$title : $name }} @endsection
@section('meta')
    @parent
    <meta name="original-source" content="{{ $url }}"/>
    <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}"/>
    <meta property="og:url" content="{{ $url }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ isset($title) ? $title.' - '.$name : $name }}" />
    <meta property="og:description" content="{{ $description ?? (isset($title) ? $name.' - '.$title : $name) }}" />
    <meta property="og:image" content="http://static01.nyt.com/images/2015/02/19/arts/international/19iht-btnumbers19A/19iht-btnumbers19A-facebookJumbo-v2.jpg" />
    <meta property="og:site_name" content="{{ $name }}"/>
    <meta property="fb:admins" content="admin"/>
    <meta property="fb:pages" content="pages"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:description" content="{{ $description ?? (isset($title) ? $title.' - '.$name : $name) }}"/>
    <meta name="twitter:title" content="{{ isset($title) ? $title.' - '.$name : $name }}"/>
    <meta name="twitter:site" content="{{ $url }}"/>
    <meta name="twitter:image" content="{{ $app_url.config('setting.app_banner_image') }}"/>
    <meta name="twitter:creator" content="{{ '@'.config('setting.app_developers_twitter_handle') }}"/>
@endsection

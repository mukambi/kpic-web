<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .code {
                border-right: 2px solid;
                font-size: 26px;
                padding: 0 15px 0 15px;
                text-align: center;
            }

            .message {
                font-size: 18px;
                text-align: center;
            }

            .btn {
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
                --gray-dark: #0f1531;
                --blue: #5E50F9;
                --indigo: #6610f2;
                --purple: #6a008a;
                --pink: #E91E63;
                --red: #f96868;
                --orange: #f2a654;
                --yellow: #f6e84e;
                --green: #46c35f;
                --teal: #58d8a3;
                --cyan: #57c7d4;
                --white: #ffffff;
                --gray: #434a54;
                --gray-light: #aab2bd;
                --gray-lighter: #e8eff4;
                --gray-lightest: #e6e9ed;
                --black: #000000;
                --primary: #727cf5;
                --secondary: #7987a1;
                --success: #10b759;
                --info: #66d1d1;
                --warning: #fbbc06;
                --danger: #ff3366;
                --light: #ececec;
                --dark: #282f3a;
                --primary-muted: #b1cfec;
                --info-muted: #7ee5e5;
                --danger-muted: #f77eb9;
                --breakpoint-xs: 0;
                --breakpoint-sm: 576px;
                --breakpoint-md: 768px;
                --breakpoint-lg: 992px;
                --breakpoint-xl: 1200px;
                --font-family-sans-serif: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
                --font-family-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
                font-family: "Overpass", sans-serif;
                -webkit-font-smoothing: antialiased;
                border-collapse: separate!important;
                border-spacing: 0;
                white-space: nowrap;
                box-sizing: border-box;
                text-decoration: none;
                text-shadow: none;
                display: inline-block;
                font-weight: 600;
                text-align: center;
                vertical-align: middle;
                user-select: none;
                border: 1px solid #ff3366;
                border-radius: 0.1875rem;
                transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                color: #fff;
                background-color: #ff3366;
                font-size: 0.875rem;
                line-height: 1;
                padding: .5rem 1rem .4rem;
                box-shadow: none;
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="code">
                @yield('code')
            </div>

            <div class="message" style="padding: 10px;">
                @yield('message')
            </div>

            @yield('extra')

        </div>
    </body>
</html>

<!doctype html>
<html lang="en" ng-app="app">
    <head>
        <meta charset="UTF-8">
        @yield('additional_meta_data')

        <title>@yield('page_title')</title>

        @yield('styles')

        @yield("additional_head_content")

        @yield('required_scripts')

    </head>

    <header>
        @yield('menu')
    </header>


    <body>
        @yield('content')
    </body>

    <footer>
        @yield('footer')
    </footer>

    @yield('scripts')

</html>


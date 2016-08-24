<!doctype html>
<html lang="en" ng-app="app">
    <head>
        <meta charset="UTF-8">
        @yield('additional_meta_data')

        <title>@yield('page_title')</title>

        @yield('styles')

        <script type="text/javascript" src="{{asset(elixir('js/app.js'))}}"></script>
        <script type="text/javascript" src="{{asset('js/utils.js')}}"></script>
        <script type="text/javascript" src="http://cassiohudson.com/utilities/js/standardUtilities/su_1_0_0.js"></script>
        <script type="text/javascript" src="http://cassiohudson.com/utilities/js/angularStandardUtilities/asu_1_0_0.js"></script>
        <link type="text/css" rel="stylesheet" href="{{asset(elixir('css/app.css'))}}">
        @yield("additional_head_content")

        @yield('required_scripts')

    </head>

    <div class="container-fluid">
        <header>
            @yield('menu')
        </header>

        <body>
            @yield('content')
        </body>

        <footer>
            @yield('footer')
        </footer>
    </div>

    @yield('scripts')

</html>


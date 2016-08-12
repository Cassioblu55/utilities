<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">

        <title>Document</title>

        @yield('styles')

        @yield('required_scripts')

    </head>


    <body>
        @yield('content')
    </body>

    <footer>
        @yield('footer')
    </footer>

    @yield('scripts')

</html>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Document</title>

    <script href="{{url("assets/js/jquery/dist/jquery.min.js")}}"></script>
    <script href="{{url("assets/js/angular/angular.min.js")}}"></script>
    <script href="{{url("assets/js/bootstrap/dist/js/bootstrap.min.js")}}"></script>
    <script href="{{url("assets/js/angular-ui-grid/ui-grid.min.js")}}"></script>
    @yield('required_scripts')

    <link href="{{url("assets/js/bootstrap/dist/css/bootstrap.min.css")}}">
    @yield('styles')

</head>


<body>
@yield('content')
</body>

<footer>
    @yield('footer')
</footer>

@yield('scripts')

</html>


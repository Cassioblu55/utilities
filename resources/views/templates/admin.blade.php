@extends("templates.app")

@section('additional_head_content')

    <script type="text/javascript" src="{{elixir('js/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/utils.js')}}"></script>
    <script type="text/javascript" src="http://cassiohudson.com/utilities/js/standardUtilities/su_1_0_0.js"></script>
    <script type="text/javascript" src="http://cassiohudson.com/utilities/js/angularStandardUtilities/asu_1_0_0.js"></script>

    <link type="text/css" rel="stylesheet" href="{{elixir('css/app.css')}}">
@stop
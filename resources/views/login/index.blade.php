@extends('templates.app')

@section("additional_head_content")
    <script type="text/javascript" src="{{asset(elixir('js/app.js'))}}"></script>
    <script type="text/javascript" src="{{asset('js/utils.js')}}"></script>
    <script type="text/javascript" src="http://cassiohudson.com/utilities/js/standardUtilities/su_1_0_0.js"></script>
    <script type="text/javascript" src="http://cassiohudson.com/utilities/js/angularStandardUtilities/asu_1_0_0.js"></script>

    <link type="text/css" rel="stylesheet" href="{{asset(elixir('css/app.css'))}}">
@stop


@section('content')
    <form action="{{$headers->postLocation}}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {{method_field($headers->methodField)}}

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" id="username">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password">

        </div>

        <button class="btn btn-primary" type="submit">Submit</button>
        <a href="{{ProjectRoute::getProjectBase()}}" class="btn btn-default">Back</a>
    </form>

@stop
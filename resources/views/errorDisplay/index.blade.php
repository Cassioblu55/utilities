@extends('app')

@section('required_scripts')
    <script type="text/javascript" src="{{ URL::asset('js/errorDisplay/ed_1_0_0.js') }}"></script>
@stop

@section('content')
    <header role="banner">
        <h1>Create Popup Error Message</h1>
        <h2>Easily create error message on any page</h2>

        <p>Include file and add "error=Message" to url param and display a popup message that will fade away. Alerting a user of error. For example incorrectly submiting a form with an error that only the server can find.</p>

        <p>Can be used at {projectHome}/js/errorDisplay.js</p>
    </header>


    <main role="main">

        <a href="{{url('errorDisplay?error=This Is an error message.')}}">Show an error message</a>
        <br>
        <a href="{{url('errorDisplay?error=This Is another error message.')}}">Show another error message</a>

    </main>
@stop

@section('footer')
    <a href="{{url('/')}}">Back</a>
@stop
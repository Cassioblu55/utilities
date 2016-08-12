@extends('templates.app')

@section('styles')
    <style>
        .code{
            border: solid medium black;
            width: 60%;
            white-space: pre-wrap;
            min-width: 450px;
            max-width: 740px;
        }
    </style>
@stop

@section('required_scripts')
    <script type="text/javascript" src="{{ URL::asset('js/showServerMessages/ssm_2_0_0.js') }}"></script>
@stop

@section('content')
    <main role="main">
        <h1>Create Custom Serer Message</h1>

        Create your own custom messages with code like this.

        <pre class="code">
            var simpleMessage = {};
            simpleMessage.urlParam = "simpleMessage";

            var ssm = showServerMessage([simpleMessage]);
        </pre>

        <p>The only thing that is required is simpleMessage.urlParam. Everything else will go to default values.</p>

        <a href="{{url('showMessages/alt?customMessage=This is a new message type with its own CSS')}}">Back</a>
    </main>
@stop

@section('footer')
    <a href="{{url('/')}}">Main Menu</a>
@stop

@section('scripts')
    <script>
        var simpleMessage = {};
        simpleMessage.urlParam = "simpleMessage";

        var ssm = showServerMessage([simpleMessage]);
    </script>
@stop
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
        <h1>Create Custom Server Message</h1>

        <h2>Create your own custom messages with code like this.</h2>

        <pre class="code">
            var customMessage = {};
            customMessage.urlParam = "customMessage";
            customMessage.messageBoxName = "customMessage-messageBox";
            customMessage.css = ".customMessage-message-box{"+
                "margin:40%;" +
                "padding:15px;" +
                "white-space: nowrap;" +
                "opacity: 0;" +
                "position: fixed;" +
                "border-radius: 25px;" +
                "background: rgb(166, 0, 166);"+
                "color: red;" +
                "font-size: large;" +
                "font-weight: bold;" +
                "" +
                "margin-bottom: 5px; " +
                "" +
                "-moz-transition: opacity 1.5s; " +
                "-webkit-transition: opacity 1.5s; " +
                "-o-transition: opacity 1.5s;" +
                "transition: opacity 2.5s;" +
                "z-index: 100;" +
                "}";

            showServerMessage([customMessage], true);
	    </pre>

        <p>customMessage.urlParam is required, but customMessage.css will use the default message box css. And customMessage.messageBoxName will set the message box id but will default to customMessage.urlPram</p>

        <p>See a simple version <a href="{{url('showMessages/simple?simpleMessage=This is a simple message')}}">here</a></p>

        <h3>Note</h3>

        <p>Setting second value to true in showServerMessage will override the default messages</p>
        <p>Setting starting opacity to 0 will make the message box fade in.</p>

    </main>

@stop

@section('footer')
    <a href="{{url('showMessages?errorMessage=This Is an error message.')}}">Back</a>
@stop


@section('scripts')
    <script>
        var customMessage = {};
        customMessage.urlParam = "customMessage";
        customMessage.messageBoxName = "customMessage-messageBox";
        customMessage.css = ".customMessage-message-box{"+
                "margin:40%;" +
                "padding:15px;" +
                "white-space: nowrap;" +
                "opacity: 0;" +
                "position: fixed;" +
                "border-radius: 25px;" +
                "background: rgb(166, 0, 166);"+
                "color: red;" +
                "font-size: large;" +
                "font-weight: bold;" +
                "" +
                "margin-bottom: 5px; " +
                "" +
                "-moz-transition: opacity 1.5s; " +
                "-webkit-transition: opacity 1.5s; " +
                "-o-transition: opacity 1.5s;" +
                "transition: opacity 2.5s;" +
                "z-index: 100;" +
                "}";

        showServerMessage([customMessage], true);
    </script>
@stop
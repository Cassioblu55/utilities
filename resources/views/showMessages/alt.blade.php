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
    <script type="text/javascript" src="{{ URL::asset('js/showServerMessages/ssm_3_0_0.js') }}"></script>
@stop

@section('content')

    <main role="main">
        <div class="container-fluid">
            <h1>Create Custom Server Message</h1>

            <h2>Create your own custom messages with code like this.</h2>

            <pre class="code">
    var customMessage = {};
    customMessage.url_param = "customMessage";
    customMessage.message_box_name = "customMessage-messageBox";
    customMessage.css_class_name = "customMessage-message-box";
    customMessage.css =
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
            "z-index: 100;"
            ;
    customMessage.fade_in = true;
    customMessage.fade_out = true;

    var lifeSpanInMillis = 8000;
    displayMessageFromUrlPrams([customMessage], true, lifeSpanInMillis);
            </pre>

            <p>customMessage.url_param is required, but missing customMessage.css or customMessage.css_class_name will result in using the default message box css. And customMessage.message_box_name will set the message box id but will default to customMessage.url_param</p>

            <p>See a simple version <a href="{{url('showMessages/simple?simpleMessage=This is a simple message')}}">here</a></p>

            <h3>Note</h3>

            <p>Setting second value to true will override the default messages</p>
            <p>customMessage.fade_in and customMessage.fade_out control the fades</p>
            <p>lifeSpanInMillis will control how long a message will reamin on the screen, this is optional and will default to 7000</p>

        </div>
    </main>

@stop

@section('footer')
    <div class="container-fluid">
        <a href="{{url('showMessages?errorMessage=This Is an error message.')}}">Back</a>
    </div>
@stop

@section('scripts')
    <script>
        var customMessage = {};
        customMessage.url_param = "customMessage";
        customMessage.message_box_name = "customMessage-messageBox";
        customMessage.css_class_name = "customMessage-message-box";
        customMessage.css =
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
                "z-index: 100;"
                ;
        customMessage.fade_in = true;
        customMessage.fade_out = true;

        var lifeSpanInMillis = 8000;
        displayMessageFromUrlPrams([customMessage], true, lifeSpanInMillis);
    </script>
@stop
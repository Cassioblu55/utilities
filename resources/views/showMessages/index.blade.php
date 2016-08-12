@extends('app')

@section('required_scripts')
    <script type="text/javascript" src="{{ URL::asset('js/showServerMessages/ssm_2_0_0.js') }}"></script>
@stop

@section('content')
    <header role="banner">
        <h1>Create Popup Error Message</h1>
        <h2>Easily create messages on any page</h2>


        <h3>Defualt Messages</h3>
        <p>Include file and add "errorMessage=Message" to url param and display a popup message that will fade away. Alerting a user of error. For example incorrectly submiting a form with an error that only the server can find.</p>

        <p>Include file and add "successMessage=Message" to url param and display a popup message that will fade away. Alerting a user of a successful action. Like a database entry updating or deleting successfully.</p>

        <p>Include file and add "defaultMessage=Message" to url param and display a popup message that will fade away. Alerting a user of an general info you wish them to know.</p>

        <h3>Use</h3>
        <p>Reference Code At:  {projectHome}/js/showServerMessages/ssm_{versionNumber}.js</p>
        <p>Call function:</p>
        <pre>showServerMessage(arrayOfMessageTriggers, overrideDefaultMessages);</pre>
        <p>arrayOfMessageTriggers is optional</p>

        <p>See how to create custom message triggers here: <a href="{{url('showMessages/alt?customMessage=This is a new message type with its own CSS')}}">Show custom messages</a>
        </p>


    </header>


    <main role="main">

        <a href="{{url('showMessages?errorMessage=This Is an error message.')}}">Show error message</a>
        <br>
        <a href="{{url('showMessages?successMessage=This is a success message.')}}">Show success message</a>
        <br>
        <a href="{{url('showMessages?defaultMessage=This is a default message.')}}">Show default message</a>
        <br>
        <a href="{{url('showMessages?defaultMessage=This is a default message&errorMessage=This Is an error message.&successMessage=This is a success message.')}}">Show Multiple messages</a>
        <br>
    </main>
@stop

@section('footer')
    <a href="{{url('/')}}">Back</a>
@stop

@section('scripts')
    <script>
        showServerMessage();
    </script>
@stop
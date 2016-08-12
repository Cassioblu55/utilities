@extends('templates.app')

@section('required_scripts')
    <script type="text/javascript" src="{{ URL::asset('js/clickableTabs/ct_1_0_0.js') }}"></script>

@stop

@section('content')
    <header role="banner">
        <h1>Clickable Tabs Creator</h1>
        <h2>Create clickable tabs easily and quickly</h2>

        <p>Taking a string prefix clickable tabs will create clickable tabs from any DOM element.</p>

        <p>Can be used at {projectHome}/js/clickableTabs.js</p>
    </header>


    <main role="main">

        <h3>Tabs</h3>
        <h4>Syntax is {tabPrefix}_tab_{number}</h4>
        <p>Number must start at 0 and cannot be skipped</p>

        <h3>Content</h3>
        <h4>Syntax is {tabPrefix}_content_{number}</h4>
        <p>Number must start at 0 and cannot be skipped</p>

        <h3>Example</h3>

        <p>Created using: createClickableTabs("test")</p>
        <p>Where "test" is the name of the tabPrefix</p>

        <ul>
            <li tabindex="1" id="test_tab_0">Tab One</li>
            <li tabindex="2" id="test_tab_1">Tab Two</li>
            <li tabindex="3" id="test_tab_2">Tab Three</li>
        </ul>

        <p id="test_content_0">Tab content one</p>
        <p id="test_content_1">Tab content two</p>
        <p id="test_content_2">Tab content three</p>

    </main>
@stop

@section('footer')
    <a href="{{url('/')}}">Back</a>
@stop

@section('scripts')
    <script type="text/javascript">
        createClickableTabs("test");
    </script>
@stop
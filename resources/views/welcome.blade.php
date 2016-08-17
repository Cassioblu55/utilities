@extends('templates.app')

@section('content')
<div class="container">
    <div class="content">
        <header>
            <h1>List of working utilities found within this project</h1>
        </header>

        <main>
            <div>
                <a href="{{ProjectRoute::makeRoute("clickableTabs")}}">Clickable Tab Creator</a>
            </div>

            <div>
                <a href="{{ProjectRoute::makeRoute("showMessages?errorMessage=This is an error message.")}}">Display server message</a>
            </div>

            <div>
                <a href="{{ProjectRoute::makeRoute("errorDisplay?error=This is an Error Message")}}">Display error message</a>
            </div>

            <div>
                <a href="{{ProjectRoute::makeRoute("defaultServerMessages")}}">Default Messages admin controls</a>
            </div>

        </main>
    </div>
</div>
@stop

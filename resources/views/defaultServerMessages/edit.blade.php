@extends('templates.form')

@section('form_title', "$headers->createOrUpdate Default Server Message")
@section('controller','DefaultServerMessagesEditController')

@section('required_scripts')
    <script type="text/javascript" src="{{asset("js/utils/defaultServerMessagePreview.js")}}"></script>
@stop

@section('form_body')

    <div class="form-group {{ $errors->has('url_param') ? 'has-error' : '' }}">
        <label for="url_param" class="control-label">Edit Url Param</label>
        <input type="text" class="form-control" required ng-value="defaultServerMessage.url_param" name="url_param" id="url_param" placeholder="Url Param" />

        @if ($errors->has('url_param'))
            <span class="text-danger">
                <strong>{{ $errors->first('url_param') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group {{ $errors->has('css_class_name') ? 'has-error' : '' }}">
        <label for="css_class_name" class="control-label">Css Class Name</label>
        <input type="text" class="form-control" ng-model="defaultServerMessage.css_class_name" name="css_class_name" id="css_class_name" placeholder="Css Class Name" />

        @if ($errors->has('css_class_name'))
            <span class="text-danger">
                <strong>{{ $errors->first('css_class_name') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group {{ $errors->has('css') ? 'has-error' : '' }}">
        <label for="css" class="control-label">Css</label>
        <textarea type="text" id="css" class="form-control" ng-model="defaultServerMessage.css" name="css" placeholder="<% cssPlaceHolder %>" rows="10" ></textarea>

        @if ($errors->has('css'))
            <span class="text-danger">
                <strong>{{ $errors->first('css') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group {{ $errors->has('message_box_name') ? 'has-error' : '' }}">
        <label for="message_box_name" class="control-label">Message Box Name</label>
        <input type="text"  class="form-control" ng-model="defaultServerMessage.message_box_name" name="message_box_name" id="massage_box_name" placeholder="Message Box Name"/>

        @if ($errors->has('message_box_name'))
            <span class="text-danger">
                <strong>{{ $errors->first('message_box_name') }}</strong>
            </span>
        @endif
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="checkbox {{ $errors->has('fade_in') ? 'has-error' : '' }}">
                <label id="fade_in"><input name="fade_in" type="checkbox" ng-model="defaultServerMessage.fade_in">Fade In</label>
            </div>
            @if ($errors->has('fade_in'))
                <span class="text-danger">
                    <strong>{{ $errors->first('fade_in') }}</strong>
                </span>
            @endif

        </div>
        <div class="col-md-6">
            <div class="checkbox {{ $errors->has('fade_out') ? 'has-error' : '' }}">
                <label id="fade_out" class="control-label">
                    <input name="fade_out" type="checkbox" ng-model="defaultServerMessage.fade_out">Fade Out
                </label>
            </div>
            @if ($errors->has('fade_out'))
                <span class="text-danger">
                    <strong>{{ $errors->first('fade_out') }}</strong>
                </span>
            @endif
        </div>

    </div>

    <div class="form-group" style="color: grey">
        Opacity must be set to <% (defaultServerMessage.fade_in) ? '0' : '1' %> in order for fades to work.
    </div>

    <div class="form-group">
        <label for="preview_message">Preview Message</label>
        <input type="text"  class="form-control" ng-model="previewMessage"  id="preview_message" placeholder="Message Box Name"/>
    </div>
@stop

@section('form_footer')
    <button type="button" ng-click="preview()" class="btn btn-default pull-right">Preview Message</button>
@stop

@section('back_location', ProjectRoute::makeRoute("defaultServerMessages/"))

@section('scripts')
    <script type="text/javascript">
        app.controller("DefaultServerMessagesEditController", ['$scope', "$controller","$http", function($scope, $controller, $http) {
            angular.extend(this, $controller('UtilsController', {$scope: $scope}));

            $scope.cssPlaceHolder = 'margin:40%;\npadding:15px;\nwhite-space: nowrap;';
            $scope.previewMessage = "This is a preview message"


            $scope.httpCalls = $scope.httpCallsUtil('.');

            const OBJECT_DATA_URL = "{{ProjectRoute::makeRoute("defaultServerMessages/$defaultServerMessage->id/data")}}";

            $scope.httpCalls.getDataOnEdit("{{$defaultServerMessage->id}}", OBJECT_DATA_URL, function(data){
                data.fade_in = (data.fade_in == 1);
                data.fade_out = (data.fade_out == 1);
                $scope.defaultServerMessage = data;
            });

            var messagePreview = new MessageDisplay();

            $scope.preview = function(){
                messagePreview.setMessageDisplayData($scope.defaultServerMessage);
                messagePreview.showMessage($scope.previewMessage);
                messagePreview.clean();
            }

        }]);

    </script>
@stop
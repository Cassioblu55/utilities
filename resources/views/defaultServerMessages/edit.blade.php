@extends('templates.form')

@section('form_title', "$headers->createOrUpdate Default Server Message")
@section('back_location', '/defaultServerMessages')
@section('controller','DefaultServerMessagesEditController')

@section('required_scripts')
    <script type="text/javascript" src="{{asset("js/utils/defaultServerMessagePreview.js")}}"></script>
@stop

@section('form_body')
    <div class="form-group">
        <label for="url_param">Edit Url Param</label>
        <input type="text" class="form-control" ng-value="defaultServerMessage.url_param" name="url_param" id="url_param" placeholder="Url Param" />
    </div>

    <div class="form-group">
        <label for="css_class_name">Css Class Name</label>
        <input type="text" class="form-control" ng-model="defaultServerMessage.css_class_name" name="css_class_name" id="css_class_name" placeholder="Css Class Name" />
    </div>

    <div class="form-group">
        <label for="css">Css</label>
        <textarea type="text" id="css" class="form-control" ng-model="defaultServerMessage.css" name="css" placeholder="<% cssPlaceHolder %>" rows="10" ></textarea>
    </div>

    <div class="form-group">
        <label for="message_box_name">Message Box Name</label>
        <input type="text"  class="form-control" ng-model="defaultServerMessage.message_box_name" name="message_box_name" id="massage_box_name" placeholder="Message Box Name"/>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="checkbox">
                <label id="fade_in"><input name="fade_in" type="checkbox" ng-model="defaultServerMessage.fade_in">Fade In</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="checkbox">
                <label id="fade_out"><input name="fade_out" type="checkbox" ng-model="defaultServerMessage.fade_out">Fade Out</label>
            </div>
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

@section('scripts')
    <script type="text/javascript">
        app.controller("DefaultServerMessagesEditController", ['$scope', "$controller","$http", function($scope, $controller, $http) {
            angular.extend(this, $controller('UtilsController', {$scope: $scope}));

            $scope.cssPlaceHolder = 'margin:40%;\npadding:15px;\nwhite-space: nowrap;';
            $scope.previewMessage = "This is a preview message"


            $scope.httpCalls = $scope.httpCallsUtil('/defaultServerMessages');

            $scope.httpCalls.getDataOnEdit("{{$defaultServerMessage->id}}", "data", function(data){
                data.fade_in = (data.fade_in == 1);
                data.fade_out = (data.fade_out == 1);
                $scope.defaultServerMessage = data;
            });

            var messagePreview = new messageDisplay();

            $scope.preview = function(){
                messagePreview.setMessageDisplayData($scope.defaultServerMessage);
                messagePreview.showMessage($scope.previewMessage);
                messagePreview.clean();
            }

        }]);

    </script>
@stop
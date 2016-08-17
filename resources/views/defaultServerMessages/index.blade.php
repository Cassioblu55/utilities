@extends('templates.grid')

@section('required_scripts')
    <script type="text/javascript" src="{{asset("js/utils/defaultServerMessagePreview.js")}}"></script>
@stop

@section('page_title', "Default Server Messages")
@section("panelTitle", "Default Server Messages")
@section('controller', "DefaultServerMessagesIndexController")

@section('additionalHeaderContent')
    <a href="{{ProjectRoute::makeRoute("defaultServerMessages/create")}}" style="margin-left: 10px" class="btn btn-primary pull-right">Add</a>
    <form class="form-inline">
        <div class="form-group pull-right">
            <label for="previewMessage">Message:</label>
            <input id="previewMessage" ng-model="previewMessage" style="max-width: 300px; min-width: 200px;" class="form-control" placeholder="Preview Message">
        </div>
    </form>
@stop

@section('panelBody')
    <div ui-grid="gridModel" external-scopes="$scope" style="height: 400px;"></div>
@stop

@section('scripts')
    <script>
        app.controller("DefaultServerMessagesIndexController", ['$scope', "$controller", function($scope, $controller){

            angular.extend(this, $controller('UtilsController', {$scope: $scope}));

            $scope.gridModel = {enableFiltering: true, enableColumnResizing: true, showColumnFooter: true , enableSorting: false, showGridFooter: true, enableRowHeaderSelection: false, rowHeight: 42, enableColumnMenus: false};

            const EDIT_LINK_URL = "{{ProjectRoute::makeRoute("defaultServerMessages/<%row.entity.id%>/edit")}}";
            const EDIT_BUTTON_HTML = getEditButton(EDIT_LINK_URL);

            const PREVIEW_BUTTON_HTML = getGridButton("grid.appScope.preview(row.entity)", "Preview", "btn-default")

            const CLONE_LINK_URL = "{{ProjectRoute::makeRoute("defaultServerMessages/<%row.entity.id%>/clone")}}";
            const CLONE_BUTTON_HTML = getGridLink(CLONE_LINK_URL, "Clone", "btn-default");

            const DELETE_BUTTON_HTML = getDeleteButton("grid.appScope.httpCalls.deleteObjectFromGrid(row.entity,row.entity.url_param);");

            $scope.gridModel.columnDefs = [
                {field: 'edit', enableFiltering: false, width: 52, cellTemplate: EDIT_BUTTON_HTML},
                {field: 'preview',  enableFiltering: false, width: 75, cellTemplate: PREVIEW_BUTTON_HTML},
                {field: 'url_param'},
                {field: 'css_class_name'},
                {field: 'css'},
                {field: 'message_box_name'},
                {field: 'clone', enableFiltering: false, width: 67, cellTemplate: CLONE_BUTTON_HTML},
                {field: 'delete',  enableFiltering: false, width: 67,  cellTemplate: DELETE_BUTTON_HTML}
            ];

            const GRID_DATA_URL = "{{ProjectRoute::makeRoute("defaultServerMessages/data")}}";

            $scope.refreshGridData = function(){
                $scope.setFromGet(GRID_DATA_URL, function(data){
                    $scope.gridModel.data = data;
                });
            };

            $scope.refreshGridData();

            $scope.httpCalls = $scope.httpCallsUtil("{{ProjectRoute::makeRoute("defaultServerMessages")}}", $scope.refreshGridData);

            $scope.previewMessage = "This is a preview Message";

            var messagePreview = new messageDisplay();
            $scope.preview = function(defaultServerMessage){
                messagePreview.clean();
                messagePreview.setMessageDisplayData(defaultServerMessage);
                messagePreview.showMessage($scope.previewMessage);
            }
        }]);
    </script>
@stop

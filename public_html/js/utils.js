var app = angular.module('app', ['ui.grid'], function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
});

function getGridLink(href, buttonName, classes){
	return '<a class="btn '+classes+'" role="button" ng-href="'+href+'">'+buttonName+'</a>;'
}

function getGridButton(clickAction, buttonName, classes){
	return '<button class="btn '+classes+'" role="button" ng-click="'+clickAction+'">'+buttonName+'</button>'
}

function getEditButton(href){
	return getGridLink(href, "Edit", "btn-default");
}

function getDeleteButton(clickAction){
	return getGridButton(clickAction, "Delete", "btn-danger");
}

function getShowButton(href){
	return getGridLink(href, "Show", 'btn-default');
}

app.controller("UtilsController", ['$scope', "$http","$controller", function($scope, $http, $controller){
	angular.extend(this, $controller('StandardUtilitiesController', {$scope: $scope}));

	$scope.httpCallsUtil = function(baseUrl, defaultCallback){
		var that = {};
		function deleteObject(objectToDelete, confirmName, callback){
			callback = callback || defaultCallback;
			if(window.confirm("Are you sure you want to delete "+confirmName+"?")){
				var url = createRequestUrlWithObject(objectToDelete, "delete");
				$http.delete(url).then(function(response){
					callback();
				}, function errorCallback(){
					runOnFailed("deleteObject");
				});
			}
		}
		that.deleteObject = deleteObject;

		function createRequestUrlWithObject(object, url){
			return createUrlWithId(object.id, url);
		}

		function createUrlWithId(id, url){
			return baseUrl+"/"+id+"/"+url;
		}

		function runOnFailed(requestName){
			console.log("Http request "+requestName+" failed");
			}

		function getDataOnEdit(requiredId, url, setFunct){
			if(requiredIdPresent(requiredId)){
				url = createUrlWithId(requiredId, url);
				$http.get(url).then(function(response){
					setFunct(response.data);
				}, function errorCallback(response){
					runOnFailed("getDataOnEdit");
				});
			}
		}
		that.getDataOnEdit = getDataOnEdit;

		function requiredIdPresent(requiredId){
			return requiredId && requiredId.length >0;
		}

			return that;
	}

}]);

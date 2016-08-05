app.controller("StandardUtilitiesController", ['$scope', "$http", "$window", function($scope, $http, $window){

	$scope.deleteById = function(id, name, runOnSuccess, runOnFailed){
		runOnFailed = runOnFailed || failedHTTPLog;
		if(window.confirm("Are you sure you want to delete "+name+"?")){
			$http.post('delete.php?id='+id)
				.then(function(response){
					runFunctionIfPossible(runOnSuccess);
				}, function errorCallback(response){
					runFunctionIfPossible(runOnFailed);
				});
		}
	}

	$scope.runPost = function(post, data,  runOnSuccess, runOnFailed){
		$http.post(post, data)
			.then(function(response){
				console.log(response);
				runFunctionIfPossible(runOnSuccess);
			}, function errorCallback(response){
				runFunctionIfPossible(runOnFailed);
			});
	}

	$scope.deleteWithRedirect = function(id, name){
		$scope.deleteById(id, name, $scope.redirectToIndex);
	}

	$scope.redirectToIndex = function(){
		$window.location.href ="../../index.php";
	}

	$scope.setFromGet = function(get, setFunct, runOnFailed){
		runOnFailed = runOnFailed || failedHTTPLog;
		$http.get(get).then(function(response){
			setFunct(response.data);
		}, function errorCallback(response){
			runFunctionIfPossible(runOnFailed);
		});
	}

	$scope.capitalizeFirstLetter = function(s){
		return s.capitalizeFirstLetter();
	}

	$scope.setById = function(setFunct){
		var id = getIDValueFromUrl();
		if(id){
			var get = 'data.php?id='+id;
			$scope.setFromGet(get, setFunct);
		}
	}

	$scope.arrayToString = function(array){
		var string = "";
		if(array){
			for(var i=0; i<array.length; i++){
				string += array[i]+", ";
			}
			return cutStringByNumberOfCharacters(string, 2);
		}
		return string;
	}

	$scope.hashArrayValueToString = function(hashList, value){
		var string = "";
		if(hashList && value){
			for(var i=0; i<hashList.length; i++){
				var hash = hashList[i];
				string += hash[value]+", ";
			}
			return cutStringByNumberOfCharacters(string, 2);
		}
		return string;
	}

	$scope.getDateDisplay = function(date){
		return moment(date).format('dddd MMMM Do YYYY');
	}

	$scope.getTimeDisplay = function(time){
		return moment(time).format('h:mma');
	}

	$scope.columnSizeByHash = function(hash, size, max){
		var length = Object.keys(hash).length;
		var c = "col-"+size+"-";
		return (length <= 12 && length >0 && length <=max) ? 'col-'+size+'-'+(Math.floor(12/length)) : '';
	}

	$scope.getKeys = function(hash){
		var keys = (hash) ? Object.keys(hash) : [];
		for(var i=0; i<keys.length; i++){
			if(keys[i] == "$$hashKey"){keys.splice(i, 1);}
		}
		return keys;
	}

	$scope.columnSizeByArray = function(array, size, max){
		var length = array.length;
		var c = "col-"+size+"-";
		return (length <= 12 && length >0 && length <=max) ? 'col-'+size+'-'+(Math.floor(12/length)) : '';
	}

}]);

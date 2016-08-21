@extends('templates.app')

@section('content')
    <div class="row container-fluid" ng-controller="OneTimePadIndexController">
        <div class="panel panel-default">

            <div class="panel-heading clearfix">
                <h1 class="panel-title pull-left" style="padding-top: 7.5px;">One Time Pad</h1>
                @yield("additionalHeaderContent")
            </div>

            <div class="panel-body">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading clearfix">
                            <h2 class="panel-title pull-left" style="padding-top: 7.5px;">Text To Be <% (decrypt==true) ? 'Decrypted' : 'Encrypted' %></h2>
                        </div>
                        <div class="panel-body">
                            <textarea rows="10" class="form-control" placeholder="Text To be <% (decrypt==true) ? 'Decrypted' : 'Encrypted' %>" ng-model="textToEncrypt"></textarea>
                        </div>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading clearfix">
                            <h2 class="panel-title pull-left" style="padding-top: 7.5px;">Text Used To <% (decrypt==true) ? 'Decrypt' : 'Encrypt' %></h2>
                        </div>
                        <div class="panel-body">
                            <textarea rows="10" placeholder="Text that will be used to <% (decrypt==true) ? 'Decrypted' : 'Encrypted' %>" class="form-control" ng-model="textUsedToEncrypt"></textarea>
                        </div>
                    </div>
                </div>
                <span ng-show="textCanBeEncrptyed() && textToEncrypt.length> textUsedToEncrypt.length && !decrypt">Note: <% (decrypt==true) ? 'Decryption' : 'Encryption' %> key not long enough, key will be repeated</span>
            </div>
        </div>

        <div class="panel-footer">
            <button class="btn btn-primary" ng-disabled="!textCanBeEncrptyed()" ng-click="(decrypt) ? decryptText() : encrypt()"><% (decrypt==true) ? 'Decrypt' : 'Encrypt' %></button>
            <a class="btn btn-default" href="{{ProjectRoute::getProjectBase()}}">Back</a>

            <div class="checkbox pull-right">
                <label id="decrypt"><input type="checkbox" ng-model="decrypt">Decrypt</label>
            </div>
        </div>

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h2 class="panel-title pull-left" style="padding-top: 7.5px;">Output</h2>
                </div>
                <div class="panel-body">
                    <textarea rows="5" disabled placeholder="Output Text Will Appear Here" class="form-control" ng-model="finalText"></textarea>
                </div>
            </div>
        </div>
    </div>


@stop

@section('scripts')
    <script>
        app.controller("OneTimePadIndexController", ['$scope', "$controller", function($scope, $controller) {

            angular.extend(this, $controller('UtilsController', {$scope: $scope}));

            $scope.encrypt = function(){
                if($scope.textCanBeEncrptyed()){
                    var finalText = [];
                    var arrayOfTextToEncrypt = getArrayFromString($scope.textToEncrypt);
                    var arrayOfEncryptionText = getArrayFromString($scope.textUsedToEncrypt);

                    angular.forEach(arrayOfTextToEncrypt, function(letter, n){
                        var numberValue = getLetterAsNumber(letter);
                        var letterToUseForEncryption = getArrayValueWithRepeat(arrayOfEncryptionText, n);
                        var encyptionNumberValue = getLetterAsNumber(letterToUseForEncryption);
                        finalText.push(numberValue+encyptionNumberValue);
                    });

                    $scope.finalText  = finalText.toLocaleString();
                }
            };

            function getArrayFromString(string){
                return string.split(/(?=.)/u);
            }

            $scope.textCanBeEncrptyed = function(){
                return $scope.textUsedToEncrypt && $scope.textToEncrypt &&
                        $scope.textUsedToEncrypt.length > 0 && $scope.textToEncrypt.length > 0;
            };

            const lettersAsNumbers = {
                'a' : 1, 'b' : 2, 'c' : 3, 'd' : 4, 'e' : 5, 'f':6, 'g':7, 'h':8, 'i':9,'j':10, 'k':11, 'l':12, 'm':13, 'n':14, 'o':15, 'p': 16, 'q':17, 'r':18, 's':19, 't':20, 'u':21, 'v':22, 'w' : 23, 'x':24, 'y':25,'z':26, '0':27, '1':28, '2':29,'3':30, '4':31, '5':32, '6':33, '7': 34, '8':35,'9':36, ' ':37
            };
            function getLetterAsNumber(letter){
                if(letter){
                    var letterToSearchFor = letter.toLocaleString().toLowerCase();
                    return lettersAsNumbers[letterToSearchFor] || letter;
                }
                return null;
            }

            function getArrayValueWithRepeat(array, arrayIndexNumber){
                if(array && array.length-1 >0){
                    while(arrayIndexNumber > array.length-1){
                        arrayIndexNumber = arrayIndexNumber-array.length;
                    }
                    return array[arrayIndexNumber];
                }
                return null;
            }

            $scope.decryptText = function(){
                if($scope.textCanBeEncrptyed()){
                    var finalText = "";
                    var arrayOfNumbers = getArrayOfNumbers($scope.textToEncrypt);
                    var arrayOfEncryptionText = getArrayFromString($scope.textUsedToEncrypt);

                    angular.forEach(arrayOfNumbers, function(number, counter){
                        var letterToUseForDecryption = getArrayValueWithRepeat(arrayOfEncryptionText, counter);
                        var numberValueOfDecryptionLetter = getLetterAsNumber(letterToUseForDecryption);
                        var decrpytedLetterAsNumber = number- numberValueOfDecryptionLetter;
                        var plainTextLetter = getNumberAsLetter(decrpytedLetterAsNumber);
                        finalText += plainTextLetter;

                    });
                    $scope.finalText  = finalText.toLocaleString();
                }else{
                    $scope.finalText = "Text Cannot be Decrypted";
                }

            }

            function getArrayOfNumbers(textToConvert){
                if(textToConvert){
                    var array  = textToConvert.split(',');
                    var finalArray = [];
                    angular.forEach(array, function(row){
                        var intVal = parseInt(row, 10);
                        finalArray.push(intVal);
                    });
                    return finalArray;
                }
                return null;
            }

            function getNumberAsLetter(number){
                return keyFromValueInHash(lettersAsNumbers, number);
            }

        }]);

    </script>




@stop
/**
 * Created by cbhudson on 8/5/16.
 */

function getUrlValueByParam(param){
	var p = location.search.split(param+"=")[1]
	return (p) ? p.split("&")[0] : null;
}

function setColorByElementId(elementId, color){
	var element = document.getElementById(elementId);
	if(element){
		element.style.color = color;
	}
}

String.prototype.capitalizeFirstLetter = function() {
	return this.charAt(0).toUpperCase() + this.slice(1);
}

function createRequestUrlWithParams(base, params){
	var keys = Object.keys(params);
	var url = base;
	for(var i=0; i<keys.length; i++){
		var adder = (i==0) ? "?" : "&";
		url = url +adder+keys[i]+"="+params[keys[i]];
	}
	return url;
}

function failedHTTPLog(){
	console.log("HTTP call was not sucessfull.");
}

function cutStringByNumberOfCharacters(string, n){
	return string.substring(0, (string.length-n));
}

//Will run function if one is passed
function runFunctionIfPossible(funt){
	if(funt){funt();}
}

function randomKeyFromHash(hash){
	return randomFromArray(Object.keys(hash));
}

function isEdit(){
	return getIDValueFromUrl() != null;
}

function isNumeric(n) {
	return !isNaN(parseFloat(n)) && isFinite(n);
}

function randomRange(min, max){
	return Math.floor(Math.random() * max) + min;
}

Array.prototype.findByProperty = function(value, param){
	param = param || 'id';
	for(var i=0; i<this.length; i++){
		if(this[i][param] == value){return this[i];}
	}
	return null;

};

String.prototype.parseEscape = function(defaultValue){
	var val = defaultValue || {};
	try{val = JSON.parse(this.escapeSpecialChars());}
	catch(e){};
	return val;
};

String.prototype.display = function(){
	return this.replace(new RegExp( "\n", "g" ), "<br />")
};


String.prototype.escapeSpecialChars = function() {
	return this.replace(new RegExp( "\n", "g" ), "\\n")
		.replace(new RegExp( "'", "g" ), "\\'")
		.replace(new RegExp("\'", "g"), "\\'")
		.replace(new RegExp("\r", "g"), "\\r")
		.replace(new RegExp("\t", "g"), "\\t")
		.replace(new RegExp("\b", "g"), "\\b")
		.replace(new RegExp("\f", "g"), "\\f");
};

function getFeet(n){
	return Math.floor(Number(n)/12);
}

function getInches(n){
	return Math.floor(Number(n)%12);
}

function logObject(object){
	console.log(JSON.stringify(object));
}

function combineStringWithSpace(s1, s2){
	return s1+" "+s2;
}

function getDisplayMilitaryTime(time){
	var n = Number(time.split(":")[0]);
	var amPm = (n < 12) ? 'am' : "pm";
	var nRight = (n > 12) ? n-12 : n;
	return nRight+":"+time.split(":")[1]+amPm;
}

function getFractionAsString(float){
	var f = new Fraction(Number(float));
	return (f.denominator > 1) ? f.numerator + '/' + f.denominator : f.numerator;
}

function getIDValueFromUrl(){
	var id = getUrlValueByParam("id");
	return (id && isNumeric(id)) ? id : null;
}

function getWidthPlusPercent(width, percent){
	return width+(width*percent);
}

function cloneHashObject(h){
	var hash = {};
	if(h){
		var keys= Object.keys(h);
		for(var i=0; i<keys.length; i++){
			var key = keys[i];
			hash[key] = h[key];
		}
	}
	return hash;

}

function keyFromValueInHash(hash, value){
	for ( key in hash){
		if(hash[key] == value){
			return key;
		}
	}
}

function convertListOfHashValuesToNumbers(array, list){
	for(var i=0; i<array.length; i++){
		array[i] = convertValuesToNumbers(array[i], list);
	}
	return array;
}

function convertValuesToNumbers(hash, list){
	for(var i=0; i<list.length; i++){
		var value = list[i];
		hash[value] = Number(hash[value]);
	}
	return hash;
}


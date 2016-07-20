
window.onload = function(){
	displayErrorMessage();
}

function displayErrorMessage(){

	var error_box_div;
	var error_box_style;
	var errorMessage;

	var error_box_name = "error-box";
	var error_box_style_css = "."+error_box_name+"{" +
		"margin:40%;" +
		"padding:15px;" +
		"white-space: nowrap;" +
		"opacity: 1;" +
		"background: rgb(255, 0, 0);" +
		"position: fixed;" +
		"border-radius: 25px;" +
		"" +
		"color: white;" +
		"text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;" +
		"font-size: large;" +
		"font-weight: bold;" +
		"" +
		"background: rgb(200, 14, 39);" +
		"margin-top: 2%;" +
		"margin-bottom: 5px; " +
		"" +
		"-moz-transition: opacity 1.5s; " +
		"-webkit-transition: opacity 1.5s; " +
		"-o-transition: opacity 1.5s;" +
		"transition: opacity 2.5s;" +
		"transition-delay: 3s;" +
		"z-index: 100;" +
		"}";

	findErrorMessageFromUrl();
	if(errorMessage){
		generateErrorBox(errorMessage);
	}

	function findErrorMessageFromUrl(){
		var em = getUrlParam("error");
		errorMessage = decodeURI(em);
	}

	function getUrlParam(param){
		var p = location.search.split(param+"=")[1]
		return (p) ? p.split("&")[0] : null;
	}

	function generateErrorBox(errorMessage){
		createErrorBoxDiv();
		createErrorStyle();
		appendErrorStyleToDocumentHead();
		error_box_div.className = error_box_name;
		appendErrorDivToStartOfBody()
	}

	function createErrorBoxDiv(){
		var div = document.createElement("div");
		div.id = error_box_name;
		div.innerHTML = errorMessage;
		error_box_div = div;
	}

	function createErrorStyle(){
		var style = document.createElement('style');
		style.type = 'text/css';
		style.innerHTML = error_box_style_css;
		error_box_style = style;
	}

	function appendErrorStyleToDocumentHead(){
		var documentHead = document.getElementsByTagName('head')[0];
		if(!documentHead){
			documentHead = document.createElement("HEAD");
			document.appendChild(documentHead);
		}
		documentHead.appendChild(error_box_style);
	}

	function appendErrorDivToStartOfBody(){
		var documentBody = document.getElementsByTagName('body')[0];
		if(!documentBody){
			documentBody = document.createElement("BODY");
			document.appendChild(documentBody);
		}
		documentBody.insertBefore(error_box_div, documentBody.childNodes[0]);
	}

}




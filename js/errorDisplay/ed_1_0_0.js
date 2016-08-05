window.onload = function () {
	displayErrorMessage();
}

function displayErrorMessage(){
	var error_box_div;
	var error_box_style;
	var fade_out_error_box_style;
	var errorMessage;

	const ERROR_BOX_NAME = "error-box";
	const ERROR_BOX_STYLE_CSS = "."+ERROR_BOX_NAME+"{" +
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

	const FADE_OUT_ERROR_BOX_STYLE_CSS = ".fade-out-error-box{"+
		"opacity: 0;"+
		"}"

	findErrorMessageFromUrl();
	if(errorMessage){
		generateErrorBox(errorMessage);
	}

	function findErrorMessageFromUrl(){
		var em = getUrlParam("error");
		if(em){
			errorMessage = decodeURI(em);
		}
	}

	function getUrlParam(param){
		var p = location.search.split(param+"=")[1]
		return (p) ? p.split("&")[0] : null;
	}

	function generateErrorBox(errorMessage){
		createErrorBoxDiv();
		error_box_style = createStyleWithInnerHTML(ERROR_BOX_STYLE_CSS);
		fade_out_error_box_style = createStyleWithInnerHTML(FADE_OUT_ERROR_BOX_STYLE_CSS);
		appendStyleToHead(error_box_style);
		appendStyleToHead(fade_out_error_box_style);
		error_box_div.className = ERROR_BOX_NAME;
		appendErrorDivToStartOfBody();
		appendFadeOutStyleToErrorBox();
	}

	function createErrorBoxDiv(){
		var div = document.createElement("div");
		div.id = ERROR_BOX_NAME;
		div.innerHTML = errorMessage;
		error_box_div = div;
	}

	function createStyleWithInnerHTML(innerHTML){
		var style = document.createElement('style');
		style.type = 'text/css';
		style.innerHTML = innerHTML;
		return style;
	}

	function appendStyleToHead(style){
		var documentHead = getFirstElemementByTagOrCreateNew('head');
		documentHead.appendChild(style);
	}

	function getFirstElemementByTagOrCreateNew(elementName){
		var element = document.getElementsByTagName(elementName)[0];
		if(!element){
			element = document.createElement(elementName);
			document.appendChild(element);
		}
		return element;
	}

	function appendErrorDivToStartOfBody(){
		var documentBody = getFirstElemementByTagOrCreateNew('body');
		documentBody.insertBefore(error_box_div, documentBody.childNodes[0]);
	}

	function addFadeOutStyleToDocumentHead(){
		var documentHead = getFirstElemementByTagOrCreateNew('head');
		documentHead.appendChild(fade_out_error_box_style);
	}

	function appendFadeOutStyleToErrorBox(){
		setTimeout(function () {
			error_box_div.className = error_box_div.className.concat(" fade-out-error-box");
		}, 0);
	}

}
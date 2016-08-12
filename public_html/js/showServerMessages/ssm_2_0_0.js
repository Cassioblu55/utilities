function showServerMessage(urlParamsToCreateMessages, replaceDefaultMessages){
	var messagesDisplayedCount = 0;
	const delayBetweenMessages = 250;

	addDefaultUrlParamsToCreateMessages();
	getDefualtCSSForMessagesWithoutCSS();
	addMessageBoxStylesToHeader();
	displayMessagesCallBackOnUrlParamPresent();

	function addDefaultUrlParamsToCreateMessages(){
		if(!urlParamsToCreateMessages || (urlParamsToCreateMessages && !replaceDefaultMessages)){
			urlParamsToCreateMessages = (!urlParamsToCreateMessages) ? [] : urlParamsToCreateMessages;

			addDefaultUrlParamMessage("errorMessage");
			addDefaultUrlParamMessage("successMessage");
			addDefaultUrlParamMessage("defaultMessage");

			function addDefaultUrlParamMessage(urlParam){
				var messageTrigger = {};
				messageTrigger.urlParam = urlParam;
				messageTrigger.css = getDefaultCSS(urlParam);
				messageTrigger.messageBoxName = urlParam+"-messageBox";


				urlParamsToCreateMessages.push(messageTrigger);
			}
		}
	}

	function getDefualtCSSForMessagesWithoutCSS(){
		for(var i=0; i<urlParamsToCreateMessages.length; i++){
			var messageTrigger = urlParamsToCreateMessages[i];
			if(messageTrigger.css == null){
				messageTrigger.css = getDefaultCSS(messageTrigger.urlParam);
			}
		}
	}

	function getDefaultCSS(urlParam){
		var backgroundColor = getBackgroundColorFromUrlParam(urlParam);
		var css = createCSSFromUrlParamAndBackgroundColor(urlParam, backgroundColor);
		return css;
	}

	function getBackgroundColorFromUrlParam(urlParam){
		const errorMessageBackgroundColor = "rgb(200, 0, 0)";
		const successMessageBackgroundColor = "rgb(0, 230, 0)";
		const defaultMessageBackgroundColor = "rgb(179, 179, 179)";

		if(urlParam == "errorMessage"){
			return errorMessageBackgroundColor;
		}else if(urlParam == "successMessage"){
			return successMessageBackgroundColor;
		}else{
			return defaultMessageBackgroundColor;
		}
	}

	function createCSSFromUrlParamAndBackgroundColor(urlParam, backgroundColor){
		return "."+urlParam+"-message-box{"+
			"margin:40%;" +
			"padding:15px;" +
			"white-space: nowrap;" +
			"opacity: 0;" +
			"position: fixed;" +
			"border-radius: 25px;" +
			"background: "+backgroundColor+";"+
			"color: white;" +
			"text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;" +
			"font-size: large;" +
			"font-weight: bold;" +
			"" +
			"margin-bottom: 5px; " +
			"" +
			"-moz-transition: opacity 1.5s; " +
			"-webkit-transition: opacity 1.5s; " +
			"-o-transition: opacity 1.5s;" +
			"transition: opacity 2.5s;" +
			"z-index: 100;" +
			"}";
	}

	function addMessageBoxStylesToHeader() {
		var cSSStringOfURLMessages = getCSSStringOfURLMessages();
		var standardCSS = getStandardCSSStylesArray();

		appendListOfStylesToHead(cSSStringOfURLMessages);
		appendListOfStylesToHead(standardCSS);

		function getCSSStringOfURLMessages(){
			var cSSStringOfURLMessages = [];
			for(var i=0; i<urlParamsToCreateMessages.length; i++){
				var messageTrigger = urlParamsToCreateMessages[i];
				cSSStringOfURLMessages.push(messageTrigger.css);
			}
			return cSSStringOfURLMessages;
		}

		function getStandardCSSStylesArray(){
			const FADE_OUT_MESSAGE_BOX_STYLE_CSS = ".fade-out-message-box{"+
				"opacity: 0;"+
				"-o-transition: opacity 1.5s;" +
				"transition: opacity 2.5s;" +
				"transition-delay: 3s;" +
				"}";

			const FADE_IN_MESSAGE_BOX_STYLE_CSS = ".fade-in-message-box{"+
				"opacity: 1;"+
				"}";

			var standardCSSStylesArray = [];
			standardCSSStylesArray.push(FADE_OUT_MESSAGE_BOX_STYLE_CSS);
			standardCSSStylesArray.push(FADE_IN_MESSAGE_BOX_STYLE_CSS);
			return standardCSSStylesArray;
		}

		function appendListOfStylesToHead(listOfStylesToAppend){
			for(var i=0; i<listOfStylesToAppend.length; i++){
				var styleToAppend = listOfStylesToAppend[i];
				appendStyleToHeadWithInnerHTML(styleToAppend);
			}
		}

		function appendStyleToHeadWithInnerHTML(innerHTML){
			var documentHead = getFirstElementByTagOrCreateNew('head');
			var style = createStyleWithInnerHTML(innerHTML);
			documentHead.appendChild(style);
		}

		function createStyleWithInnerHTML(innerHTML){
			var style = document.createElement('style');
			style.type = 'text/css';
			style.innerHTML = innerHTML;
			return style;
		}

	}

	function getFirstElementByTagOrCreateNew(elementName){
		var element = document.getElementsByTagName(elementName)[0];
		if(!element){
			element = document.createElement(elementName);
			document.appendChild(element);
		}
		return element;
	}

	function displayMessagesCallBackOnUrlParamPresent(){
		var i=0, max=urlParamsToCreateMessages.length-1;
		generateMessage();

		function generateMessage () {
			setTimeout(function () {
				var messageTrigger = urlParamsToCreateMessages[i];
				var messageToDisplay = getUrlParam(messageTrigger.urlParam);
				if(messageToDisplay){
					displayMessage(messageToDisplay, messageTrigger);
					messagesDisplayedCount++;
				}
				if(i < max){
					generateMessage(++i);
				}
			}, getDelayAmount());
		}
	}

	function getUrlParam(param){
		var p = location.search.split(param+"=")[1]
		return (p) ? decodeURI(p.split("&")[0]) : null;
	}

	function displayMessage(messageToDisplay, messageTrigger){
		var message_box_div;
		var messageBoxClass = getClassNameFromCssString();

		generateErrorBox();

		function generateErrorBox(){
			createMessageBoxDiv();
			message_box_div.className = messageBoxClass;
			setMarginTop();
			appendMessageDivToStartOfBody();
			appendFadeInStyleToErrorBox();
			appendFadeOutStyleToErrorBox();
		}

		function createMessageBoxDiv(){
			var div = document.createElement("div");
			div.id = messageTrigger.messageBoxName || messageTrigger.urlParam;
			div.innerHTML = messageToDisplay;
			message_box_div = div;
		}

		function getClassNameFromCssString(){
			var css =  messageTrigger.css;
			var instanceOfOpeningBracket = (css.indexOf("{") > -1) ? css.indexOf("{") : css.length;
			return css.substring(1, instanceOfOpeningBracket);
		}

		function setMarginTop(){
			message_box_div.style["margin-top"] = getDivMargin();
		}

		function getDivMargin(){
			var baseSpace = screen.height*0.02;
			var spacerAmount = baseSpace + (messagesDisplayedCount*60);
			return spacerAmount + "px";
		}

		function appendMessageDivToStartOfBody(){
			var documentBody = getFirstElementByTagOrCreateNew('body');
			documentBody.insertBefore(message_box_div, documentBody.childNodes[0]);
		}

		function appendFadeInStyleToErrorBox(){
			setTimeout(function () {
				message_box_div.className = messageBoxClass.concat(" fade-in-message-box");
			}, getDelayAmount());
		}

		function appendFadeOutStyleToErrorBox(){
			setTimeout(function () {
				message_box_div.className = messageBoxClass.concat(" fade-out-message-box");
			}, getDelayAmount()+1500);
		}
	}

	function getDelayAmount(){
		return delayBetweenMessages*messagesDisplayedCount;
	}

}
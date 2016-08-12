window.onload = function () {
	findMessagesToDisplay();
}

function findMessagesToDisplay(){
	const errorMessageBackgroundColor = "rgb(200, 0, 0)";
	const successMessageBackgroundColor = "rgb(0, 230, 0)";
	const defaultMessageBackgroundColor = "rgb(179, 179, 179)";
	
	const URL_PARAMS_RESPONDED_TO_WITH_BACKGROUND_COLOR = {errorMessage : errorMessageBackgroundColor, successMessage : successMessageBackgroundColor, defaultMessage : defaultMessageBackgroundColor};

	var messagesDisplayedCount = 0;
	const delayBetweenMessages = 250;

	addMessageBoxStylesToHeader();
	displayMessagesCallBackOnUrlParamPresent();
	
	function addMessageBoxStylesToHeader() {
		const MESSAGE_BOX_STYLE_CSS = ".message-box{" +
			"margin:40%;" +
			"padding:15px;" +
			"white-space: nowrap;" +
			"opacity: 0;" +
			"position: fixed;" +
			"border-radius: 25px;" +
			"" +
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

		const FADE_OUT_MESSAGE_BOX_STYLE_CSS = ".fade-out-message-box{"+
			"opacity: 0;"+
			"-o-transition: opacity 1.5s;" +
			"transition: opacity 2.5s;" +
			"transition-delay: 3s;" +
			"}";

		const FADE_IN_MESSAGE_BOX_STYLE_CSS = ".fade-in-message-box{"+
			"opacity: 1;"+
			"}";


		appendStyleToHeadWithInnerHTML(MESSAGE_BOX_STYLE_CSS);
		appendStyleToHeadWithInnerHTML(FADE_OUT_MESSAGE_BOX_STYLE_CSS);
		appendStyleToHeadWithInnerHTML(FADE_IN_MESSAGE_BOX_STYLE_CSS);

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
		const URL_RESPOND_KEYS = Object.keys(URL_PARAMS_RESPONDED_TO_WITH_BACKGROUND_COLOR);
		var i=0, max=URL_RESPOND_KEYS.length;
		generateMessage();

		function generateMessage () {           //  create a loop function
			setTimeout(function () {    //  call a 3s setTimeout when the loop is called
				var message_box_name = URL_RESPOND_KEYS[i];
				var messageToDisplay = getUrlParam(message_box_name);
				if(messageToDisplay){
					var backgroundColorOfMessageBox = URL_PARAMS_RESPONDED_TO_WITH_BACKGROUND_COLOR[message_box_name];
					displayMessage(messageToDisplay, backgroundColorOfMessageBox, message_box_name);
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

	function getDelayAmount(){
		return delayBetweenMessages*messagesDisplayedCount;
	}

	function displayMessage(messageToDisplay, backgroundColorOfMessageBox, messageBoxName){
		var message_box_div;

		generateErrorBox();

		function generateErrorBox(){
			createMessageBoxDiv();
			message_box_div.className = "message-box";
			setBackgroundColor();
			setMarginTop();
			appendMessageDivToStartOfBody();
			appendFadeInStyleToErrorBox();
			appendFadeOutStyleToErrorBox();
		}

		function createMessageBoxDiv(){
			var div = document.createElement("div");
			div.id = messageBoxName;
			div.innerHTML = messageToDisplay;
			message_box_div = div;
		}

		function setBackgroundColor(){
			message_box_div.style["background"] = backgroundColorOfMessageBox;
		}

		function setMarginTop(){
			message_box_div.style["margin-top"] = getDivMargin();
		}

		function appendMessageDivToStartOfBody(){
			var documentBody = getFirstElementByTagOrCreateNew('body');
			documentBody.insertBefore(message_box_div, documentBody.childNodes[0]);
		}

		function appendFadeInStyleToErrorBox(){
			setTimeout(function () {
				message_box_div.className = message_box_div.className.concat(" fade-in-message-box");
			}, getDelayAmount());
		}

		function appendFadeOutStyleToErrorBox(){
			setTimeout(function () {
				message_box_div.className = "message-box fade-out-message-box";
			}, getDelayAmount()+1500);
		}
	}

	function getDivMargin(){
		var baseSpace = screen.height*0.02;
		var spacerAmount = baseSpace + (messagesDisplayedCount*60);
		return spacerAmount + "px";
	}
	
}



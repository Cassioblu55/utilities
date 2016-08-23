function displayMessageFromUrlPrams(urlParamsToCreateMessages, replaceDefaultMessages, lifeSpanInMills){

	const DEFAULT_SERVER_MESSAGES_DATA_URL = "http://cassiohudson.com/utilities/defaultServerMessages/data";
	const DEFAULT_CSS_PATH = DEFAULT_SERVER_MESSAGES_DATA_URL+"/findCSSByUrlParam?name=defaultMessage";
	const DELAY_BETWEEN_MESSAGES = 350;
	const SPACE_BETWEEN_MESSAGES = 60;

	var defaultCSSClass;
	var messagesDisplayedCount = 0;
	urlParamsToCreateMessages = urlParamsToCreateMessages || [];

	getDefualtCSSForMessagesWithoutCSS();

	function getDefualtCSSForMessagesWithoutCSS(){
		var xhr = makeCORSRequest('GET', DEFAULT_CSS_PATH);
		xhr.onload = function () {
			var responseData = JSON.parse(xhr.responseText);
			addDefaultCSSClassToHead(responseData);
			defaultCSSClass = responseData.css_class_name;
			displayMessages();
		};
		xhr.send();
	}

	function addDefaultCSSClassToHead(messageDisplay){
		var innerHTML = createCssFromDisplayMessage(messageDisplay);
		var style = createStyleWithInnerHTML(innerHTML);
		if(style != null){
			var head = getFirstElementByTagOrCreateNew("head");
			head.appendChild(style);
		}
	}

	function displayMessages(){
		displayMessagesIfUrlPresent(urlParamsToCreateMessages);
		displayDefaultServerMessages();
	}

	function displayMessagesIfUrlPresent(listOfMessages) {
		if (listOfMessages.length > 0) {
			var i = 0, max = listOfMessages.length - 1;

			generateMessage();
			function generateMessage() {
				setTimeout(function () {
					var messageTrigger = listOfMessages[i];
					var messageToDisplay = getUrlParam(messageTrigger.url_param);
					if (messageToDisplay) {
						var messageDisplay = new MessageDisplay(lifeSpanInMills);
						var topMargin = getDivMargin();
						var delay = getDelayAmount()
						messageDisplay.setMarginTop(topMargin);
						messageDisplay.setMessageDisplayData(messageTrigger);
						messageDisplay.showMessage(messageToDisplay, delay);
						messageDisplay.clean(delay);
						messagesDisplayedCount++;
					}
					if (i < max) {
						generateMessage(++i);
					}
				}, getDelayAmount());
			}
		}
	}

	function getUrlParam(param){
		var p = location.search.split(param+"=")[1]
		return (p) ? decodeURI(p.split("&")[0]) : null;
	}

	function getDivMargin(){
		var spacerAmount = screen.height*0.02+(SPACE_BETWEEN_MESSAGES*messagesDisplayedCount);
		return spacerAmount + "px";
	}


	function displayDefaultServerMessages() {
		if(!replaceDefaultMessages){
			var xhr = makeCORSRequest('GET', DEFAULT_SERVER_MESSAGES_DATA_URL);
			xhr.onload = function() {
				var responseData = JSON.parse(xhr.responseText);
				displayMessagesIfUrlPresent(responseData);
			};
			xhr.send();
		}
	}

	function getDelayAmount(){
		return DELAY_BETWEEN_MESSAGES*messagesDisplayedCount;
	}

	function makeCORSRequest(method, url, errorCallback) {
		var xhr = new XMLHttpRequest();
		errorCallback = errorCallback || function() {
				console.log('There was an error!');
			};

		attemptConnectionWithDefault();
		attemptConenctionOnIE();
		setNullIfCORSNotSupported();
		if(xhr != null){
			xhr.onerror = errorCallback;
		}

		function attemptConnectionWithDefault(){
			if ("withCredentials" in xhr) {
				xhr.open(method, url, true);
			}
		}

		function attemptConenctionOnIE(){
			if (!"withCredentials" in xhr && typeof XDomainRequest != "undefined") {
				xhr = new XDomainRequest();
				xhr.open(method, url);
			}
		}

		function setNullIfCORSNotSupported(){
			if (!"withCredentials" in xhr && typeof XDomainRequest == "undefined") {
				xhr = null;
			}
		}

		return xhr;
	}

	function createCssFromDisplayMessage(messageDisplay){
		if(notBlank(messageDisplay.css_class_name) && notBlank(messageDisplay.css)){
			return "."+messageDisplay.css_class_name+"{"+messageDisplay.css+"}";
		}
		return null;
	}

	function notBlank(string){
		return (string && string.length != 0);
	}

	function getFirstElementByTagOrCreateNew(elementName){
		var element = document.getElementsByTagName(elementName)[0];
		if(!element){
			element = document.createElement(elementName);
			document.appendChild(element);
		}
		return element;
	}

	function createStyleWithInnerHTML(innerHTML){
		var style = document.createElement('style');
		style.type = 'text/css';
		style.innerHTML = innerHTML;
		return style;
	}

	var MessageDisplay = function(lifeSpanInMills){
		var that = {};
		lifeSpanInMills = lifeSpanInMills || 7000;
		var messageDisplayData;
		var messageBoxId;
		var fadeOutClassName;
		var fadeInClassName;
		var styleWrapperId;
		var timeOut;
		var marginTop;

		function setMessageDisplayData(mdd){
			messageDisplayData = mdd;
			messageBoxId = messageDisplayData.message_box_name || messageDisplayData.url_param;

			styleWrapperId = "style_wrapper-".concat(notBlank(messageDisplayData.css_class_name) ? messageDisplayData.css_class_name : messageDisplayData.url_param);
			var css_style = createCssFromDisplayMessage(mdd);
			fadeOutClassName = "fade-out-message-box-".concat(messageBoxId);
			fadeInClassName = "fade-in-message-box-".concat(messageBoxId);

			clearNow();
			destoryIfExistsById(styleWrapperId);
			appendWrapper();
			appendStyle();
			if(messageDisplayData.fade_in){appendFadeInStyle();}
			if(messageDisplayData.fade_out){appendFadeOutStyle();}

			function clearNow(){
				clearTimeout(timeOut);
				destoryIfExistsById(styleWrapperId);
			}

			function appendWrapper(){
				var documentBody = getFirstElementByTagOrCreateNew('body');
				var styleWrapper = document.createElement("div");
				styleWrapper.id = styleWrapperId;
				documentBody.insertBefore(styleWrapper, documentBody.childNodes[0]);
			}

			function appendStyle(){
				if(css_style != null){
					var style = createStyleWithInnerHTML(css_style);
					appendStyleToWrapper(style);
				}
			}

			function appendStyleToWrapper(style){
				var styleWrapper = document.getElementById(styleWrapperId);
				styleWrapper.appendChild(style);
			}

			function appendFadeInStyle(){
				var fadeInMessageBoxStyle = "."+fadeInClassName+"{"+
					"opacity: 1;"+
					"-moz-transition: opacity 1.5s;"+
					"-webkit-transition: opacity 1.5s;"+
					"-o-transition: opacity 1.5s;"+
					"transition: opacity 1.5s;"+
					"}";
				var style = createStyleWithInnerHTML(fadeInMessageBoxStyle);
				appendStyleToWrapper(style);
			}

			function appendFadeOutStyle(){
				var fateOutMessageBoxStyle = "."+fadeOutClassName+"{"+
					"opacity: 0;"+
					"-moz-transition: opacity 1.5s;"+
					"-o-transition: opacity 1.5s;" +
					"transition: opacity 2.5s;" +
					"transition-delay: 3s;" +
					"}";
				var style = createStyleWithInnerHTML(fateOutMessageBoxStyle);
				appendStyleToWrapper(style);
			}
		}
		that.setMessageDisplayData = setMessageDisplayData;

		function setMarginTop(tm){
			marginTop = tm;
		}
		that.setMarginTop = setMarginTop;

		function showMessage(messageToDisplay, delay){
			var className = (notBlank(messageDisplayData.css_class_name)) ? messageDisplayData.css_class_name : defaultCSSClass;
			var message_box_div;
			var topMargin;
			clearNow();
			destoryIfExistsById(messageBoxId);
			createMessageBoxDiv();
			message_box_div.style["margin-top"] = marginTop;
			message_box_div.className = className
			appendMessageDivToStartOfBody();
			if(messageDisplayData.fade_in){appendFadeInStyleToErrorBox();}
			if(messageDisplayData.fade_out){appendFadeOutStyleToErrorBox();}

			function clearNow(){
				clearTimeout(timeOut);
				destoryIfExistsById(messageBoxId);
			}

			function createMessageBoxDiv(){
				var div = document.createElement("div");
				div.id = messageBoxId;
				div.innerHTML = messageToDisplay;
				message_box_div = div;
			}

			function appendMessageDivToStartOfBody(){
				var documentBody = getFirstElementByTagOrCreateNew('body');
				documentBody.insertBefore(message_box_div, documentBody.childNodes[0]);
			}

			function appendFadeInStyleToErrorBox(){
				setTimeout(function () {
					message_box_div.className = className.concat(" ").concat(fadeInClassName);
				},delay);
			}

			function appendFadeOutStyleToErrorBox(){
				setTimeout(function () {
					message_box_div.className = className.concat(" ".concat(fadeOutClassName));
				}, delay+1500);
			}
		}
		that.showMessage = showMessage;

		function destoryIfExistsById(elementId){
			var possibleElement =  document.getElementById(elementId);
			if(possibleElement){possibleElement.parentNode.removeChild(possibleElement);}
		}

		function clean(delay){
			timeOut = setTimeout(function () {
				destoryIfExistsById(messageBoxId);
				destoryIfExistsById(styleWrapperId);
			}, lifeSpanInMills+delay);
		}
		that.clean = clean;

		return that;
	};
}
var MessageDisplay = function(lifeSpanInMills){
	var that = {};
	lifeSpanInMills = lifeSpanInMills || 7000;
	var messageDisplayData;
	var messageBoxId;
	var fadeOutClassName;
	var fadeInClassName;
	var styleWrapperId;
	var timeOut;

	function setMessageDisplayData(mdd){
		messageDisplayData = mdd;
		messageBoxId = messageDisplayData.message_box_name || messageDisplayData.url_param;
		styleWrapperId = "style_wrapper".concat(messageDisplayData.css_class_name);
		var css_style = getCssClass();
		fadeOutClassName = "fade-out-message-box-".concat(messageBoxId);
		fadeInClassName = "fade-in-message-box-".concat(messageBoxId);

		function getCssClass(){
			return ['.', messageDisplayData.css_class_name, ' {', messageDisplayData.css, "}"].join('');
		}

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
			var style = createStyleWithInnerHTML(css_style);
			appendStyleToWrapper(style);
		}

		function appendStyleToWrapper(style){
			var styleWrapper = document.getElementById(styleWrapperId);
			styleWrapper.appendChild(style);
		}


		function createStyleWithInnerHTML(innerHTML){
			var style = document.createElement('style');
			style.type = 'text/css';
			style.innerHTML = innerHTML;
			return style;
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

	function showMessage(messageToDisplay){
		var message_box_div;
		clearNow();
		destoryIfExistsById(messageBoxId);
		createMessageBoxDiv();
		message_box_div.className = messageDisplayData.css_class_name;
		setMarginTop();
		appendMessageDivToStartOfBody();
		if(messageDisplayData.fade_in){appendFadeInStyleToErrorBox();}
		if(messageDisplayData.fade_out){appendFadeOutStyleToErrorBox();}

		function clearNow(){
			clearTimeout(timeOut);
			destoryIfExistsById(messageBoxId);
		}

		function createMessageBoxDiv(){
			var div = document.createElement("div");
			div.id = messageBoxId;;
			div.innerHTML = messageToDisplay;
			message_box_div = div;
		}

		function setMarginTop(){
			message_box_div.style["margin-top"] = getDivMargin();
		}

		function getDivMargin(){
			var spacerAmount = screen.height*0.02;;
			return spacerAmount + "px";
		}

		function appendMessageDivToStartOfBody(){
			var documentBody = getFirstElementByTagOrCreateNew('body');
			documentBody.insertBefore(message_box_div, documentBody.childNodes[0]);
		}

		function appendFadeInStyleToErrorBox(){
			setTimeout(function () {
				message_box_div.className = messageDisplayData.css_class_name.concat(" ").concat(fadeInClassName);
			},0);
		}

		function appendFadeOutStyleToErrorBox(){
			setTimeout(function () {
				message_box_div.className = messageDisplayData.css_class_name.concat(" ".concat(fadeOutClassName));
			}, 1500);
		}
	}
	that.showMessage = showMessage;

	function destoryIfExistsById(elementId){
		var possibleElement =  document.getElementById(elementId);
		if(possibleElement){possibleElement.parentNode.removeChild(possibleElement);}
	}

	function getFirstElementByTagOrCreateNew(elementName){
		var element = document.getElementsByTagName(elementName)[0];
		if(!element){
			element = document.createElement(elementName);
			document.appendChild(element);
		}
		return element;
	}

	function clean(){
		timeOut = setTimeout(function () {
			destoryIfExistsById(messageBoxId);
			destoryIfExistsById(styleWrapperId);
		}, lifeSpanInMills);
	}
	that.clean = clean;


	return that;
}
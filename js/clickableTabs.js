//

function createClickableTabs(clickableTabsId){

	var tabsWithContent;

	setTabsWithContent();
	addOnClickToTabs();
	activateFirstTab();

	function setTabsWithContent(){
		var twc = [];
		var counter = 0;
		var currentTab = getTab(counter);
		var currentContent = getContent(counter);

		while(currentTab && currentContent){
			twc[counter] =  {}
			twc[counter].tab = currentTab;
			twc[counter].content = currentContent;

			counter++;
			currentTab = getTab(counter);
			currentContent = getContent(counter);
		}
		tabsWithContent = twc;
	}

	function getTab(number){
		var id = clickableTabsId.concat("_").concat("tab_").concat(number);
		return document.getElementById(id);
	}

	function getContent(number){
		var id = clickableTabsId.concat("_").concat("content_").concat(number);
		return document.getElementById(id);
	}

	function addOnClickToTabs(){
		for(var i=0; i<tabsWithContent.length; i++){
			var tabContent = tabsWithContent[i];
			if(tabContent.tab  && tabContent.content){
				tabContent.tab.onclick = function(){
					displayContent(this);
				}
			}
		}
	}

	function displayContent(tabToDisplay){
		for(var i=0; i<tabsWithContent.length; i++){
			var tabContent = tabsWithContent[i];
			if(tabContent.tab == tabToDisplay){
				tabsWithContent[i].tab.classList.add("active");
				tabsWithContent[i].content.style.display = "block";
			}else{
				tabsWithContent[i].tab.classList.remove("active");
				tabsWithContent[i].content.style.display = "none";

			}
		}
	}

	function activateFirstTab(){
		if(tabsWithContent.length > 0){
			displayContent(tabsWithContent[0].tab);
		}
	}
}
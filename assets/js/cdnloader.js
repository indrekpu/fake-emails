function addLocalScriptToHead(path){
	var script = document.createElement('script');
	script.type = 'text/javascript';
	script.src = path;
	var head = document.getElementByTagName('head')[0];
	head.appendChild(script);
}
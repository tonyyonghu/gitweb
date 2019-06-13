function tel() {
	var tel = false;
	
	if(window.XMLHttpRequest) {
		tel = new XMLHttpRequest();
	} else {
		tel = new window.ActiveXObject('Microsoft.XMLHTTP');
	}

	return tel;
}
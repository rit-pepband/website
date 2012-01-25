var CODE = [38, 38, 40, 40, 37, 39, 37, 39, 66, 65];
var pos = 0;

function kcode(e) {
	if (e.keyCode === CODE[pos]) {
		pos++;
	}
	else {
		pos = 0;
	}
	if (pos >= CODE.length) {
		var msg = document.createElement("h1");
    msg.innerHTML = "The Best Pep Band in the LAN";
    document.getElementsByTagName("footer")[0].insertBefore(msg,
        document.getElementsByTagName("footer")[0].firstChild); pos = 0; 
  }
}

window.onkeydown = kcode;

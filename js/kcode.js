var CODE = [38, 38, 40, 40, 37, 39, 37, 39, 66, 65];
var pos = 0;
var showing = false;
var msg = document.createElement("h1");
msg.innerHTML = "The Best Pep Band in the LAN";

function kcode(e) {
	if (e.keyCode === CODE[pos]) {
		pos++;
	}
	else {
		pos = 0;
	}
	if (pos >= CODE.length) {
    if (showing === false) {
      document.getElementsByTagName("footer")[0].insertBefore(msg,
          document.getElementsByTagName("footer")[0].firstChild); pos = 0;
      showing = true;
    }
    else {
      document.getElementsByTagName("footer")[0].removeChild(msg);
      showing = false;
    }
  }
}

window.onkeydown = kcode;

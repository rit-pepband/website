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
		document.location.href = "https://www.youtube.com/watch?v=v5sj1r3-UEc";
		pos = 0;
	}
}

window.onkeydown = kcode;
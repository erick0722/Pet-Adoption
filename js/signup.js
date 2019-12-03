var passwordMatching = false;

let pw1 = document.getElementById('pw1');
let pw2 = document.getElementById('pw2');
var btn = document.getElementById('btn');
var pwError = document.getElementById('pw-error');

function toggleButton() {
	if (passwordMatching)
        btn.disabled = false;
	else
        btn.disabled = true;
}

function check_pass() {
	if (pw1.value !== pw2.value || !pw1.value || !pw2.value) {
		pwError.style.display = 'block';
		passwordMatching = false;
    }
	else if (pw1.value === pw2.value) {
		pwError.style.display = 'none';
		passwordMatching = true;
    }
	toggleButton();
}
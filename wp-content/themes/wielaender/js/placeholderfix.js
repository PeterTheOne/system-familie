/* http://davidwalsh.name/html5-placeholder */

function hasPlaceholderSupport() {
	var input = document.createElement('input');
	return ('placeholder' in input);
};

function placeholderfix(name) {
	var firstNameBox = $(name);
	var message = firstNameBox.get('placeholder');

	firstNameBox.addEvents({
		focus: function() {
			if(firstNameBox.value == message) { searchBox.value = ''; }
		},
		blur: function() {
			if(firstNameBox.value == '') { searchBox.value = message; }
		}
	});
};

function placeholderfix() {

	if (!hasPlaceholderSupport()) {
		placeholderfix('Name');
		placeholderfix('Email');
	}
};

window.addEvent('domready', placeholderfix);
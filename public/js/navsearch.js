function validateZipInput() {
	console.log('validateZipInput');

	var regularExpression = '\\d{5}$';
	var message = 'US Zip codes must have exactly 5 digits: e.g. 41950 or 41590';
	var constraint = new RegExp(regularExpression, '');
	
	console.log(constraint);

	var zipCodeField = document.getElementById('searchZipInput');

	if (constraint.test(zipCodeField.value)) {
		zipCodeField.className = 'form-control';
		zipCodeField.setCustomValidity('');
	}
	else {
		zipCodeField.className = 'form-control border border-danger border-med';
		zipCodeField.setCustomValidity(message);
	}
}

function clearValidateZipInput() {
	console.log('clearValidateZipInput');
	
	var zipCodeField = document.getElementById('searchZipInput');
	zipCodeField.className = 'form-control';
	zipCodeField.setCustomValidity('');
}

function validateLocationInput() {
	console.log('validateLocationInput');

	var regularExpression = '\\d{5}$';
	var message = 'Please insert a valid address, city, state, or zip code';
	
	var locationSearchField = document.getElementById('searchLocationInput');

	if (locationSearchField.value !== null) {
		locationSearchField.className = 'form-control';
		locationSearchField.setCustomValidity('');
	}
	else {
		locationSearchField.className = 'form-control border border-danger border-med';
		locationSearchField.setCustomValidity(message);
	}
}

function clearValidateLocationInput() {
	console.log('clearValidateLocationInput');
	
	var locationSearchField = document.getElementById('searchLocationInput');
	locationSearchField.className = 'form-control';
	locationSearchField.setCustomValidity('');
}


window.onload = function() { 
	console.log('window.onload');

	var searchLocationInput = document.getElementById('searchLocationInput');
	var searchLocationSubmit = document.getElementById('searchLocationSubmit');
	
	if ( searchLocationInput !== null ) {
		searchLocationInput.onkeydown = clearValidateLocationInput;
	}
	if ( searchLocationSubmit !== null ) {
		searchLocationSubmit.onclick = validateLocationInput;
	}
};

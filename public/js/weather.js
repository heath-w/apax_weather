function getDirectionCompass(degrees) {
	console.log('getDirectionCompass');
	console.log('getDirectionCompass - degrees: ' . degrees);

	/*
											N  0
					NNW 337.5						NNE 22.5
			NW 315											NE 45
		WNW	292.5												ENE 67.5
	W 270																E 90
		WSW	247.5												ESE 112.5
			SW 225											SE 135
					NSW 202.5						SSE 157.5
											S 180				
	*/

	if ( degrees >= 337.5 && degrees <= 22.5 ) {
		return 'N';
	}
	else if ( degrees > 22.5 && degrees < 67.5 ) {
		return 'NE';
	}
	else if ( degrees >= 67.5 && degrees <= 112.5 ) {
		return 'E';
	}
	else if ( degrees > 112.5 && degrees < 157.5 ) {
		return 'SE';
	}
	else if ( degrees >= 157.5 && degrees <= 202.5 ) {
		return 'S';
	}
	else if ( degrees > 202.5 && degrees < 247.5 ) {
		return 'SW';
	}
	else if ( degrees >= 247.5 && degrees <= 292.5 ) {
		return 'W';
	}
	else if ( degrees > 292.5 && degrees < 337.5 ) {
		return 'NW';
	}
	else {
		return '';
	}
}
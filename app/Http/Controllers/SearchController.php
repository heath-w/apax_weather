<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{

	// Route search from navigation bar
  public function search(Request $request)
  {
  	error_log('SearchController.search');

  	try {
    
  		if (isset($request) === true) {
	  		$locationSearch = $request->input('searchLocationInput');
		  	// error_log('SearchController.search - locationSearch: ' . $locationSearch);

		  	if (isset($locationSearch) === true) {
		  		$location = $this->locationSearch($locationSearch);
		  		// error_log('SearchController.search - location: ' . $location);

		  		if (isset($location) === true) {
		  			$weather = $this->weatherSearch($location);	
		  			// error_log('SearchController.search - weather: ' . print_r($weather, true));

		  			if (isset($weather) === true) {
		  			
		  				return view(
		  					'userLocations.show', [
		  						'location' => $location, 
		  						'conditions' => $weather->query->results->channel->item->condition,
		  						'forecast' => $weather->query->results->channel->item->forecast,
		  						'wind' => $weather->query->results->channel->wind,
		  						'humidity' => $weather->query->results->channel->atmosphere->humidity,
		  						'weather' => true
		  					]);

		  			}
		  			else {
		  				return view('userLocations.show', ['locationSearch' => $locationSearch, 'location' => $location, 'weather' => null]);
		  			}
		  		}
		  		else {
		  			return view('userLocations.show', ['locationSearch' => $locationSearch, 'location' => null, 'weather' => null]);
		  		}
		  	}
		  	else {
		  		return view('userLocations.show', ['locationSearch' => null, 'location' => null, 'weather' => null]);
		  	}
	  	}
	  	else {
	  		return redirect('error');
	  	}  	

    } catch (Exception $exception) {
    	error_log('SearchController.search - exception: ' . print_r($exception, true));
    	return view('userLocations.show', ['locationSearch' => null, 'location' => null, 'weather' => null]);
    }  	
  }

  public function locationSearch($address) {
  	error_log('SearchController.locationSearch');
  	// error_log('SearchController.locationSearch - address: ' . $address);

  	try {

  		$baseGoogleURL = env('API_GOOGLE_BASE_URL', 'https://maps.googleapis.com/maps/api/geocode/json?key=%API%&address=%ADDRESS%');
			// error_log('SearchController.locationSearch - baseGoogleURL: ' . $baseGoogleURL);

			$baseGoogleAPI = env('API_GOOGLE_API_KEY', '12345');
			// error_log('SearchController.locationSearch - baseGoogleAPI: ' . $baseGoogleAPI);

			$encodedLocation = urlencode($address);

			$origPhrases = array('%API%', '%ADDRESS%');
			$newPhrases = array($baseGoogleAPI, $encodedLocation);
			$googleLocationURL = str_replace($origPhrases, $newPhrases, $baseGoogleURL);
			// error_log('SearchController.locationSearch - googleLocationURL: ' . $googleLocationURL);

			$json = $this->httpRequestGet($googleLocationURL);
		  // error_log('SearchController.locationSearch - GoogleURL Response JSON: ' . $json);

		  if (isset($json) === true) {
		  	$locationData = json_decode($json);
			  // error_log('SearchController.locationSearch - GoogleURL Response Object: ' . print_r($locationData, true));

			  if (isset($locationData->error_message) === false && isset($locationData->results) === true) {
			  	// error_log('SearchController.locationSearch - GoogleURL Response Object, results: ' . print_r($locationData->results, true));

			  	$location = $locationData->results[ 0 ]->formatted_address;
			  	// error_log('SearchController.locationSearch - GoogleURL Response Object, formatted address: ' . $location);

			  	return $location;
			  }
			  else {
			  	error_log('SearchController.locationSearch - GoogleURL Response Error: ' . $locationData->error_message);
			  	return null;
			  }
		  }
		  else {
		  	return null;
		  }

  	} catch (Exception $exception) {
    	error_log('SearchController.locationSearch - exception: ' . print_r($exception, true));
    	return null;
    }
  }

  public function weatherSearch($location) {
		error_log('SearchController.weatherSearch');  	
		// error_log('SearchController.weatherSearch - location: ' . $location);

		try {

			$baseYahooYQLQuery = env('API_YAHOO_BASE_GEOPLACES_YQL', 'select * from weather.forecast where woeid in (select woeid from geo.places(1) where text="%ADDRESS%")');
			// error_log('SearchController.weatherSearch - baseYahooYQLQuery: ' . $baseYahooYQLQuery);

			$yahooYQLQuery = str_replace('%ADDRESS%', $location, $baseYahooYQLQuery);
			// error_log('SearchController.weatherSearch - yahooYQLQuery: ' . $yahooYQLQuery);

			$encodedYahooYQLQuery = urlencode($yahooYQLQuery);
			// error_log('SearchController.weatherSearch - encodedYahooYQLQuery: ' . $encodedYahooYQLQuery);

			$baseYahooYQLURL = env('API_YAHOO_BASE_URL', 'http://query.yahooapis.com/v1/public/yql?format=json&q=%QUERY%');
			// error_log('SearchController.weatherSearch - baseYahooYQLURL: ' . $baseYahooYQLURL);

			$yahooYQLURL = str_replace('%QUERY%', $encodedYahooYQLQuery, $baseYahooYQLURL);
			// error_log('SearchController.weatherSearch - yahooYQLQuery: ' . $yahooYQLURL);

			return $this->runYQL($yahooYQLURL);

		} catch (Exception $exception) {
    	error_log('SearchController.weatherSearch - exception: ' . print_r($exception, true));
    	return null;
    }
  }

  public function weatherGet($woeid) {
		error_log('SearchController.weatherGet');  	
		error_log('SearchController.weatherGet - woeid: ' . $woeid);

		$baseYahooYQLQuery = env('API_YAHOO_BASE_WEATHERFORECAST_YQL', 'select * from weather.forecast where woeid=%WOEID%');
		// error_log('SearchController.weatherGet - baseYahooYQLQuery: ' . $baseYahooYQLQuery);

		$yahooYQLQuery = str_replace('%WOEID%', $woeid, $baseYahooYQLQuery);
		// error_log('SearchController.weatherGet - yahooYQLQuery: ' . $yahooYQLQuery);

		$encodedYahooYQLQuery = urlencode($yahooYQLQuery);
		// error_log('SearchController.weatherGet - encodedYahooYQLQuery: ' . $encodedYahooYQLQuery);

		$baseYahooYQLURL = env('API_YAHOO_BASE_URL', 'http://query.yahooapis.com/v1/public/yql?format=json&q=%QUERY%');
		// error_log('SearchController.weatherGet - baseYahooYQLURL: ' . $baseYahooYQLURL);

		$yahooYQLURL = str_replace('%QUERY%', $encodedYahooYQLQuery, $baseYahooYQLURL);
		// error_log('SearchController.weatherGet - yahooYQLQuery: ' . $yahooYQLURL);

		return $this->runYQL($yahooYQLURL);
  }

  public function runYQL($yahooYQLURL) {
  	error_log('SearchController.runYQL');
  	error_log('SearchController.runYQL - yahooYQLURL: ' . $yahooYQLURL);

  	$json = $this->httpRequestGet($yahooYQLURL);
		// error_log('SearchController.weatherGet - json: ' . $json);

		if (isset($json) === true) {
			$weatherData = json_decode($json);
			// error_log('SearchController.weatherGet - weatherData: ' . print_r($weatherData, true));

			if (isset($weatherData) === true) {
				$directionCompass = $this->getDirectionCompass( $weatherData->query->results->channel->wind->direction );
				$weatherData->query->results->channel->wind->directionCompass = $directionCompass;

				$itemLink = $weatherData->query->results->channel->item->link;
				$linkParts = explode("*", $itemLink);
				if (count($linkParts) === 2) {
					$weatherData->query->results->channel->item->link = $linkParts[1];
				}

				$conditionCode = $this->getConditionCodeDescription($weatherData->query->results->channel->item->condition->code);
				$weatherData->query->results->channel->item->condition->code = $conditionCode;

				$forecasts = $weatherData->query->results->channel->item->forecast;
				foreach ($forecasts as $forecast) {
					$forecast->code = $this->getConditionCodeDescription($forecast->code);
				}
				$weatherData->query->results->channel->item->forecast = $forecasts;


				return $weatherData;
			}
			else {
				return null;
			}
		}
		else {
			return null;
		}
  }

  public function httpRequestGet($url) {
  	// error_log('SearchController.httpRequestGet');
  	// error_log('SearchController.httpRequestGet - url: ' . $url);

  	$session = curl_init($url);
	  curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
	  $json = curl_exec($session);
	  // error_log('SearchController.httpRequestGet - URL Response JSON: ' . print_r($json, true));

	  return $json;
  }

  public function getDirectionCompass($degrees) {
  	// error_log('SearchController.getDirectionCompass');
  	// error_log('SearchController.getDirectionCompass - degrees: ' . $degrees);

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

  	if ( $degrees >= 337.5 && $degrees <= 22.5 ) {
  		return 'N';
  	}
  	elseif ( $degrees > 22.5 && $degrees < 67.5 ) {
  		return 'NE';
  	}
  	elseif ( $degrees >= 67.5 && $degrees <= 112.5 ) {
  		return 'E';
  	}
		elseif ( $degrees > 112.5 && $degrees < 157.5 ) {
  		return 'SE';
  	}
  	elseif ( $degrees >= 157.5 && $degrees <= 202.5 ) {
  		return 'S';
  	}
  	elseif ( $degrees > 202.5 && $degrees < 247.5 ) {
  		return 'SW';
  	}
  	elseif ( $degrees >= 247.5 && $degrees <= 292.5 ) {
  		return 'W';
  	}
  	elseif ( $degrees > 292.5 && $degrees < 337.5 ) {
  		return 'NW';
  	}
  	else {
  		return '';
  	}
  }

  public function getConditionCodeDescription($conditionCode) {
  	// error_log('SearchController.getConditionCodeDescription');
  	// error_log('SearchController.getConditionCodeDescription - conditionCode: ' . $conditionCode);

  	$conditionCode = '';

  	switch( $conditionCode) {
  		case 0: $conditionCode = 'tornado'; break;
			case 1: $conditionCode = 'tropical storm'; break;
			case 2: $conditionCode = 'hurricane'; break;
			case 3: $conditionCode = 'severe thunderstorms'; break;
			case 4: $conditionCode = 'thunderstorms'; break;
			case 5: $conditionCode = 'mixed rain and snow'; break;
			case 6: $conditionCode = 'mixed rain and sleet'; break;
			case 7: $conditionCode = 'mixed snow and sleet'; break;
			case 8: $conditionCode = 'freezing drizzle'; break;
			case 9: $conditionCode = 'drizzle'; break;
			case 10: $conditionCode = 'freezing rain'; break;
			case 11: $conditionCode = 'showers'; break;
			case 12: $conditionCode = 'showers'; break;
			case 13: $conditionCode = 'snow flurries'; break;
			case 14: $conditionCode = 'light snow showers'; break;
			case 15: $conditionCode = 'blowing snow'; break;
			case 16: $conditionCode = 'snow'; break;
			case 17: $conditionCode = 'hail'; break;
			case 18: $conditionCode = 'sleet'; break;
			case 19: $conditionCode = 'dust'; break;
			case 20: $conditionCode = 'foggy'; break;
			case 21: $conditionCode = 'haze'; break;
			case 22: $conditionCode = 'smoky'; break;
			case 23: $conditionCode = 'blustery'; break;
			case 24: $conditionCode = 'windy'; break;
			case 25: $conditionCode = 'cold'; break;
			case 26: $conditionCode = 'cloudy'; break;
			case 27: $conditionCode = 'mostly cloudy (night)'; break;
			case 28: $conditionCode = 'mostly cloudy (day)'; break;
			case 29: $conditionCode = 'partly cloudy (night)'; break;
			case 30: $conditionCode = 'partly cloudy (day)'; break;
			case 31: $conditionCode = 'clear (night)'; break;
			case 32: $conditionCode = 'sunny'; break;
			case 33: $conditionCode = 'fair (night)'; break;
			case 34: $conditionCode = 'fair (day)'; break;
			case 35: $conditionCode = 'mixed rain and hail'; break;
			case 36: $conditionCode = 'hot'; break;
			case 37: $conditionCode = 'isolated thunderstorms'; break;
			case 38: $conditionCode = 'scattered thunderstorms'; break;
			case 39: $conditionCode = 'scattered thunderstorms'; break;
			case 40: $conditionCode = 'scattered showers'; break;
			case 41: $conditionCode = 'heavy snow'; break;
			case 42: $conditionCode = 'scattered snow showers'; break;
			case 43: $conditionCode = 'heavy snow'; break;
			case 44: $conditionCode = 'partly cloudy'; break;
			case 45: $conditionCode = 'thundershowers'; break;
			case 46: $conditionCode = 'snow showers'; break;
			case 47: $conditionCode = 'isolated thundershowers'; break;
			default: $conditionCode = 'not available';
  	}

  	return $conditionCode;
  }
}

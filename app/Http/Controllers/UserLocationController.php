<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserLocationController extends Controller
{
	public function __construct()
	{
	  $this->middleware('auth');
	}

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
  	error_log('UserLocationController.index');

  	$user = \Auth::user();
  	$userLocations = $user->userLocations();
  	$userLocationCount = count($userLocations);
  	$weatherData = array();
  	$index = 0;
  	$searchController = app('App\Http\Controllers\SearchController');

  	foreach ($userLocations as $userLocation) {
  		error_log('UserLocationController.index - userLocation->location(' . $userLocation->id . '): ' . $userLocation->location);
  		
  		$location = $searchController->locationSearch($userLocation->location);
  		$weather = $searchController->weatherSearch($location);

  		$data = new \stdClass();
  		$data->id = $userLocation->id;
  		$data->location = $userLocation->location;
  		$data->conditions = $weather->query->results->channel->item->condition;
  		$data->forecast = $weather->query->results->channel->item->forecast;
  		$data->wind = $weather->query->results->channel->wind;
  		$data->humidity = $weather->query->results->channel->atmosphere->humidity;

  		$weatherData[$index++] = $data;
  	}

  	return view('userLocations.index', ['userLocations' => $userLocations, 'weatherData' => $weatherData]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
  	error_log('UserLocationController.store');    	
  	error_log('UserLocationController.store - location: ' . print_r($request->location, true));
  	
  	$searchUserLocation = \App\UserLocation::where('location', $request->location)->first();

  	if ( isset($searchUserLocation) === true ) {
  		error_log('UserLocationController.store - searchUserLocation exists, do not save');
  	}
  	else {
  		error_log('UserLocationController.store - searchUserLocation does not exist, proceed with save');

	  	$userLocation = new \App\UserLocation;
	  	$userLocation->user_id = \Auth::id();
	  	$userLocation->location = $request->location;
	  	$userLocation->save();
  	}

  	return redirect('home');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
  	error_log('UserLocationController.show');    	
  	error_log('UserLocationController.show - id: ' . $id);

  	$userLocation = \App\UserLocation::find($id);
  	// error_log('UserLocationController.show - userLocation: ' . print_r($userLocation, true));

  	return view('userLocations.show', ['userLocation' => $userLocation]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
  	error_log('UserLocationController.update');    	
  	error_log('UserLocationController.update - id: ' . $id);
  	var_dump($request);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
  	error_log('UserLocationController.destroy');    	
  	error_log('UserLocationController.destroy - id: ' . $id);

  	$searchUserLocation = \App\UserLocation::where('id', $id)->first();

  	if ( isset($searchUserLocation) === true ) {
  		error_log('UserLocationController.destroy - searchUserLocation exists, safe to delete');

  		$userLocation = \App\UserLocation::find($id);
  		$userLocation->delete();
  	}
  	else {
  		error_log('UserLocationController.destroy - searchUserLocation does not exist, do not delete');
  	}

		return redirect('home');
  }
}

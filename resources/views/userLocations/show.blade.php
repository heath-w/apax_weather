@extends('layouts.app')

@section('content')

<div class="container">

	@if (isset($location) === false)
	  <p class="lead">
	  	There was no location found with your search. Please try again.
	  </p>
	@elseif (isset($weather) === false)
	  <p class="lead">
	  	There was no weather found for your location search. Please try again.
	  </p>
	@else

		<div class="row">
		  <div class="col-sm-6">

		  	@include(
		  		'userLocations.weather', 
		  		[
		  			'toSave' => true,
		  			'toDelete' => false,
		  			'id' => 1,
		  			'location' => $location,
		  			'conditions' => $conditions,
		  			'forecast' => $forecast,
		  			'wind' => $wind,
		  			'humidity' => $humidity
		  		]
		  	)
			  
			</div>
		</div>
	  
	@endif

</div>

@endsection



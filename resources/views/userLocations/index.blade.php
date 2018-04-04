@extends('layouts.app')

@section('content')

<div class="container">

	@if (count($userLocations) > 0)

		<div class="row">

			@foreach ($weatherData as $data)
	  		
	  		
			  <div class="col-sm-6 mb-4">

			  	@include(
			  		'userLocations.weather', 
			  		[
			  			'toSave' => false,
			  			'toDelete' => true,
			  			'id' => $data->id,
			  			'location' => $data->location,
			  			'conditions' => $data->conditions,
			  			'forecast' => $data->forecast,
			  			'wind' => $data->wind,
			  			'humidity' => $data->humidity
			  		]
			  	)
				  
				</div>
				

			@endforeach

		</div>
    
	@else
		<p class="lead">
    	Please search above for a location to add personalized weather forcasts.
    </p>
	@endif

</div>

@endsection
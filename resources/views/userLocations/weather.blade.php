<div class="card normal-text">
  <div class="card-header card-title lead">
  	
  	@if ($toSave === true)

  		<form id="saveLocationForm" class="form-inline" action="/userLocations" method="post">
	  		<span class="weather-card-location mb-1"><strong>{{ $location }}</strong></span>
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				<input type="hidden" name="location" value="{{ $location }}" />	      			
			  <div class="input-group-prepend">
			  	<input type="submit" id="saveLocationFormSubmit" class="btn btn-secondary" value="Save Location" />
			  </div>
			  <div class="collapse-button">
			  	<button class="btn btn-sm btn-secondary ml-1 weather-collapse-button" type="button" data-toggle="collapse" data-target="#{{ $id }}" aria-expanded="true" aria-controls="{{ $id }}">
			    	<img class="weather-collapse-image" src="{{ asset('images/hamburger7.svg') }}">    	
			  	</button>
			  </div>
			</form>

  	@elseif ($toDelete === true)

  		<form id="deleteLocationForm" class="form-inline" action="/userLocations/{{ $id }}" method="post">
	  		<span  class="weather-card-location mb-1"><strong>{{ $location }}</strong></span>
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				<input type="hidden" name="_method" value="delete" />
			  <div class="input-group-prepend">
			  	<input type="submit" id="deleteLocationFormSubmit" class="btn btn-secondary" value="Delete Location" />
			  </div>
			  <div class="collapse-button">
			  	<button class="btn btn-sm btn-secondary ml-1 weather-collapse-button" type="button" data-toggle="collapse" data-target="#{{ $id }}" aria-expanded="true" aria-controls="{{ $id }}">
			    	<img class="weather-collapse-image" src="{{ asset('images/hamburger7.svg') }}">
			  	</button>
			  </div>
			</form>

  	@else

	  	<span class="weather-card-location mb-1"><strong>{{ $location }}</strong></span>

	  	<div class="collapse-button">
		  	<button class="btn btn-sm btn-secondary ml-1 weather-collapse-button" type="button" data-toggle="collapse" data-target="#{{ $id }}" aria-expanded="true" aria-controls="{{ $id }}">
		    	<img class="weather-collapse-image" src="{{ asset('images/hamburger7.svg') }}">
		  	</button>
		  </div>

  	@endif

  </div>

  <div id="{{ $id }}" class="card-body collapse show">

	  <div class="row">
	  	<div class="col-12 pl-3 p-2">
	  		<h3 class="weather-date-display display-7">{{ $conditions->date }}</h3>
	  	</div>
	  </div>	
	
	  <div class="row">	
			<div class="col-6 pl-3 p-2">
				<h1 class="weather-temp-display display-2">{{ $conditions->temp }}&deg;F</h1>
			</div>
			<div class="col-6 p-1">
				{{ $forecast[0]->text }}<br />
				&uarr; {{ $forecast[0]->high }}&deg;F&nbsp;
				&darr; {{ $forecast[0]->low }}&deg;F<br />
				Humidity {{ $humidity }}%<br />
				Feels like {{ $wind->chill }}&deg;F<br />
				Wind {{ $wind->speed }}mph {{ $wind->directionCompass }}
			</div>
		</div>

		<div class="row">
			<div class="col-11 pl-3 p-1">
				<table class="table table-sm table-bordered">
					<tbody>
						@for ($i = 1; $i < 7; $i++)
					    <tr>
					      <th scope="row">{{ $forecast[$i]->day }}</th>
					      <td>{{ $forecast[$i]->text }}</td>
					      <td>&uarr; {{ $forecast[$i]->high }}&deg;F</td>
					      <td>&darr; {{ $forecast[$i]->low }}&deg;F</td>
					    </tr>
					  @endfor 
				  </tbody>
				</table>
			</div>
		</div>

	</div>				  
</div>
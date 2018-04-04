<div class="card normal-text">
  <div class="card-header card-title lead">
  	
  	@if ($toSave === true)

  		<form id="saveLocationForm" class="form-inline" action="/userLocations" method="post">
	  		<strong class="mr-3">{{ $location }}</strong>
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				<input type="hidden" name="location" value="{{ $location }}" />	      			
			  <div class="input-group-prepend">
			  	<input type="submit" id="saveLocationFormSubmit" class="btn btn-secondary" value="Save Location" />
			  </div>
			</form>

  	@elseif ($toDelete === true)

  		<form id="deleteLocationForm" class="form-inline" action="/userLocations/{{ $id }}" method="post">
	  		<strong class="mr-3">{{ $location }}</strong>
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				<input type="hidden" name="_method" value="delete" />
			  <div class="input-group-prepend">
			  	<input type="submit" id="deleteLocationFormSubmit" class="btn btn-secondary" value="Delete Location" />
			  </div>
			</form>

  	@else

	  	<strong>{{ $location }}</strong>

  	@endif

  </div>
  <div class="card-body">

	  <div class="row">
	  	<div class="col-12 pl-3 p-2">
	  		<h3 class="display-7">{{ $conditions->date }}</h3>
	  	</div>
	  </div>	
	
	  <div class="row">	
			<div class="col-5 pl-3 p-2">
				<h1 class="display-2">{{ $conditions->temp }}&deg;F</h1>
			</div>
			<div class="col-7 p-1">
				{{ $forecast[0]->text }}<br />
				&uarr; {{ $forecast[0]->high }}&deg;F&nbsp;
				&darr; {{ $forecast[0]->low }}&deg;F<br />
				Humidity {{ $humidity }}%<br />
				Feels like {{ $wind->chill }}&deg;F<br />
				Wind {{ $wind->speed }}mph {{ $wind->directionCompass }}
			</div>
		</div>

		<div class="row">
			<div class="col-8 pl-3 p-1">
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
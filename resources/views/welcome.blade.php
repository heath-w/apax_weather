@extends('layouts.app')

@section('content')

<div id="welcomeArea" class="container">

	<div class="content">
    <div class="title">
      <p>{{ config('app.name', 'Apax Weather') }}</p>
    </div>

    <div class="subtitle">
      <p>
      	THE most trusted name in weather!
      </p>
    </div>
    <br />
    <div class="instructions mr-4 ml-4">
    	<p>To use the app, simply register a user, search for locations, save locations! Clicking on {{ config('app.name', 'Weather') }} above will show saved locations.</p>
    </div>

  </div>

</div>

@endsection
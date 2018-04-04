@extends('layouts.app')

@section('content')

<div id="welcomeArea" class="container">

	<div class="content">
    <div class="title m-b-md">
      <p>{{ config('app.name', 'Apax Weather') }}</p>
    </div>

    <div class="subtitle">
      <p>
      	THE most trusted name in weather!
      </p>
    </div>

  </div>

</div>

@endsection
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Welcome to {{ config('app.name', 'Laravel') }}</title>

  <!-- Styles -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
	<div id="app">		
		<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
		  <div class="container nav-container d-flex justify-content-start">

		  	@if (Auth::guest() !== true)
		      <a class="navbar-brand mr-1" href="{{ url('/home') }}">
		      	{{ config('app.name', 'Weather') }}
		      </a>
	      @else
	      	<a class="navbar-brand mr-1" href="{{ url('/') }}">
		      	{{ config('app.name', 'Weather') }}
		      </a>
	      @endif

	      @if (Auth::guest() !== true)
		      <form id="searchLocationInputForm" class="form-inline ml-5" action="/search" method="post">
      			<input type="hidden" name="_token" value="{{ csrf_token() }}">
					  <input type="text" 
					  			 id="searchLocationInput" 
					  			 name="searchLocationInput" 
					  			 class="form-control field"
					  			 placeholder="Address, city, state, or zip code"
					  			 required
					  >
					  <div class="input-group-prepend">
					  	<input type="submit" id="searchLocationSubmit" class="btn btn-secondary" value="Search" />
					  </div>
					</form>
				@endif

	      <button class="navbar-toggler" 
	      				type="button" 
	      				data-toggle="collapse" 
	      				data-target="#navbarSupportedContent" 
	      				aria-controls="navbarSupportedContent" 
	      				aria-expanded="false" 
	      				aria-label="Toggle navigation"
	      >
	      	<span class="navbar-toggler-icon"></span>
	      </button>

	      <div class="collapse navbar-collapse justify-content-end ml-auto" id="navbarSupportedContent">
	        <ul class="navbar-nav">
	          @if (Auth::guest())
	            <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
	            <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
	          @else
	            <li class="nav-item dropdown">
	              <a href="#" 
	              	 class="nav-link dropdown-toggle" 
	              	 id="navbarDropdownMenuLink" 
	              	 data-toggle="dropdown" 
	              	 aria-haspopup="true" 
	              	 aria-expanded="false"
	              >
	                {{ Auth::user()->name }}
	              </a>
	              <div class="dropdown-menu dropdown-menu-right field" aria-labelledby="navbarDropdownMenuLink">
	                <a href="{{ route('logout') }}" 
	                	 class="dropdown-item reverse" 
	                	 onclick="event.preventDefault();document.getElementById('logout-form').submit();"
	                >
	                  Logout
	                </a>

	                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										{{ csrf_field() }}
	                </form>
	              </div>
	            </li>
	          @endif
	        </ul>
	      </div>
		  </div>
		</nav>

	  @yield('content')
	</div>

	<nav id="navFooter"class="navbar fixed-bottom navbar-dark bg-dark justify-content-between">
		<div class="container footer-container">
			<span class="navbar-text d-flex align-items-center align-middle footer-navbar-text">
				<span>Created by Heath Williams using PHP, Laravel, Bootstrap, and PostgreSQL.</span>
				
				&nbsp;&nbsp;&nbsp;&nbsp;
				
				<img class="navbar-brand img-fluid google-img" src="{{ asset('images/powered_by_google_on_non_white.png') }}">
				
				<a class="navbar-brand" href="https://www.yahoo.com/?ilc=401" target="_blank">
					<img class="img-fluid yahoo-img" src="https://poweredby.yahoo.com/white.png"/>
				</a>		
			</span>		
			<span  class="navbar-text d-flex align-items-center align-middle footer-navbar-text">
				<a id="top" class="navbar-brand align-middle" href="#"><span class="align-middle">Top</span></a>		
			</span>	
		</div>		
	</nav>

	<!-- Scripts -->
	<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/navsearch.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/weather.js') }}"></script>
	
</body>

</html>

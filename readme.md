# Apax Weather
Apax Weather was done by me as a coding challenge for Apax Software. The site allows a user to register and login accounts. They can search for locations using a wide range of inputs and covering most of the Earth. The user may save a location to always be viewed when navigating to the front page and they can delete saved locations they no longer wish to see.

# Technologies
## PHP 7.2 / Laravel 5.5
I selected [PHP](http://www.php.net/) and [Laravel](https://laravel.com/docs/5.5) for a few reasons.
* It was my most recent technologoes used for a full-stack web application.
* It is one of four technologies specifically listed as used by APAX Software.
* It was taught in the Web Developer Bootcamps done by Awesome Inc U.

## Bootstrap 4
I selected [Bootstrap 4](https://getbootstrap.com/docs/4.0/getting-started/introduction/) for three reasons.
* I like the way it handles layouts.
* It is well documented.
* It has a solution for most everything I need to do.

## PostgreSQL
I selected [PostgreSQL](https://www.postgresql.org/) for three reasons.
* I have experience in it.
* It works well with my other technologies.
* It is supported and free on Heroku.

# APIs
## Google Maps Geocoding API
I selected [Google Maps Geocoding API](https://developers.google.com/maps/documentation/geocoding/intro) because I wanted a robust way for people to input their location into the application. The API provided a very easy way to get a standard location from almost anything that a person could type in and covering most of the world. This API also has a high usage limit on their API requests.

## Yahoo Weather API
I selected the [Yahoo Weather API](https://developer.yahoo.com/weather/) because it has a really interesting query language associated with it (YQL) and has a high usage limit on their API requests.

# Hosting/Repo
The code is stored on GitHub [GitHub](https://github.com/heath-w/apax_weather) and hosted on [Heroku](https://apax-weather.herokuapp.com/).

# Closing
This was a fun project. I started this on 03/31/2018 and finished on 04/05/2018. I worked on it a couple of hours a night almost every night. If I had more time I would do a few more things to it like better error-handling, moving the weather cards and some of their functionality to a JS framework (maybe Vue), try to optomize the number of API calls made, add a "settings" screen that allowed for mass removal of locations, and do a better job of customizing the responsiveness of the layout.







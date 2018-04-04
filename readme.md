
# Bootstrap 4
composer require laravelnews/laravel-twbs4
php artisan preset bootstrap4-auth
npm install
npm run dev

# Database (PostgreSQL)
CREATE USER apaxweatheruser WITH PASSWORD 'AwWASD1978antfirestar';
CREATE DATABASE apaxweather OWNER apaxweatheruser;

postgres://apaxweatheruser:AwWASD1978antfirestar@127.0.0.1:5432/apaxweather

# Authentication
php artisan make:auth
php artisan migrate

# Run server
php artisan serve





php artisan migrate


# OpenWeatherMap API example
http://api.openweathermap.org/data/2.5/weather?APPID=95fcd1f957be83fbd4972e941c94f9c9&zip=<zipcode_value>

Dev API Key a7e7ed57db1c910144ee9a32a5fd4221
http://api.openweathermap.org/data/2.5/weather?APPID=a7e7ed57db1c910144ee9a32a5fd4221&zip=40502
http://api.openweathermap.org/data/2.5/weather?APPID=a7e7ed57db1c910144ee9a32a5fd4221&zip=E1


{
  "coord": {
    "lon": -84.49,
    "lat": 38.02
  },
  "weather": [
    {
      "id": 800,
      "main": "Clear",
      "description": "clear sky",
      "icon": "01d"
    }
  ],
  "base": "stations",
  "main": {
    "temp": 289.2,
    "pressure": 1019,
    "humidity": 38,
    "temp_min": 288.15,
    "temp_max": 290.15
  },
  "visibility": 16093,
  "wind": {
    "speed": 4.6,
    "deg": 230
  },
  "clouds": {
    "all": 1
  },
  "dt": 1522539300,
  "sys": {
    "type": 1,
    "id": 1129,
    "message": 0.0043,
    "country": "US",
    "sunrise": 1522495385,
    "sunset": 1522540862
  },
  "id": 420013316,
  "name": "Lexington",
  "cod": 200
}



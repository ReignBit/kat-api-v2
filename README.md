# API v2
Complete rewrite of the v1 api, built in PHP and RESTful principles.
Uses routing and controllers to help modularize the code.

## Current flow
index.php -> controllers/* -> models/*

 - apache redirects any request to `index.php?q=<URL>`
 - initial request to index.php
 - Reference the `$routes` table in `routes.php` to look for a valid base route into the api.
 ```php
 $routes = array(
    "guilds" => "GuildController"
 );
 ```
 - Hand off handling to the specified controller, with the `handleRequest` entrypoint.
 - Controller then loops through a list of regex endpoints to find the requested url.
 ```php
"/guilds$/" => "handleDefaultRequest"
 ```
 - If it is found, the controller hands off control to the specified callback function - and splits and url params into arguments passed into the callback.
```php
    static function handleDefaultRequest()
    {
        return Guild::all();
    }
```
 - Callback funtion returns a json_encode-able object ready to be sent as response

 ## TODO
 - Implement Auth
 - FetchOr404 / Error handling in general
 - Permission endpoints
 - Allow creation/deletion/modification of data (currently only GET)
# API v2
Complete rewrite of the v1 api, built in PHP and RESTful principles.
Uses routing and controllers to help modularize the code.

## TODO
 - Implement Auth
 - FetchOr404 / Error handling in general
 - Permission endpoints
 - Allow creation/deletion/modification of data (currently only GET)
 - Views / Multiple methods [x]

---

## Guide
> A brief explaination of how a request is processed:
> - First the "root endpoint" is compared against the routing table in `routes.php`
> - If a valid route is found, the `Controller` responsible is called and looks for a valid endpoint.
> - If a valid endpoint is found in the Controller, a Context object is created and any Middleware specified in the Controller is executed in reverse order.
> - If all middleware pass then execution is passed to the endpoint's View class. (specified in the Controller).
>- The view executes and returns a JSON object for response back to the client.

### How to add a new endpoint?
For this example, we will add `/example` to the API.

1) Since this is a root endpoint, we will need a new Controller.
    - Create a new controller `controllers/example.php`
    - Add the following code: 
```php
<?php
// These should always be present
include_once("views/view.php");
include_once("controllers/base.php");

// Any views the controller uses should go here.
include_once("views/example.php");

class ExampleController extends BaseController
{
    // Mapping of url => view (url is regex pattern)
    public static $endpoints = array(
            "/example$/" => "ExampleView"
        );

    public static $middleware = array(
        // Any middlewares that should be processed on views
        // in this controller should be added here.
    );
}
?>
```
This acts as a configuration for all endpoints contained within the ExampleController,
and any middlewares placed in `$middleware` will be run FIFO style.

We will touch on middlewares later. For now, note that the endpoint mapping is the regex pattern to match our `/example` endpoint exactly.

Now we have created our Controller, we can create our view. A view is where most of the endpoint logic will go. In this example, we will make our `/example` endpoint return the current timestamp, and when the request was made in a nice JSON format.

Create our view in `views/example.php`:
```php
<?php
// This should always be present.
include_once("views/view.php");

class ExampleView extends View
{
    // function called if the HTTP method == get
    static function get($ctx)
    {
        return array("current" => date_timestamp_get(date_create()), "request_made" => $ctx->requestStartedAt);
    }
}
?>
```

Finally, we can add our new ExampleController to the routes table in `routes.php`:
```php
<?php
include_once("controllers/example.php");

$routes = array(
    "example" => "ExampleController"
);
?>
```

Now, if we visit our new endpoint we will receive something like this:
```json
{
    "current": 1649891358,
    "request_made": 1649891358
}
```
Congratulations! you just added a new endpoint to the api.
To add middleware, simply add the name of the middleware class to `$middleware` in the Controller. For example, we can add `"HeaderAuthMiddleware"` to only accept the request if there is an Authorization header present in the request.

---

### How to create new middleware?
Simple add a new middleware in `middleware/`, this example will ensure the header `"Authorization: Hello"` is present.

```php
<?php
// These must be present
include_once("middleware/base.php");
include_once("utils/errors.php");

// Must extend from BaseMiddleware
class HeaderAuthMiddleware extends BaseMiddleware
{
    // Entrypoint to the middleware
    static function handle($ctx)
    {
        // Custom logic 
        if (array_key_exists('Authorization', getallheaders()))
        {
            if (getallheaders()['Authorization'] == "Hello")
            {
                // To continue with the request, this must be called and returned.
                return static::next($ctx);
            }
        }
        // To abort the request, return custom data/errors or
        // use the generic error_ functions found in `utils/errors.php`.
        // If using custom errors, ensure http_response_code(x) is called before returning.
        return error_401();
    }
}
?>
```

if all checks in the middleware pass, it should return `static::next($ctx)` which calls the rest of the middleware in the stack, before going on to process the View.
If checks fail, or the middleware wants to abort the request, it can return one of the generic `error_` functions, or custom data to return.

```php
return array("msg" => "aborting at middleware ExampleMiddleware");
```
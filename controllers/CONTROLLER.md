# Controller
Responsible for providing routes to endpoints.

Example:
```php
include_once("views/view.php");
include_once("controllers/controller.php");
include_once("middleware/middleware.php");

include_once("views/example.php");

class ExampleController extends Controller
{
    // Mapping of url => view (url is regex pattern)
    public static $endpoints = array(
            "/example$/" => "ExampleView"
        );

    public static $middleware = array(
        // Any middlewares that should be processed on views
        // in this controller should be added here.
        "Middleware"
    );
}
```
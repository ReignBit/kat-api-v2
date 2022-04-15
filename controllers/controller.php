<?php
include_once("utils/context.php");
include_once("middleware/middleware.php");

include_once("utils/errors.php");

class Controller
{
    /*
        endpoints:
            A map of url endpoints => View
    */
    public static $endpoints = array();

    /*
        middleware:
            An array of Middlewares to be ran in order,
            an example of a middleware would be an AuthMiddleware that
            prevents unauthed access to ALL views in a controller.
    */
    public static $middleware = array(
    );


    static function handleRequest($method, $args, $controller)
    {
        foreach (static::$endpoints as $pattern => $callback) {
            if (preg_match($pattern, $args))
            {
                // Compile any url parameters into their own separate variables...
                $exploded_pattern = array_values(array_filter(explode("/", $pattern)));
                $exploded = array_values(array_filter(explode("/", $args)));

                array_values($exploded_pattern);
                array_values($exploded);

                $url_params = [];
                for ($i=0; $i < count($exploded_pattern); $i++) { 
                    if (substr( $exploded_pattern[$i], 0, 1) == "\\")
                    {
                        $url_params[] = $exploded[$i];
                    }
                }
                
                // We have a valid url path, let's hand it off to the controller/middleware stack responsible
                // $controller: ->BaseController
                // $callback  : -> View
                // $method    : HTTP Method
                // $url_params: regex'd variables from url
                $ctx = new Context($controller, $callback, $method, $url_params, static::$middleware); 
                
                $ctx->middleware[] = "Middleware";
                return call_user_func(array($ctx->middleware[0], "handleMiddlewareRequest"), $ctx); 
            }
        }

        return error_404();
    }
}

?>
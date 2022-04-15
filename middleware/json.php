<?php
include_once("middleware/middleware.php");
include_once("utils/errors.php");

class JsonMiddleware extends Middleware
{
    /*
        JsonPostMiddleware

        If request is POST, we read the body and convert to json if possible.

        Returns 400 if malformed json
    */
    static function handle($ctx)
    {
        if ($ctx->method != "GET")
        {
            try
            {
                $ctx->data = json_decode(file_get_contents("php://input"), true, 512, JSON_THROW_ON_ERROR);
                return static::next($ctx);
            }
            catch (\JsonException $e)
            {
                return error_400();
            }
        }
        // Method is GET, so we dont need to worry.
        return static::next($ctx);
    }
}

?>
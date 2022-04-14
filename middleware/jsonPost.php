<?php
include_once("middleware/base.php");
include_once("utils/errors.php");

class JsonPostMiddleware extends BaseMiddleware
{
    /*
        JsonPostMiddleware

        If request is POST, we read the body and convert to json if possible.

        Returns 400 if malformed json
    */
    static function handle($ctx)
    {
        if ($ctx->method == "POST")
        {
            try
            {
                $ctx->post = json_decode(file_get_contents("php://input"), true, 512, JSON_THROW_ON_ERROR);
                return static::next($ctx);
            }
            catch (\JsonException $e)
            {
                echo $e;
                return error_400();
            }
        }
        // Method is not POST, so we dont need to worry.
        return static::next($ctx);
    }
}

?>
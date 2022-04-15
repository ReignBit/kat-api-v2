<?php
include_once("middleware/middleware.php");
include_once("utils/errors.php");

class BasicAuthMiddleware extends Middleware
{
    static function handle($ctx)
    {
        if (isset($_SERVER['PHP_AUTH_USER']))
        {
            if (array_key_exists($_SERVER['PHP_AUTH_USER'], AUTH_USER))
            {
                if ($_SERVER['PHP_AUTH_PW'] == AUTH_USER[$_SERVER['PHP_AUTH_USER']])
                {
                    return static::next($ctx);
                }
            }
        }
        return error_401();
    }
}

?>
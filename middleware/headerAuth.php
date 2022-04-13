<?php
include_once("middleware/base.php");
include_once("utils/errors.php");

class HeaderAuthMiddleware extends BaseMiddleware
{
    static function handle($ctx)
    {

        if (array_key_exists('Authorization', getallheaders()))
        {
            if (getallheaders()['Authorization'] == "hello")
            {
                return static::next($ctx);
            }
        }
        return error_401();
    }
}

?>
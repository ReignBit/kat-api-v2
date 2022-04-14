<?php
include_once("utils/context.php");

class BaseMiddleware
{
    static function handleMiddlewareRequest($ctx)
    {
        $start = date_timestamp_get(date_create());
        $result = static::handle($ctx);
        if ($result)
        {
            return $result;
        }
    }

    static function handle($ctx)
    {
        // This is the entry point for middlewares, children should override this and add
        // their own functionality here.

        // return static::next($ctx) when middleware checks have passed,
        // return an error/response when middleware has failed checks.
        return static::next($ctx);
    }

    static function next($ctx)
    {
        return static::next_internal($ctx, date_timestamp_get(date_create()));
    }

    static function next_internal($ctx, $finishTime)
    {
        // Move the middleware we just processed out of the queue and into processed array.
        array_push($ctx->processedMiddleware, array("name" => array_shift($ctx->middleware), "finishTimestamp" => $finishTime));
        if (count($ctx->middleware) == 0)
        {
            // No more middleware to run through, execute View
            return call_user_func(array($ctx->view, "handle"), $ctx);
        }
        else
        {
            return call_user_func(array($ctx->middleware[0], "handleMiddlewareRequest"), $ctx);
        }
    }
}
?>
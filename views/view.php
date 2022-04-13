<?php
/*
            VIEW.PHP
    Base view for all interactions with the API.
    has methods for each request type available to the endpoint (GET,POST,DELETE,PUT,etc.)
    Also has methods for error types.

    Each "endpoint" will have its own view, responsible for handling the request.

    Examples:
        GuildView       For getting/editing a specific server
        GuildsView      For getting all servers and creating new ones
        MembersView     For getting all members of a server
        MemberView      For getting/editing a specific member of a server.
*/

// Example class design:

/*
class GuildsView            // (/guilds)
{
    static function get()
    {
        return Guild::all();
    }

    static function post()
    {
        return Guild::insert($_POST['data']);
    }

    static function error_404($exception)
    {
        return array("msg" => "404 - Guild not found.");
    }

    staic function error_500($exception)
    {
        return array("msg" => "500 - Internal Server Error");
    }
}
*/

class View
{
    static function getFunc($ctx)
    {
        if (method_exists($ctx->view, strtolower($ctx->method)))
        {
            return call_user_func(array($ctx->view, strtolower($ctx->method)), $ctx, ...$ctx->params);
        }
        return error_405($ctx->method);
    }

    static function handle($ctx)
    {
        return static::getFunc($ctx);
    }

    // Generics

}

?>

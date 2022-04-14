<?php
include_once("views/view.php");

include_once("models/guild.php");

class GuildsView extends View
{
    static function get($ctx)
    {
        return Guild::all();
    }

    static function post($ctx)
    {
        if (array_key_exists("id", $ctx->post) && array_key_exists("prefix", $ctx->post))
        {
            if (Guild::create( $ctx->post['id'], $ctx->post['prefix']))
            {
                http_response_code(201);
                return Guild::get($ctx->post['id']);
            }

            http_response_code(422);
            return Guild::get($ctx->post['id']);

        }
        return error_400();
    }
}
?>
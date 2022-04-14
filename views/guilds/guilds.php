<?php
include_once("views/view.php");

include_once("models/guild.php");

class GuildsView extends View
{
    static function get($ctx)
    {
        return buildResponse(Guild::all());
    }

    static function post($ctx)
    {
        if (array_key_exists("id", $ctx->post) && array_key_exists("prefix", $ctx->post))
        {
            if (Guild::create( $ctx->post['id'], $ctx->post['prefix']))
            {

                return buildResponse(Guild::get($ctx->post['id']), "Resource created successfully", 201);
            }
            if (Guild::get($ctx->post['id']))
            {
                return buildResponse(Guild::get($ctx->post['id']), "Resource already exists", 422);
            }
            else
            {
                // Invalid id
                return error_400();
            }

        }
        return error_400();
    }
}
?>
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
        $id     = $ctx->getKey('id');
        $prefix = $ctx->getKey('prefix');

        if ($id && $prefix)
        {
            if (Guild::create($id, $prefix))
            {
                return buildResponse(Guild::get($id), "Resource created successfully", 201);
            }
            if (Guild::get($id))
            {
                return buildResponse(Guild::get($id), "Resource already exists", 422);
            }
        }
        return error_400();
    }
}
?>
<?php
include_once("views/view.php");

include_once("models/guild.php");

class GuildView extends View
{

    static function get($ctx, $gid)
    {
        $result = Guild::get($gid);
        if ($result)
        {
            return buildResponse(Guild::get($gid));
        }
        else
        {
            return error_404();
        }
    }

    static function post($ctx, $gid)
    {
        $result = Guild::get($gid);
        if ($result)
        {
            $result = $result->edit($ctx->data);
            if ($result->save())
            {
                return buildResponse($result);
            }
            return error_400();
        }
    }
}

?>
<?php
include_once("views/view.php");

include_once("models/guild.php");

class GuildView extends View
{

    static function get($ctx, $gid)
    {
        return Guild::get($gid);
    }
}

?>
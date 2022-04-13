<?php
include_once("views/view.php");

include_once("models/guild.php");

class GuildsView extends View
{
    static function get($ctx, ...$_)
    {
        return Guild::all();
    }
}
?>
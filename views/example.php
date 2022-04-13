<?php
include_once("views/view.php");

class ExampleView extends View
{
    static function get($ctx)
    {
        return array("current" => date_timestamp_get(date_create()), "request_made" => $ctx->requestStartedAt);
    }
}
?>
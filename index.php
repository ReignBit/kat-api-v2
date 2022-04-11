<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once("config.php");

include_once("routes.php");

header("Content-Type: application/json");


$args = explode("/", $_REQUEST['q']);

if (count($args) >= 1)
{
    foreach ($routes as $route => $callback) {
        if ($args[0] == $route)
        {
            echo json_encode(call_user_func(array($callback, "handleRequest"), $_REQUEST['q']));
            return;
        }
    }
    

    echo "Invalid path";
    return;
}

echo "No params";
?>

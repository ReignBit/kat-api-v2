<?php
define("INC_CONFIG", true);
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once("config.php");

include_once("routes.php");

include_once("utils/errors.php");

header("Content-Type: application/json");


$args = explode("/", $_REQUEST['q']);

if (count($args) >= 1)
{
    foreach ($routes as $route => $callback) {
        if ($args[0] == $route)
        {
            // callback: Controller
            try
            {
                echo json_encode(call_user_func(array($callback, "handleRequest"),$_SERVER['REQUEST_METHOD'], $_REQUEST['q'], $callback));
            }
            catch(\Exception $e)
            {
                if (defined("DEBUG"))
                {
                    throw $e;
                }
                echo json_encode(error_500());
                return;
            }
            return;
        }
    }
    
    echo error_400();
    return;
}

echo error_400();
?>

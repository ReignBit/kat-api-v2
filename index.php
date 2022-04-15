<?php
define("INC_CONFIG", true);
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json");

include_once("config.php");


function buildResponse($data, $msg="Operation successfully completed", $statusCode=200)
{
    $errorMsgs = array(
    400 => "400 Bad Request",
    401 => "401 Unauthorized",
    403 => "403 Forbidden",
    404 => "404 Not Found",
    405 => "405 Method Not Allowed",
    409 => "409 Conflict",
    410 => "410 Gone",
    415 => "415 Unsupported Media Type",
    422 => "422 Unprocessable Entity",
    
    500 => "500 Internal Server Error",
    501 => "501 Not Implemented",
    503 => "503 Service Unavailable",

    );

    http_response_code($statusCode);
    if (array_key_exists($statusCode, $errorMsgs))
    {
        $error = $errorMsgs[$statusCode];
    }
    else
    {
        $error = null;
    }
    
    return json_encode(array(
        "data" => $data,
        "msg" => $msg,
        "status" => $statusCode,
        "error" => $error
    ));
}




include_once("routes.php");
include_once("utils/errors.php");




$args = explode("/", $_REQUEST['q']);

if (count($args) >= 1)
{
    foreach ($routes as $route => $callback) {
        if ($args[0] == $route)
        {
            // callback: Controller
            try
            {
                echo call_user_func(array($callback, "handleRequest"),$_SERVER['REQUEST_METHOD'], $_REQUEST['q'], $callback);
            }
            catch(\PDOException $e)
            {
                echo error_503();
            }
            catch(\Exception $e)
            {
                if (defined("DEBUG"))
                {
                    throw $e;
                }
                echo error_500();
                return;
            }
            return;
        }
    }
}
echo error_400();
?>

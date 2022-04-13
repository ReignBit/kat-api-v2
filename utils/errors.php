<?php

function error_400()
{
    http_response_code(400);
    return array("error" => "400 Bad Request", "msg" => "Invalid request URL or body. Please amend your request and try again.");
}

function error_404()
{
    http_response_code(404);
    return array("error" => "404 Resource Not Found", "msg" => "The requested resource could not be found. It may have been moved or deleted.");
}

function error_405($method)
{
    http_response_code(405);
    return array("error" => "405 Method Not Allowed", "msg" => "The requested resouce does not support http method '$method'");
}

function error_401()
{
    http_response_code(401);
    return array("error" => "401 Unauthorized", "msg" => "Please provide valid credentials");
}

function error_500()
{
    http_response_code(500);
    return array("error" => "500 Internal Server Error", "msg" => "An error occurred and the request was not completed.");

}

?>
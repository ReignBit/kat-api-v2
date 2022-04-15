<?php

function error_400()
{
    return buildResponse(array(), "Invalid request URL or body. Please amend your request and try again.", 400);
}

function error_404()
{
    return buildResponse(array(), "The requested resource could not be found. It may have been moved or deleted.", 404);
}

function error_405($method)
{
    return buildResponse(array(), "The requested resouce does not support http method '$method'", 405);
}

function error_401()
{
    return buildResponse(array(), "Please provide valid credentials", 401);
}

function error_500()
{
    return buildResponse(array(), "An error occurred and the request was not completed.", 500);
}

function error_503()
{
    return buildResponse(array(), "The server was unable to establish a connection with a required service.", 503);
}

?>
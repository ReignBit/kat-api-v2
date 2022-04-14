<?php
/*
        Context.php

        An quality of life class containing variables to be passed throughout
        the middleware/view stack.

        $controller : Controller
        $view       : View 
        $method     : HTTP Method
        $params     : URL parameters
        $middlware  : array(Middleware)

        $requestStartedAt   : Timestamp of when the request was initiated. (When Context was created)
*/

class Context
{
    public $controller;
    public $view;
    public $method;
    public $params;
    public $middleware;

    public $requestStartedAt;

    public function __construct($c, $v, $m, $p, $mi)
    {
        $this->requestStartedAt = date_timestamp_get(date_create());
        $this->controller = $c;
        $this->view = $v;
        $this->method = $m;
        $this->params = $p;
        $this->middleware = $mi;
        $this->processedMiddleware = array();

        $this->post = array();  // post data populated - mainly populated from JsonPostMiddleware. TODO: add generic post data here.
    }
}

?>
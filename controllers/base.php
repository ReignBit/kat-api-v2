<?php

class BaseController
{
    public static $endpoints = array();
    static function handleRequest($method, $args)
    {
        foreach (static::$endpoints as $pattern => $callback) {
            if (preg_match($pattern, $args))
            {
                // Compile any url parameters into their own separate variables...
                $exploded_pattern = array_values(array_filter(explode("/", $pattern)));
                $exploded = array_values(array_filter(explode("/", $args)));

                array_values($exploded_pattern);
                array_values($exploded);

                $url_params = [];
                for ($i=0; $i < count($exploded_pattern); $i++) { 
                    if (substr( $exploded_pattern[$i], 0, 1) == "\\")
                    {
                        $url_params[] = $exploded[$i];
                    }
                }
                
                // We have a valid url path, let's hand it off to the method responsible
                return call_user_func_array(array("GuildController", $callback), $url_params);  
            }
        }

        return array("msg"=> "404 route not found.");
    }
}

?>
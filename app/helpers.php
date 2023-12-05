<?php

if (!function_exists('dynamic_route')) {
    function dynamic_route($routeName, $parameters = [])
    {
        $url = route($routeName, $parameters);

        // Use the url helper to ensure the correct protocol
        return url($url);
    }
}

<?php

if (!function_exists('urls')) {

    /**
     * Return the url of the path using either https or http using environment
     *
     * @param string $path
     * @param mixed  $parameters
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    function urls($path = null, $parameters = [])
    {
        return url($path, $parameters, config('app.env') === 'production');
    }
}

if (!function_exists('assets')) {
    /**
     * Return the url of the asset using either https or http using environment
     *
     * @param string $path
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    function assets($path = null)
    {
        return asset($path, config('app.env') === 'production');
    }
}

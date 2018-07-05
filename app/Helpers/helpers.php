<?php

if (! function_exists('is_prod')) {
    /**
     * Return a boolean if the environment is in production
     *
     * @return bool
     */
    function is_prod()
    {
        $environments = [
            'prod',
            'production',
            'live',
            'demo',
        ];

        return in_array(config('app.env'), $environments, true);

    }
}

if (! function_exists('urls')) {
    /**
     * Return the url of the path using either https or http using environment
     *
     * @param string $path
     * @param mixed  $parameters
     *
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    function urls($path = null, $parameters = [])
    {
        return url($path, $parameters, is_prod());
    }
}

if (! function_exists('assets')) {
    /**
     * Return the url of the asset using either https or http using environment
     *
     * @param string $path
     *
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    function assets($path = null)
    {
        $file = public_path($path);
        // I know there's gonna be an issue if the path already contains 
        // a query, but I'm too lazy to fix it
        $path .= '?t='.filemtime($file);

        return asset($path, is_prod());
    }
}

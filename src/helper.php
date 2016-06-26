<?php

if (! function_exists('conf')) {
    function conf($key = null, $default = null)
    {
        if (is_null($key)) {
            return app('conf');
        }

        if (is_array($key)) {
            return app('conf')->put($key);
        }

        return app('conf')->get($key, $default);
    }
}

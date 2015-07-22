<?php

namespace Gaaarfild\LaravelConf;

use Illuminate\Support\Traits\Macroable;

class Conf
{

    use Macroable;


    public function __construct()
    {

    }

    /**
     * Return config value by key
     *
     * @param $key
     * @param bool $default
     * @return string
     */
    public function get($key, $default=false)
    {
        return 'ok';
    }

}

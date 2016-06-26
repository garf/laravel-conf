<?php

namespace Gaaarfild\LaravelConf\Contracts;

interface Factory
{
    /**
     * Get configuration storage provider implementation.
     *
     * @param  string  $driver
     * @return \Gaaarfild\LaravelConf\Contracts\ConfContract
     */
    public function driver($driver = null);
}

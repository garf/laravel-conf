<?php

namespace Garf\LaravelConf\Contracts;

interface Factory
{
    /**
     * Get configuration storage provider implementation.
     *
     * @param  string  $driver
     * @return \Garf\LaravelConf\Contracts\ConfContract
     */
    public function driver($driver = null);
}

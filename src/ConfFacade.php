<?php

namespace Garf\LaravelConf;

use Illuminate\Support\Facades\Facade;

/**
 * Class ConfFacade.
 */
class ConfFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Garf\LaravelConf\Contracts\Factory::class;
    }
}

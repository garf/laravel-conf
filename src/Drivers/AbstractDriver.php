<?php

namespace Garf\LaravelConf\Drivers;

use Garf\LaravelConf\Contracts\ConfContract;

/**
 * Class AbstractDriver.
 */
abstract class AbstractDriver implements ConfContract
{
    /**
     * In-memory config store.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Get config value by key.
     *
     * @param string $key
     * @param bool   $default
     *
     * @return string
     */
    public function get($key, $default = null)
    {
        return array_get($this->config, $key, $default);
    }

    /**
     * Check existence of the key.
     *
     * @param string $key
     *
     * @return bool
     */
    public function has($key)
    {
        return array_get($this->config, $key, false) !== false;
    }

    /**
     * Return entire config.
     *
     * @return array
     */
    public function all()
    {
        return $this->config;
    }

    /**
     * @param array $config
     *
     * @return $this
     */
    public function put(array $config)
    {
        foreach ($config as $key => $value) {
            $this->set($key, $value);
        }

        return $this;
    }

    /**
     * Return entire config.
     *
     * @return array
     */
    public function toJson()
    {
        return json_encode($this->config);
    }
}

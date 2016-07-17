<?php

namespace Garf\LaravelConf\Contracts;

/**
 * Interface ConfContract.
 */
interface ConfContract
{
    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return $this
     */
    public function set($key, $value);

    /**
     * @param array $config
     *
     * @return $this
     */
    public function put(array $config);

    /**
     * @param string $key
     *
     * @return bool
     */
    public function has($key);

    /**
     * @param string     $key
     * @param null|mixed $default
     *
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * @param string $key
     *
     * @return $this
     */
    public function forget($key);

    /**
     * @return array
     */
    public function all();
}

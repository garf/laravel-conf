<?php

namespace Gaaarfild\LaravelConf;

use Illuminate\Support\Traits\Macroable;
use Session;
use Config;

/**
 * Class Conf
 * @package Gaaarfild\LaravelConf
 */
class Conf
{

    use Macroable;

    /**
     * In-memory config store
     *
     * @var \Illuminate\Support\Collection|null
     */
    private $config = null;

    /**
     * File to save config file
     *
     * @var null|string
     */
    private $file = null;

    /**
     * Create new instance of Conf class
     */
    public function __construct()
    {
        $this->file = storage_path('app/conf.json');
        if (empty($this->config)) {
            if (!file_exists($this->file)) {
                file_put_contents($this->file, json_encode([]));
            }
            $this->config = collect(json_decode(file_get_contents($this->file), true));
        }
    }

    /**
     * Store config value by key
     *
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        $this->config->put($key, $value);
        file_put_contents($this->file, $this->config->toJson());
    }

    /**
     * Check existence of the key
     *
     * @param $key
     * @param bool $withFallback
     * @return string
     */
    public function has($key, $withFallback=true)
    {
        $has = $this->config->has($key);
        if($withFallback) {
            return $has;
        } else {
            if ($has) {
                return $has;
            } else {
                return Config::has($key);
            }
        }
    }

    /**
     * Get config value by key
     *
     * @param $key
     * @param bool $default
     * @param bool $withFallback
     * @return string
     */
    public function get($key, $default=null, $withFallback=true)
    {
        if ($withFallback) {
            return $this->config->get($key, Config::get($key, $default));
        } else {
            return $this->config->get($key, $default);
        }

    }

    /**
     * Return entire config
     * @return string
     */
    public function all()
    {
        return $this->config->all();
    }

}

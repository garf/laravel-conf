<?php

namespace Gaaarfild\LaravelConf;

use Config;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Support\Collection;

/**
 * Class Conf.
 */
class Conf
{
    use Macroable;

    /**
     * In-memory config store.
     *
     * @var Collection|null
     */
    private $config = null;

    /**
     * File to save config file.
     *
     * @var null|string
     */
    private $file = null;

    /**
     * Create new instance of Conf class.
     */
    public function __construct($filepath)
    {
        $this->file = ($filepath) ? $filepath : storage_path('app/conf.json');
        if (empty($this->config)) {
            if (! file_exists($this->file)) {
                file_put_contents($this->file, json_encode([]));
            }
            $this->config = collect(json_decode(file_get_contents($this->file), true));
        }
    }

    /**
     * Set the file, where to store and read from configuration.
     *
     * @param string $file
     *
     * @return $this
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Store config value by key.
     *
     * @param string $key
     * @param mixed  $value
     */
    public function set($key, $value)
    {
        $config = $this->config->toArray();
        array_set($config, $key, $value);
        $this->config = collect($config);
        file_put_contents($this->file, $this->config->toJson(JSON_PRETTY_PRINT));
    }

    /**
     * Check existence of the key.
     *
     * @param string $key
     * @param bool   $withFallback
     *
     * @return string
     */
    public function has($key, $withFallback = true)
    {
        $config = $this->config->toArray();
        $has = array_get($config, $key, false) != false;
        if ($withFallback) {
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
     * Get config value by key.
     *
     * @param string $key
     * @param bool   $default
     * @param bool   $withFallback
     *
     * @return string
     */
    public function get($key, $default = null, $withFallback = true)
    {
        $config = $this->config->toArray();
        if ($withFallback) {
            return array_get($config, $key, Config::get($key, $default));
        } else {
            return array_get($config, $key, $default);
        }
    }

    /**
     * Remove key from config.
     * This method does not support fallback feature.
     *
     * @param string $key
     */
    public function forget($key)
    {
        $config = $this->config->toArray();
        array_forget($config, $key);
        $this->config = collect($config);
        file_put_contents($this->file, $this->config->toJson(JSON_PRETTY_PRINT));
    }

    /**
     * Return entire config.
     *
     * @return string
     */
    public function all()
    {
        return $this->config->all();
    }
}

<?php

namespace Garf\LaravelConf\Drivers;

/**
 * Class FileDriver.
 */
class FileDriver extends AbstractDriver
{
    /**
     * File to save config file.
     *
     * @var null|string
     */
    private $file = null;

    /**
     * JsonDriver constructor.
     */
    public function __construct()
    {
        $this->file = config('laravel-conf.drivers.file.path', storage_path('app/conf.json'));

        if (! file_exists($this->file)) {
            $this->config = [];
            $this->persist();
        } else {
            $this->config = json_decode(file_get_contents($this->file), true);
        }
    }

    /**
     * Store config value by key.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return $this
     */
    public function set($key, $value)
    {
        array_set($this->config, $key, $value);
        $this->persist();

        return $this;
    }

    /**
     * Remove key from config.
     *
     * @param string $key
     *
     * @return $this
     */
    public function forget($key)
    {
        array_forget($this->config, $key);
        $this->persist();

        return $this;
    }

    /**
     * @return $this
     */
    protected function persist()
    {
        file_put_contents($this->file, json_encode($this->config, JSON_PRETTY_PRINT));

        return $this;
    }
}

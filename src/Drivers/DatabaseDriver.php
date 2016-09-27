<?php

namespace Garf\LaravelConf\Drivers;

use Garf\LaravelConf\Models\Conf;

/**
 * Class DatabaseDriver.
 * @deprecated('This driver is in testing. Use with caution!')
 */
class DatabaseDriver extends AbstractDriver
{
    /**
     * @var Conf|null
     */
    private $modelInstance = null;

    /**
     * JsonDriver constructor.
     */
    public function __construct()
    {
        $table = config('laravel-conf.drivers.database.table', 'laravel_conf');

        $this->modelInstance = new Conf;
        $this->modelInstance->setTable($table);

        $configs = $this->modelInstance->get();

        foreach ($configs as $config) {
            array_add($this->config, $config->key, $config->value);
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
        //        if (is_null($this->modelInstance)) {
//            throw new
//        }

        $this->modelInstance->truncate();

        foreach (array_dot($this->config) as $key => $value) {
            $this->modelInstance->create(['key' => $key, 'value' => $value]);
        }

        return $this;
    }
}

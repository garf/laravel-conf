<?php

namespace Garf\LaravelConf\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Conf.
 */
class Conf extends Model
{
    /**
     * @var string
     */
    protected $table = 'laravel_conf';
    
    /**
     * {@inheritdoc}
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key', 'value',
    ];

    /**
     * @param string $table
     *
     * @return $this
     */
    public function setTable($table)
    {
        $this->table = $table;

        return $this;
    }
}

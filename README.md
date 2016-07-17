# Laravel Improved Config

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Laravel Version](https://img.shields.io/badge/laravel-5-orange.svg?style=flat-square)](http://laravel.com)

![Laravel Conf](conf.png)

[Russian Documentation / Русская документация](https://github.com/garf/laravel-conf/blob/master/README-ru.md)

Custom editable configs for Laravel 5.

## Caution 

Repository address changed from `gaaarfild` to `garf`. Dont forget to fix your `composer.json`.

This package helps you to store your additional configuration from your code in custom storage.

By default it uses JSON-file.

This is helpful when you need to edit your configuration by user from GUI. i.e. Website settings.

## Caution!

Be careful! This is version 2 of the package and fallback configuration was removed.

If you still need to use it, please install [version 1.*](https://github.com/garf/laravel-conf/tree/v1.2.2)

## Install

To install version 2, type the following command in your command line:

``` BASH
$ composer require "garf/laravel-conf:3.*"
```

Or add

``` JSON
"garf/laravel-conf": "3.*"
```

to your `composer.json` file into `require` section.

Then type in console

``` BASH
$ composer update
```

When update completed, add to your `config/app.conf` file to `providers` section

``` PHP
'providers' => [
    // ...
    Garf\LaravelConf\LaravelConfServiceProvider::class,
]
```

If you want to use `Conf` facade, add to same file at the `aliases` section

``` PHP
'aliases' => [
    // ...
  'Conf' => Garf\LaravelConf\ConfFacade::class,
]
```

### Publishing config file

To be able to change file location, please execute the following command in the console:

`php artisan vendor:publish --provider="Garf\LaravelConf\LaravelConfServiceProvider" --tag="config"`

Then you can edit file `config/laravel-conf.php` to set any path to file you want to.

## Usage

### Get config value

``` php
Conf::get('key.to.retrieve', 'default_value');
```

Else will return default value.

Could be used 'dot' notation

### Save config value

``` PHP
Conf::set('key', 'value_to_save');
```

Could be used 'dot' notation

Also method `put` can be used to store multiple config values as array

``` PHP
$config = [
    'key1' => 'value1',
    'key2.subkey' => `value2`,
];
Conf::put($config);
```

### Removing key from config

``` PHP
Conf::forget('key');
```

Could be used 'dot' notation

### Get entire config

``` PHP
Conf::all();
```

### Get entire config in JSON

``` PHP
Conf::toJson();
```

### Check config key existence

``` PHP
Conf::has('key.to.check');
```

Could be used 'dot' notation

### Helper

Also helper `conf()` can be used for more convenience.

Usage is similar to build in `config()` helper.

``` PHP
conf()->set('key.subkey', 'myValue');

conf('key.subkey') // will return 'myValue'

conf('non.existing.key', 'myDefaultValue') // will return 'myDefaultValue'

$config = [
    'key1' => 'value1',
    'key2.subkey' => `value2`,
];

conf($config)
```

## Custom storage drivers

This package uses the Laravel Manager class under the hood, so it's easy to add your own custom store driver if you want to store in some other way. All you need to do is extend the abstract `Garf\LaravelConf\Drivers\AbstractDriver` class, implement the abstract methods and call Conf::extend.

``` php
class MyStorageDriver extends Garf\LaravelConf\Drivers\AbstractDriver {
    // ...
}
Conf::extend('mystorage', function($app) {
    return $app->make('MyStorageDriver');
});
```

## Contributions

Contributions are highly appreciated.

Send your pull requests to `master` branch.


## License

The MIT License (MIT). Please see [License File](https://github.com/garf/laravel-conf/blob/master/LICENSE) for more information.


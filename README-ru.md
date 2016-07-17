# Laravel улучшенная конфигурация

[![Лицензия](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Версия Laravel](https://img.shields.io/badge/laravel-5-orange.svg?style=flat-square)](http://laravel.com)

![Laravel Conf](conf.png)

[English Documentation / Английская документация](https://github.com/garf/laravel-conf/blob/master/README.md)

## Внимание

Адрес репозитория изменился с `gaaarfild` на `garf`. Не забудьте исправить ваш файл `composer.json`.

Отдельная редактируемая конфигурация для Laravel 5.

Данный пакет позволяет хранить дополнительную редактируемую конфигурацию в отдельном хранилище.

По-умолчанию для хранения используется JSON-файл.

Это удобно, если вам нужно использовать конфигурацию, которую необходимо редактировать внутри кода пользователем. Например, настройки сайта.

## Внимание!

Будьте осторожны! Это вторая версия пакета. функция `fallback` была удалена.

Если она вам все еще нужна, установите [версию 1.*](https://github.com/garf/laravel-conf/tree/v1.2.2)

## Установка

Для установки версии 2.*, выполните в командной строке:

``` BASH
$ composer require "garf/laravel-conf:3.*"
```

Или в секцию `require` файла `composer.json` добавьте строчку:

``` JSON
"garf/laravel-conf": "3.*"
```

После чего, наберите в консоли

``` BASH
$ composer update
```

После окончания обновления, добавьте в раздел `providers` файла `config/app.conf` строку:

``` php
  Garf\LaravelConf\LaravelConfServiceProvider::class,
```

Если вы хотите использовать фасад `Conf`, добавьте в раздел `aliases` того же файла строку:

``` php
  'Conf' => Garf\LaravelConf\ConfFacade::class,
```

### Публикация файлов конфигурации

Чтобы иметь возможность изменить расположение файла, используйте консольную команду:

`php artisan vendor:publish --provider="Garf\LaravelConf\LaravelConfServiceProvider" --tag="config"`

Теперь вы сможете отредактировать файл `config/laravel-conf.php` чтобы задать необходимый путь хранения файла настроек.


## Использование

### Получить значение

``` php
Conf::get('key.to.retrieve', 'default_value');
```

Если ключа нет, вернется значение по-умолчанию, указанное вторым параметром.

Для работы с массивами, возможно использование "точки".

### Задать значение для ключа

``` PHP
Conf::set('key', 'value_to_save');
```

Можно использовать нотацию разделения точками как в стандартной конфигурации.

Так же можно использовать метод `put`, чтобы сохранить сразу несколько значений, задав их в виде массива

``` PHP
$config = [
    'key1'        => 'value1',
    'key2.subkey' => `value2`,
];
Conf::put($config);
```

### Удаление ключа из настроек

``` PHP
Conf::forget('key');
```

Можно использовать нотацию разделения точками как в стандартной конфигурации.

### Получить всю конфигурацию в виде массива.

``` PHP
Conf::all();
```

### Получить всю конфигурацию в виде JSON.

``` PHP
Conf::toJson();
```

### Проверить, существует ли данный ключ

``` PHP
Conf::has('key.to.check');
```

Можно использовать нотацию разделения точками как в стандартной конфигурации.

### Хэлпер

Так же доступен хэлпер `conf()` для более удобного использования.

Использование идентично использованию стандартного хэлпера `config()`.

``` php
conf()->set('key.subkey', 'myValue');

conf('key.subkey') // вернет 'myValue'

conf('non.existing.key', 'myDefaultValue') // вернет 'myDefaultValue'

$config = [
    'key1'        => 'value1',
    'key2.subkey' => `value2`,
];

conf($config)
```

## Собственные драйвера хранилищ

Этот пакет использует класс Laravel Manager. Это позволяет легко расширять пакет вашими собственными драйверами хранения конфигураций. Все что вам надо сделать - это расширить абстрактный класс `Garf\LaravelConf\Drivers\AbstractDriver`, реализовать требуемые интерфейсом методы, и вызвать Conf::extend.

``` php
class MyStorageDriver extends Garf\LaravelConf\Drivers\AbstractDriver {
    // ...
}
Conf::extend('mystorage', function($app) {
    return $app->make('MyStorageDriver');
});
```

## Помощь в разработке

Мы будем рады любой помощи в разработке.

Присылайте ваши пулл реквесты в ветку `master`.


## Лицензия

Лицензия MIT. Ознакомиться можно [здесь](https://github.com/garf/laravel-conf/blob/master/LICENSE).


# Listening Laravel pRedis Queries

## Installing

```
# composer.json

"minimum-stability": "dev",
"prefer-stable": true,
```

```sh
$ composer require "al-one/laravel-predis-listened" -vvv
```


## Usage

```php
# optional if >= 5.5
# config/app.php
<?php

return [

    'providers' => [
        Alone\LaravelPredisListened\ServiceProvider::class,
    ],

];
```

```php
# config/database.php
<?php

return [
    'redis' => [
        'client' => 'predis_listened',
    ],
];
```

```php
use Alone\LaravelPredisListened\RedisEvent;

Facades\Event::listen(RedisEvent::class,function(RedisEvent $event)
{
    $event->command;   // Redis命令
    $event->arguments; // 参数
    $event->time;      // 耗时
});
```


## License

MIT
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
# config/app.php
<?php

return [

    'providers' => [
        // Illuminate\Redis\RedisServiceProvider::class,
        Alone\LaravelRedisExtendable\RedisServiceProvider::class,
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
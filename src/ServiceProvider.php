<?php

namespace Alone\LaravelPredisListened;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{

    public function boot()
    {
        Redis::extend('predis_listened',function()
        {
            return new PredisListenedConnector;
        });
    }

}
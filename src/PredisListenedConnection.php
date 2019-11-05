<?php

namespace Alone\LaravelPredisListened;

use Illuminate\Redis\Connections;

class PredisListenedConnection extends Connections\PredisConnection
{

    /**
     * Run a command against the Redis database.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return mixed
     */
    public function command($method, array $parameters = [])
    {
        $stm = microtime(true);
        $ret = parent::command($method,$parameters);
        $tim = round((microtime(true) - $stm) * 1000,4);
        event(new RedisEvent($method,$parameters,$tim,$this));
        return $ret;
    }

}

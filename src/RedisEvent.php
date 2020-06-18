<?php

namespace Alone\LaravelPredisListened;

use Illuminate\Support\Arr;

class RedisEvent
{

    public $command;

    public $arguments;

    public $time;

    public $connection;

    /**
     * Create a new event instance.
     *
     * @param  string      $command
     * @param  array       $arguments
     * @param  float|null  $time
     * @param  PredisListenedConnection  $connection
     * @return void
     */
    public function __construct($command,$arguments,$time,$connection)
    {
        $this->command    = $command;
        $this->arguments  = $arguments;
        $this->time       = $time;
        $this->connection = $connection;
        if($command == 'pipeline')
        {
            $this->arguments = $this->parsePipeline($connection,$arguments,$command);
        }
    }

    /**
     * @param PredisListenedConnection  $connection
     * @return array
     */
    public function parsePipeline($connection,$arguments,$command)
    {
        /**
         * @see \Predis\Pipeline\Pipeline
         */
        $pip = new class($connection->client()) implements \Predis\ClientContextInterface
        {
            public $client;
            public $commands = [];
            public function __construct(\Predis\ClientInterface $client)
            {
                $this->client = $client;
            }
            public function __call($command,$arguments)
            {
                $this->commands[] = [$command,$arguments];
            }
            public function executeCommand(\Predis\Command\CommandInterface $command){}
            public function execute($callable = null){}
        };
        $fun = Arr::first($arguments);
        if(is_callable($fun))
        {
            call_user_func($fun,$pip);
        }
        return $pip->commands;
    }

}

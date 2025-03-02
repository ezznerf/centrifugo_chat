<?php

namespace app\Extensions\RabbitMq;

use app\Helpers\Jobs\JobInterface;
use app\Helpers\Serializers\JobSerializer;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMq
{
    protected AMQPStreamConnection $connection;

    private AMQPChannel $channel;

    protected static array $config = [];

    public function __construct(){
        $this->connection = self::makeConnection();
        $this->channel = $this->connection->channel();
    }


    public function publish(JobInterface $message, string $exchange, string $routingKey = ''): void
    {
        $serializedMessage = JobSerializer::serialize($message);
        $msg = new AMQPMessage($serializedMessage);
        $this->channel->basic_publish($msg, $exchange, $routingKey);
    }
    private static function makeConnection()
    {
        self::config();
        return new AMQPStreamConnection(
            self::$config['connection']['host'],
            self::$config['connection']['port'],
            self::$config['connection']['user'],
            self::$config['connection']['password'],
        );
    }

    private static function config()
    {
        if (empty(self::$config)) {
            self::$config = config('rabbitmq.default');
        }
    }
}

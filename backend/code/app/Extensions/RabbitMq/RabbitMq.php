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

    public function consume(string $queue, callable $callback, string $consumerTag = ''): void
    {
        $this->channel->basic_consume($queue, $consumerTag, callback: $callback);
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

    public function close(): void
    {
        $this->connection->close();
        $this->connection->close();
    }

    public function getChannel(): AMQPChannel{
        return $this->channel;
    }

    private static function declareBinding(AMQPChannel $channel, array $bindingData): void
    {
        $channel->queue_bind($bindingData['queue'], $bindingData['exchange'], $bindingData['routing_key']);
    }

    public static function declareQueue(AMQPChannel $channel, array $queueData): void
    {
        $channel->queue_declare($queueData['name'], durable: true);
    }

    private static function declareExchange(AMQPChannel $channel, array $exchangeData): void
    {
        $channel->exchange_declare($exchangeData['name'], $exchangeData['type'], durable: true, auto_delete: false);
    }

    public static function init()
    {
        self::config();
        $connection = self::makeConnection();
        $channel = $connection->channel();

        foreach (self::$config['exchanges'] as $exchange){
            self::declareExchange($channel, $exchange);
        }
        foreach (self::$config['queues'] as $queue){
            self::declareQueue($channel, $queue);
        }
        foreach (self::$config['bindings'] as $binding){
            self::declareBinding($channel, $binding);
        }


    }
}
